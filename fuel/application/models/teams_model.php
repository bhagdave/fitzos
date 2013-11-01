<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH.'models/base_module_model.php');
class Teams_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('team');
    }
    function getPublicTeams(){
    	$this->db->where('public','yes');
    	$result = $this->db->get('team');
    	return $result->result();
    }
    function getOwnedTeams($id){
    	$this->db->where('owner',$id);
    	$result = $this->db->get('team');
    	return $result->result();
    }
    function getTeamsIn($id){
    	$this->db->select('team.id,team.name');
    	$this->db->where('member_id',$id);
    	$this->db->join('team','team_id = team.id');
    	$result = $this->db->get('team_membership');
    	return $result->result();
    }
    function createTeam($data){
    	$this->db->insert('team',$data);
    	return $this->db->insert_id();
    }
}
 
class Team_model extends Base_module_record {
 
}
