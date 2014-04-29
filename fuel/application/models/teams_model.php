<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH.'models/base_module_model.php');
class Teams_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('team');
    }
    function getPublicTeams($id){
    	$this->db->select('team.*');
    	$this->db->where('public','yes');
    	$this->db->join('team_membership',"team_id = team.id and member_id not in ($id)",'left');
		$this->db->distinct();
    	$this->db->where_not_in('owner',$id);
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
    	$this->db->where('status','yes');
    	$this->db->join('team','team_id = team.id');
    	$result = $this->db->get('team_membership');
    	return $result->result();
    }
    function createTeam($data){
    	$this->db->insert('team',$data);
    	$team_id = $this->db->insert_id();
    	$this->db->insert('team_sports',array('team_id'=>$team_id,'sport_id'=>$data['sport_id']));
    	return $team_id;
    }
	function getTeamWall($id){
		$this->db->select('team_wall.*,member.first_name,member.last_name,member.id as memberId');
		$this->db->where('team_id',$id);
		$this->db->join('member','member.id = member_id','left');
		$this->db->order_by('id','desc');
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
	function getSportsForTeam($team){
		$this->db->where('team_id',$team);
		$this->db->join('sport','sport.id=team_sports.sport_id');
		$result = $this->db->get('team_sports');
		$data = $result->result();
		return $data;
	}
	function getTeamEvents($team){
		$this->db->where('team_id',$team);
		$this->db->where('event.date >=' ,date('Y-m-d'));
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
		if (is_array($data)){
			if (!isset($data['date'])){
				$data['date'] = date('Y-m-d');
			}
			$this->db->insert('team_wall',$data);
			return $this->db->insert_id();
		} else {
			return null;
		}
	}
	function setMemberRequest($team,$member){
		// check if they are already a member
		$this->db->select('id');
		$this->db->where('member_id',$member);
		$this->db->where('team_id',$team);
		$num = $this->db->count_all_results('team_membership');
		if ($num > 0){
			return array('id'=>0,'message'=>'Membership already requested');
		} else {
			$insert = array('member_id'=>$member,'team_id'=>$team, 'status'=>'waiting', 'requested_date'=>date('Y-m-d'));
			$this->db->insert('team_membership',$insert);
			$id = $this->db->insert_id();
			return array('id'=>$id,'message'=>'Message Requested');
		}
	}
	function leaveTeam($team,$member){
		$this->db->where('member_id',$member);
		$this->db->where('team_id',$team);
		$this->db->update('team_membership',array('status'=>'left'));
		if ($this->db->affected_rows() > 0){
			$member = $this->getMember($member);
			$teamData = $this->getTeam($team);
			$data = array();
			$data['team_id'] = $team;
			$msg = "$member->first_name $member->last_name has left the team $teamData->name!";
			$data['message'] = $msg;
			$this->addWallPost($data);
			$data['notification'] = $msg;
			$data['to_table'] = 'member';
			$data['to_key'] = $teamData->owner;
			$data['from_table'] = 'member';
			$data['from_key'] = $member->id;
			unset($data['message']);
			unset($data['team_id']);
			$data['published'] = 'yes';
			$data['read'] = 0;
			$data['date_added'] = date('Y-m-d',now());
			$data['type'] = 'MESSAGE';
			$this->createNotification($data);
		}
	}
	private function createNotification($data){
		$this->db->insert('notifications',$data);
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
	function isOwner($team = null,$user = null){
		if (isset($team) && isset($user)){
			$this->db->where('id',$team);
			$this->db->where('owner',$user);
			$result = $this->db->get('team');
			return $result->num_rows() > 0;
		} else {
			return false;
		}
	}
	function isMember($team,$user){
		if (isset($team) && isset($user)){
			$this->db->where('team_id',$team);
			$this->db->where('member_id',$user);
			$member = $this->db->count_all_results('team_membership') > 0;
			return $member OR $this->isOwner($team,$user);
		}
		return false;
	}
	function deletePost($team,$id){
		$this->db->where('team_id',$team);
		$this->db->where('id',$id);
		$this->db->set('deleted','yes');
		$this->db->update('team_wall');
	}
	function addTeamEvent($data){
		if (is_array($data)){
			if (!isset($data['date'])){
				$data['date'] = date('Y-m-d');
			} else {
				if (strtotime($data['date'])){
					$data['date'] = date('Y-m-d',strtotime($data['date']));
				} else {
					unset($data['date']);
				}
			}
			$this->db->insert('event',$data);
			return $this->db->insert_id();
		} else {
			return null;
		}
	}
	function getTeamOwner($team_id){
		$this->db->select('member.*');
		$this->db->where("team.id",$team_id);
		$this->db->join('member','member.id = owner');
		$result = $this->db->get("team");
	    $data = $result->result();
    	if (isset($data[0])){
    		return $data[0];
    	} else {
    		return null;
    	}
	}
	function createTeamSport($data){
		$this->db->insert('team_sports',array('team_id'=>$data['team_id'],'sport_id'=>$data['sport_id']));
		$done = $this->db->affected_rows();
		return $done;
	}
}
 
class Team_model extends Base_module_record {
 
}
