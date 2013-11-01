<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
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
}
 
class Team_model extends Base_module_record {
 
}
