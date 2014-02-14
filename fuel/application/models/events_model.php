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
    	$this->db->where("team_membership.member_id",$member);
    	$this->db->or_where("team.owner",$member);
    	$this->db->or_where("event.member_id",$member);
		$result = $this->db->get('event');
		$data = $result->result();
		return $data;
    }
    function getEvent($id){
    	$this->db->where('id',$id);
    	$result = $this->db->get('event');
    	$data = $result->result();
    	if (isset($data[0])){
    		return $data[0];
    	} else {
    		return null;
    	}
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
    function setAttendEvent($event,$user){
    	$data = array('member_id'=>$user,'event_id'=>$event,'paid'=>'NO','cancelled'=>'NO');
    	$this->db->insert('event_attendance',$data);
    }
    function deleteEvent($id){
    	$this->db->delete('event',array('id'=>$id));
    }
	function rejectAttendee($event,$user){
		$this->db->where('event_id',$event);
		$this->db->where('member_id',$user);
		$this->db->update('event_attendance',array('cancelled'=>'YES'));
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
	}
}
 
class Event_model extends Base_module_record {
 
}
