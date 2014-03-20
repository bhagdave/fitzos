<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH.'models/base_module_model.php');

class Events_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('event');
    }
    function getEventsForMember($member){
    	$this->db->select('event.*');
		$this->db->join("team","event.team_id = team.id");
		$this->db->join("team_membership","team.id = team_membership.team_id",'left');
    	$this->db->distinct();
		$sql = "(`team_membership`.`member_id` = $member OR `team`.`owner` = $member OR `event`.`member_id` = $member)";
		$this->db->where($sql);
    	$this->db->where('event.date >=' ,date('Y-m-d'));
		$result = $this->db->get('event');
//		echo($this->db->last_query());
		$data = $result->result();
		return $data;
    }
    function getEvent($id){
    	$this->db->select('event.*,member.first_name,member.last_name');
    	$this->db->where('event.id',$id);
    	$this->db->join('member','member.id = member_id');
    	$result = $this->db->get('event');
    	$data = $result->result();
    	if (isset($data[0])){
    		return $data[0];
    	} else {
    		return null;
    	}
    }
    function getPublicEvents(){
    	$this->db->select('event.id,event.name,sport.name as sport');
    	$this->db->where('event.public','PUBLIC');
    	$this->db->where('published','yes');
    	$this->db->where('team.public','yes');
    	$this->db->join('team','team.id = event.team_id');
    	$this->db->join('sport','sport.id = team.sport_id');
    	$this->db->order_by('event.date');
    	$result = $this->db->get('event');
    	return $result->result();
    }
    function getEventsBySport(){
    	$this->db->select('count(*) as count,sport.name');
    	$this->db->where('event.date BETWEEN NOW() AND NOW() + INTERVAL 30 DAY');
    	$this->db->join('team','team.id = event.team_id');
    	$this->db->join('sport','sport.id = team.sport_id');
    	$this->db->group_by('sport.name');
    	$result = $this->db->get('event');
    	return $result->result();
    }
    function getMembersAttending($id){
		$this->db->where('event_id',$id);
		$this->db->where('cancelled','NO');
		$this->db->join('athlete','athlete.member_id = event_attendance.member_id');
		$result = $this->db->get('event_attendance');
		return $result->result();	    	
    }
    function updateEvent($data){
    	$this->db->where('id',$data['id']);
    	$this->db->update('event',$data);	
    }
    function _canAttend($event,$user){
    	// if event is public and published then allow
    	$this->db->where('id',$event);
    	$result = $this->db->get('event');
    	$data = $result->result();
    	if (isset($data[0])){
    		if ($data[0]->public == 'PUBLIC'){
    			return true;
    		} else {
    			// if member is member of team then allow
    			$this->load->model('teams_model');
    			$test = $this->teams_model->isMember($data[0]->team_id,$user);
    			return $test;
    		}
    	} else {
    		return false;
    	}
    }
    function setAttendEvent($event,$user){
    	// check if they can attend...
    	if ($this->_canAttend($event, $user)){
    		// update the attending table..
    		$data = array('member_id'=>$user,'event_id'=>$event,'paid'=>'NO','cancelled'=>'NO');
    		$this->db->insert('event_attendance',$data);
    		$num = $this->db->affected_rows();
    		// see if they are on the list of invites and update
    		$this->db->where('event_id',$event);
    		$this->db->where('member_id',$user);
    		$this->db->update('event_invites',array('status'=>'accepted'));
    		return ($num > 0);
    	} else {
    		return false;
    	}
    }
    function deleteEvent($id){
    	$this->db->delete('event',array('id'=>$id));
    }
    function getInvitedMembers($event){
    	$this->db->where('event_id',$event);
    	$this->db->join('member','member.id = member_id');
    	$result = $this->db->get('event_invites');
    	return $result->result();
    }
	function rejectAttendee($event,$user){
		$this->db->where('event_id',$event);
		$this->db->where('member_id',$user);
		$this->db->update('event_attendance',array('cancelled'=>'YES'));
	}
	function getTeamMembersToInvite($team,$eventId){
		$this->db->where('id',$eventId);
		$result = $this->db->get('event');
		$data = $result->result();
		if (isset($data[0])){
			$event = $data[0];
		} else {
			$event = null;
		}
		$members[] = $event->member_id;
		$this->db->select('member_id');
		$this->db->where('event_id',$eventId);
		$result = $this->db->get("event_attendance");
		$data = $result->result();
		foreach($data as $member){
			$members[] = $member->member_id;
		}		
		$this->db->select('member_id');
		$this->db->where('event_id',$eventId);
		$result = $this->db->get("event_invites");
		$data = $result->result();
		foreach($data as $member){
			$members[] = $member->member_id;
		}		
		$this->db->where('team_id',$team);
		$this->db->where('status','yes');
		$this->db->where_not_in('member_id',$members);
		$this->db->join('member','member.id = member_id');
		$result = $this->db->get('team_membership');
		return $result->result();
	}
	function sendInvite($member,$user,$eventId){
		// do notification...
		$this->load->model('notifications_model');
		$event = $this->getEvent($eventId);
		$mesg = "You have been invited to the event <a href='/event/view/".$event->id."'>$event->name</a>";
		$data = array(
			"from_table"=>"member",
			"from_key"=>$user,
			"to_table"=>"member",
			"to_key"=>$member,
			"notification"=>$mesg,
			"published"=>"yes"	
		);
		$this->notifications_model->createNotification($data);
		// do enmails
		$this->load->model('members_model');
		$memberData = $this->members_model->getMember($member);
		$this->load->library('Fitzos_email',null,'Femail');
		$this->Femail->sendEventInvite($memberData,$event);
		// record invite
		$invite = array(
			'event_id'=>$eventId,
			'member_id'=>$member,
			'status'=>'invited',
			'invite_sent'=>date('Y-m-d')			
		);
		$this->db->insert('event_invites',$invite);
	}
	function getWall($event){
		$this->db->select('event_wall.*,member.first_name,member.last_name');
		$this->db->where('event_id',$event);
		$this->db->join('member','member.id = member_id','left');
		$this->db->order_by('id','desc');
		$this->db->where('deleted','no');
		$result = $this->db->get('event_wall');
		return $result->result();
	}
	function isOwner($event,$id){
		if (isset($event) && isset($id)){
			$this->db->where('event.id',$event);
			$this->db->where("(member_id = $id or team.owner = $id)");
			$this->db->join('team','team.id = team_id');
			$result = $this->db->get('event');
			return $result->num_rows() > 0;
		} else {
			return false;
		}
	}
	function addWallPost($data){
		if (is_array($data)){
			if (!isset($data['date'])){
				$data['date'] = date('Y-m-d');
			}
			$this->db->insert('event_wall',$data);
			return $this->db->insert_id();
		} else {
			return null;
		}
	}
	function deletePost($event,$id){
		$this->db->where('event_id',$event);
		$this->db->where('id',$id);
		$this->db->set('deleted','yes');
		$this->db->update('event_wall');
	}
	
}
 
class Event_model extends Base_module_record {
 
}
