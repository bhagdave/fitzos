<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Teams_model extends Fitzos_model {
 
    function __construct()
    {
        parent::__construct('team');
    }
    function getPublicTeams($id){
		$this->logEvent('getPublicTeams','Incoming');
    	$this->db->select('team.*');
    	$this->db->where('public','yes');
    	$this->db->join('team_membership',"team_id = team.id and member_id not in ($id)",'left');
		$this->db->distinct();
    	$this->db->where_not_in('owner',$id);
    	$result = $this->db->get('team');
		$this->logEvent('getPublicTeams->query ', $this->db->last_query());
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
    function getMembersTeams($id){
    	$query = "select team.id,team.name from team_membership
					join team on team_id = team.id
					where member_id = $id
					union
				  select id,name from team where owner = $id";
    	$result = $this->db->query($query);
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
//		$this->db->where('event.date >=' ,date('Y-m-d'));
		$this->db->order_by('date','desc');
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
	private function getOwnersFriends($team_id){
		$team = $this->getTeam($team_id);
		$id = $team->owner;
		$this->load->model('members_model');
		$friends = $this->members_model->getFriends($id);
		$friendList = array();
		foreach($friends as $friend){
			$friendList[] = $friend->id;
		}
		unset($friends);
		return $friendList;
	}
	private function getArrayOfMembers($team_id){
		$members = $this->getTeamMembers($team_id);
		$memberList = array();
		foreach($members as $member){
			$memberList[] = $member->id;
		}
		unset($members);
		return $memberList;
	}
	function getInvitedFriends($team_id,$asArray = false){
		$this->db->select('member_id');
		$this->db->where('team_id',$team_id);
		$result = $this->db->get('team_invites');
		if ($asArray){
			return $result->result_array();
		} else {
			return $result->result();
		}
	}
	function isInvited($team,$id){
		$this->db->select('member_id');
		$this->db->where('team_id',$team);
		$this->db->where('status','invited');
		$this->db->where('member_id',$id);
		$invited = $this->db->count_all_results('team_invites') > 0;
		return $invited;
	}
	function getInvitedFriendsDetails($team_id){
		$this->db->where('team_id',$team_id);
		$this->db->join('member','member_id = member.id');
		$result = $this->db->get('team_invites');
		return $result->result();
	}
	function getFriendsToInvite($team,$member_id){
		$query = "select member.id,member.first_name from
		(select
				if (member_id_requested = ?,member_id_requestee,member_id_requested) as friend
				from
				friend
				where
				status = 'accepted' and
				(member_id_requested = ? or member_id_requestee = ?) ) friends
		join member on member.id = friend
		where friends.friend not in (select member_id from team_membership where team_id = ? and status ='yes')
		and friends.friend not in (select member_id from team_invites where team_id = ?)";
		$result = $this->db->query($query,array($member_id,$member_id,$member_id,$team,$team));
		return $result->result();
	}
	function getFriendsForTeamOwner($team_id){
		$friendList = $this->getOwnersFriends($team_id);
		$members = $this->getTeamMembers($team_id);
		$memberList = $this->getArrayOfMembers($team_id);
		$invited = $this->getInvitedFriends($team_id); 
		$inviteList = array();
		foreach($invited as $member){
			if (isset($member->member_id)){
				$inviteList[] = $member->member_id;
			}
		}
		// get a list of members who are not existing members from friend list
		if (isset($friendList) && count($friendList) > 0){
			if (isset($memberList) && count($memberList) > 0){
				$this->db->where_not_in('id',$memberList);
			}
			if (isset($inviteList) && count($inviteList) > 0){
				$this->db->where_not_in('id',$inviteList);
			}
			$this->db->where_in('id',$friendList);
			$result = $this->db->get('member');
			$data = $result->result();
			return $data;
		} else {
			return null;
		}
	}
	function addWallPost($data){
		unset($data['key']);
		unset($data['signature']);
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
			$insert = array('member_id'=>$member,'team_id'=>$team, 'status'=>'yes', 'requested_date'=>date('Y-m-d'), 'approved_date'=>date('Y-m-d'));
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
	function createMemberFromInvite($team,$member){
		$insert = array('member_id'=>$member,'team_id'=>$team, 'status'=>'yes', 'requested_date'=>date('Y-m-d'),'approved_date'=>date('Y-m-d'));
		$this->db->insert('team_membership',$insert);
		$id = $this->db->insert_id();		
		$this->setTeamInviteStatus($team, $member, 'accepted');
		return $id;
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
			$this->db->where('status','yes');
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
				$data['date'] = $this->fixDate($data['date']);
			}
			if (isset($data['end_date'])){
				$data['end_date'] = $this->fixDate($data['end_date']);
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
	function sendInvites($members,$user,$team){
		$members = json_decode($members);
		foreach($members as $member){
			$this->sendInvite($member,$user,$team);
		}
		return true;
	}
	function sendInvite($memberId,$user,$teamId){
		$this->load->model('notifications_model');
		$team = $this->getTeam($teamId);
		$mesg = "You have been invited to the team $team->name";
		$data = array(
				"from_table"=>"member",
				"from_key"=>$user,
				"to_table"=>"member",
				"to_key"=>$memberId,
				"notification"=>$mesg,
				"published"=>"yes"
		);
		$this->notifications_model->createNotification($data);
		// do enmails
		$this->load->model('members_model');
		$memberData = $this->members_model->getMember($memberId);
		$sender = $this->members_model->getMember($user);
		$this->load->library('Fitzos_email',null,'Femail');
		$this->Femail->sendTeamInvite($memberData,$team,$sender);
		// record invite
		$invite = array(
				'team_id'=>$teamId,
				'member_id'=>$memberId,
				'status'=>'invited',
				'invite_sent'=>date('Y-m-d')
		);
		$this->db->insert('team_invites',$invite);
	}
	function getAllTeamData($team,$member_id){
		$team_data = $this->getTeam($team);
		if (isset($team_data)){
			// check if they are a member
			$team_data->isMember = $this->isMember($team,$member_id);
			if (isset($team_data) && !empty($team_data)){
				$team_wall = $this->getTeamWall($team);
				$team_members = $this->getTeamMembers($team);
				$team_events = $this->getTeamEvents($team);
				$team_data->isOwner = $this->isOwner($team,$member_id);
				$owner = $this->getTeamOwner($team);
				$invite_data = $this->getFriendsToInvite($team, $member_id);
				return array(
						'team'=>$team_data,
						'wall'=>$team_wall,
						'members'=>$team_members,
						'events'=>$team_events,
						'invites'=>$invite_data,
						'owner'=>$owner
				);
			} else {
				return null;
			}
		}
		return null;
	}
	function getInvites($member_id){
		$this->db->where('member_id',$member_id);
		$this->db->join('team','team.id=team_id');	
		$this->db->where('status','invited');
		$result = $this->db->get('team_invites');
		return $result->result();
	}
	function acceptTeamInvite($team,$member_id){
		return $this->createMemberFromInvite($team,$member_id);
	}
	function declineTeamInvite($team,$member_id){
		// update invite table
		return $this->setTeamInviteStatus($team, $member_id, 'declined') > 0;
	}
	private function setTeamInviteStatus($team,$member_id,$status){
		$this->db->where('team_id',$team);
		$this->db->where('member_id',$member_id);
		$this->db->set('status',$status);
		$this->db->update('team_invites');
		return $this->db->affected_rows();
	}
}
 
class Team_model extends Base_module_record {
 
}
