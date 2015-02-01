<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Events_model extends Fitzos_model {
 
    function __construct()
    {
        parent::__construct('event');
    }
    function find_one($id){
    	$this->db->where('id',$id);
    	$result = $this->db->get($this->table_name);
    	return $result->result();
    }
    function find_all(){
    	$result = $this->db->get($this->table_name);
    	return $result->result();
    }
    function getEventsForMember($member){
    	$this->db->select('event.*');
		$this->db->join("team","event.team_id = team.id");
		$this->db->join("team_membership","team.id = team_membership.team_id",'left');
    	$this->db->distinct();
		$sql = "(`team_membership`.`member_id` = $member OR `team`.`owner` = $member OR `event`.`member_id` = $member)";
		$this->db->where($sql);
    	$this->db->where('event.date >=' ,date('Y-m-d'));
    	$this->db->order_by('event.date','asc');
    	$this->db->limit(10);
		$result = $this->db->get('event');
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
    function getAllEventData($id,$member_id){
    	$event = $this->getEvent($id);
    	$attending = $this->getMembersAttending($id);
    	$wall = $this->getWall($id);
    	$owner = $this->isOwner($id, $member_id);
    	$isAttendee = $this->isAttendee($id, $member_id);
    	$event->isOwner = $owner ? 'Yes': 'No';
    	$event->isAttendee = $isAttendee ? 'Yes':'No' ;
    	return array(
    		'event'=>$event,
    		'attending'=>$attending,
    		'wall'=>$wall
    	);
    }
    function getPublicEvents(){
    	$this->db->select('event.id,event.name,sport.name as sport');
    	$this->db->where('event.public','PUBLIC');
    	$this->db->where('published','yes');
    	$this->db->where('team.public','yes');
    	$this->db->join('team','team.id = event.team_id');
    	$this->db->join('sport','sport.id = team.sport_id');
    	$this->db->order_by('event.date');
    	$this->db->limit(10);
    	$result = $this->db->get('event');
    	return $result->result();
    }
    function getPublicEventsForMonthBySport(){
    	$this->db->select('count(*) as count,sport.name');
		$this->buildCommonCalendarQuery();
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
    	if (is_array($data)){
    		if (!isset($data['date'])){
    			$data['date'] = date('Y-m-d');
    		} else {
    			$data['date'] = $this->fixDate($data['date']);
    		}
    		if (isset($data['end_date'])){
    			$data['end_date'] = $this->fixDate($data['end_date']);
    		}
    		$this->db->where('id',$data['id']);    	
    		$this->db->update('event',$data);
    	}	
    }
    function _canAttend($event,$user){
    	// alreadt attending??
		$this->db->where('event_id',$event);
		$this->db->where('member_id',$user);
		$num = $this->db->count_all_results('event_attendance');
		if ($num > 0){
			return false;
		}    	
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
			return null;
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
		$invites = array();
		$this->db->select('member_id');
		$this->db->where('team_id',$team);
		$this->db->where('status','yes');
		$this->db->where_not_in('member_id',$members);
		$this->db->join('member','member.id = member_id');
		$result = $this->db->get('team_membership');
    	$data = $result->result();
		foreach($data as $member){
			$invites[] = $member->member_id;
		}		
		$this->db->select('owner');
		$this->db->where('id',$team);
		$result = $this->db->get('team');
		$data = $result->result();
		$invites[] = $data[0]->owner;
		
		$this->db->where_in('id',$invites);
		$this->db->where_not_in('id',Array($event->member_id));
		$result = $this->db->get('member');
		return $result->result();
	}
	function sendInvite($member,$user,$eventId){
		// do notification...
		$this->load->model('notifications_model');
		$event = $this->getEvent($eventId);
		$mesg = "You have been invited to the event $event->name";
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
		$this->db->select('event_wall.*,member.first_name,member.last_name,member.id as memberId');
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
	function isAttendee($event,$id){
		if (isset($event) && isset($id)){
			$this->db->where('event_id',$event);
			$this->db->where("member_id",$id);
			$result = $this->db->get('event_attendance');
			return $result->num_rows() > 0;
		} else {
			return false;
		}
	}
	function addWallPost($data){
		if (is_array($data)){
			if (!isset($data['date'])){
				$data['date'] = $this->fixDate($data['date']);
			}
			$this->db->insert('event_wall',$data);
			return $this->db->insert_id();
		} else {
			return null;
		}
	}
	function getMemberFromSalt($salt){
		$this->db->where('salt',$salt);
		$result = $this->db->get('member');
		$data = $result->result();
		if (isset($data[0])){
			return $data[0]->id;
		} else {
			return null;
		}
	}
	
	function addWallPostAPI($member_id,$event_id,$message){
		if (!is_numeric($member_id)){
			$member_id = $this->getMemberFromSalt($member_id);
		}
		if (isset($member_id)){
			$insert = array(
					'member_id'=>$member_id,
					'event_id'=>$event_id,
					'message'=>$message,
					'date'=>date('Y-m-d')
			);
			$this->db->insert('event_wall',$insert);
			return $this->db->insert_id() > 0;
		} else {
			return false;
		}
	}
	function deletePost($event,$id){
		$this->db->where('event_id',$event);
		$this->db->where('id',$id);
		$this->db->set('deleted','yes');
		$this->db->update('event_wall');
	}
	function getCalendarEvents($sport =null){
		$this->db->select("event.*,sport.name as sport, team.name as team, team.id as teamId");
		$this->buildCommonCalendarQuery();
    	$this->db->order_by('event.date','desc');
    	$result = $this->db->get('event');
    	return $result->result();
	}
	private function buildCommonCalendarQuery(){
		$this->db->where('event.date BETWEEN NOW() - INTERVAL 1 DAY AND NOW() + INTERVAL 30 DAY');
		$this->db->where('event.public','PUBLIC');
		$this->db->where('published','yes');
		$this->db->where('team.public','yes');
		$this->db->join('team','team.id = event.team_id');
		$this->db->join('sport','sport.id = event.sport_id');
	}
    function create($data){
    	unset($data['key']);
    	$this->logEvent('Event->create - Data',print_r($data,TRUE));
		if (isset($data['date'])){
			$data['date'] = $this->fixDate($data['date']);
    		$this->logEvent('Event->fixDate - Result',print_r($data['date'],TRUE));
		}
    	if (isset($data['end_date']) && !empty($data['end_date'])){
    		$this->logEvent('Event->fixEndDate - Result',print_r($data['end_date'],TRUE));
    		$data['end_date'] = $this->fixDate($data['end_date']);
		}
		$this->logEvent('Event->Create - About to insert',print_r($data,TRUE));
		$this->db->insert($this->table_name,$data);
		$this->logEvent('Event Creation - Query',$this->db->last_query());
		$num = $this->db->affected_rows();
		$this->logEvent('Events created ', $num);
    	return $num;
    }
	function getMemberInvites($member_id){
		$this->db->where('event_invites.member_id',$member_id);
		$this->db->where('event_invites.status','invited');
		$this->db->join('event','event.id = event_id');
		$result = $this->db->get('event_invites');
		return $result->result();	
	}
	private function setInviteStatus($event,$member,$status){
		$this->db->set('status',$status);
		$this->db->where('event_id',$event);
		$this->db->where('member_id',$member);
		$this->db->update('event_invites');
		return $this->db->affected_rows();
	}
	function acceptInvite($member_id,$event){
		$status = $this->setInviteStatus($event, $member_id, 'accepted');
		if ($status > 0){
			$insert = array(
				'event_id'=>$event,
				'member_id'=>$member_id,
				'paid'=>'NO',
				'cancelled'=>'NO'
			);			
			$this->db->insert('event_attendance',$insert);
			return $this->db->affected_rows() > 0;
		} else {
			return null;
		}
	}
	function declineInvite($member_id,$event){
		return $this->setInviteStatus($event,$member_id,'declined') > 0;
	}
	function getUpcomingEvents(){
		$this->logEvent('getUpcomingEvents','Incoming');
		$this->db->select("event.id, event.name, sport.name as sport, event.location,concat(date(event.date),' @ ',event.time) as time",false);
		$this->db->join('sport','event.sport_id = sport.id','left');
		$this->db->where('event.public','PUBLIC');
		$this->db->where('published','yes');
		$this->db->where("date > date_sub(now(), interval 2 day)");
		$this->db->order_by('event.date');
		$this->db->limit(10);
		$result = $this->db->get('event');
		$this->logEvent('getUpcomingEvents->query ', $this->db->last_query());
		return $result->result();
	}
}
 
class Event_model extends Base_module_record {
 
}
