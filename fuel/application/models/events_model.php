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
		$this->db->join('athlete','athlete.member_id = event_attendance.member_id');
		$result = $this->db->get('event_attendance');
		return $result->result();	    	
    }
    function updateEvent($data){
    	$this->db->where('id',$data['id']);
    	$this->db->update('event',$data);	
    }
    function deleteEvent($id){
    	$this->db->delete('event',array('id'=>$id));
    }
}
 
class Event_model extends Base_module_record {
 
}
