<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH.'models/base_module_model.php');

class Events_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('event');
    }
    function getEventsForMember($member){
		$this->db->join("team","event.team_id = team.id");
		$this->db->join("team_membership","team.id = team_membership.team_id");
    	$this->db->where("team_membership.member_id",$member);
		$result = $this->db->get('event');
		return $result->result();
    }
}
 
class Event_model extends Base_module_record {
 
}
