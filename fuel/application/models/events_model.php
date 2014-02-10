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
    function updateEvent($data){
    	$this->db->where('id',$data['id']);
    	$this->db->update('event',$data);	
    }
}
 
class Event_model extends Base_module_record {
 
}
