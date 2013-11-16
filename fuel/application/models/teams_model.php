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
    private function getMember($id){
    	$this->db->where("id",$id);
    	$result = $this->db->get("member");
    	$data = $result->result();
    	if (isset($data[0])){
    		return $data[0];
    	} else {
    		return null;
    	}
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
	function getTeamWall($id){
		$this->db->where('team_id',$id);
		$this->db->order_by('date');
		$this->db->where('deleted','no');
		$result = $this->db->get('team_wall');
		return $result->result();
	}
	function getTeam($team){
		$this->db->where('id',$team);
		$result = $this->db->get('team');
		$data = $result->result();
		if (isset($data[0])){
			return $data[0];
		} else {
			return null;
		}
	}
	function getTeamEvents($team){
		$this->db->where('team_id',$team);
		$result = $this->db->get('event');
		return $result->result();
	}
	function getTeamMembers($team){
		$this->db->where('team_id',$team);
		$this->db->where('status','yes');
		$this->db->join('member','member.id = member_id');
		$result = $this->db->get('team_membership');
		return $result->result();
	}
	function getMembersAwaiting($team){
		$this->db->where('team_id',$team);
		$this->db->where('status','waiting');
		$this->db->join('member','member.id = member_id');
		$result = $this->db->get('team_membership');
		return $result->result();
	}
	function addWallPost($data){
		if (!isset($data['date'])){
			$data['date'] = date('Y-m-d');
		}
		$this->db->insert('team_wall',$data);
		return $this->db->insert_id();
	}
	function acceptMember($team,$member){
		$this->db->where("member_id",$member);
		$this->db->where("team_id",$team);
		$this->db->set("status","yes");
		$this->db->set("approved_date",date('Y-m-d'));
		$this->db->update("team_membership");		
	}
	function declineMember($team,$member){
		$this->db->where("member_id",$member);
		$this->db->where("team_id",$team);
		$this->db->set("status","no");
		$this->db->update("team_membership");		
	}
	function addNewMemberWallPost($team,$member){
		// get member details..
		$member = $this->getMember($member);
		$data = array();
		$data['team_id'] = $team;
		$data['message'] = "Added new member $member->first_name $member->last_name to team!";
		$this->addWallPost($data);
	}
}
 
class Team_model extends Base_module_record {
 
}
