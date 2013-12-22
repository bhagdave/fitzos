<?php
class Teams extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
	}
	function create($member_id){
		$this->load->model('teams_model','teams');
		$this->load->model('sports_model','sports');
		$this->load->model('members_model','members');
		if (isset($_POST['owner'])){
			// posted do shit....
			$team_id = $this->teams->createTeam($_POST);
			// send them to the team management
			$this->manage($team_id);
			return;
		} else {
			if ($this->session->userdata('id')){
				$id      = $this->session->userdata('id');
				$member  = $this->members->getMember($id);
				$sports  = $this->sports->list_items();
			} else {
				redirect('signin/login');
				die();
			}
		}
		$vars = array('member'=>$member, 'sports'=>$sports);
		$this->fuel->pages->render('team/create',$vars);
	}	
	function view($team){
		$this->load->model('teams_model','teams');
		$this->load->model('sports_model','sports');
		$this->load->model('members_model','members');
		if ($this->session->userdata('id')){
			$id     = $this->session->userdata('id');
			$member = $this->members->getMember($id);
			$wall   = $this->teams->getTeamWall($team);
			$team   = $this->teams->getTeam($team);
			$events = $this->teams->getTeamEvents($team);
			$members= $this->teams->getTeamMembers($team);
			$vars   = array('member'=>$member, 'wall'=>$wall, 'team'=>$team, 'members'=>$members);
			$this->fuel->pages->render('team/view',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
	function leave($team){
	// TODO:Leave a member from the team.	
		$this->load->model('teams_model','teams');
		$this->load->model('members_model','members');
		if ($this->session->userdata('id')){
			$id     = $this->session->userdata('id');
			$wall   = $this->teams->getTeamWall($team);
			$team   = $this->teams->getTeam($team);
			$events = $this->teams->getTeamEvents($team);
			$members= $this->teams->getTeamMembers($team);
			$vars   = array('member'=>$member, 'wall'=>$wall, 'team'=>$team, 'members'=>$members);
			$this->fuel->pages->render('team/view',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
	function manage($team_id = 0){
		if ($this->session->userdata('id')){
			if ($team_id > 0){
				$this->load->model('teams_model','teams');
				$this->load->model('sports_model','sports');
				$this->load->model('members_model','members');
				if ($this->session->userdata('id')){
					$id     = $this->session->userdata('id');
					$owner  = $this->teams->isOwner($team_id,$id);
					$member = $this->members->getMember($id);
					$wall   = $this->teams->getTeamWall($team_id);
					$team   = $this->teams->getTeam($team_id);
					$events = $this->teams->getTeamEvents($team_id);
					$members= $this->teams->getTeamMembers($team_id);
					$waiting= $this->teams->getMembersAwaiting($team_id);
					$vars   = array('member'=>$member, 'wall'=>$wall,'owner'=>$owner, 'team'=>$team, 'members'=>$members, 'waiting'=>$waiting);
					$this->fuel->pages->render('team/manage',$vars);
				} else {
					redirect('signin/login');
					die();
				}
			} else {
				redirect('404');
			}
		} else {
			redirect('signin/login');
			die();
		}
	}
	function getWall($team){
		$this->load->model('teams_model','teams');
		if ($this->session->userdata('id')){
	 		$wall  = $this->teams->getTeamWall($team);
	 		$owner = $this->teams->isOwner($team,$this->session->userdata('id'));
		 	$vars  = array('wall'=>$wall,'owner'=>$owner,'layout'=>'none');
			$this->fuel->pages->render('team/teamWall',$vars);			
		} else {
			redirect('signin/login');
			die();
		}					
	}
	function addWallPost(){
		$this->load->model('teams_model','teams');
		if (isset($_REQUEST)){
			if ($this->session->userdata('id')){
				// check if owner of team..
				$user = $this->session->userdata('id');
				$owner= $this->teams->isOwner($_REQUEST['team_id'],$user);
				$id   = $this->teams->addWallPost($_REQUEST);
			 	$wall = $this->teams->getTeamWall($_REQUEST['team_id']);
			 	$vars = array('wall'=>$wall,'owner'=>$owner,'layout'=>'none');
				$this->fuel->pages->render('_blocks/teamWall',$vars);
			} else {
				redirect('signin/login');
				die();
			}					
		}
	}
	function deleteWallPost($team = 0,$id = 0){
		if ($this->session->userdata('id')){
			$this->load->model('teams_model','teams');
			$this->teams->deletePost($team,$id);
			$this->getWall($team);
		} else {
			redirect('signin/login');
			die();
		}					
	}
	function declineMember($team,$member){
		if ($this->session->userdata('id')){
			$this->load->model('teams_model','teams');
			$this->load->model('notifications_model','notify');
			$this->teams->declineMember($team,$member);
			// add notification
			$this->notify->sendDecline($team,$member);
			$waiting= $this->teams->getMembersAwaiting($team);
			$vars   = array('waiting'=>$waiting,'layout'=>'none');
			$this->fuel->pages->render('team/memberRequests',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}	
	function acceptMember($team,$member){
		if ($this->session->userdata('id')){
			$this->load->model('teams_model','teams');
			$this->load->model('notifications_model','notify');
			$this->teams->acceptMember($team,$member);
			//add notification
			$this->notify->sendAcceptance($team,$member);
			// add wall post
			$this->teams->addNewMemberWallPost($team,$member);
			// now send back the Member requests section
			$waiting= $this->teams->getMembersAwaiting($team);
			$vars   = array('waiting'=>$waiting,'layout'=>'none');
			$this->fuel->pages->render('team/memberRequests',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}	
	function getTeamMembers($team_id){
		$this->load->model('teams_model','teams');
		if ($this->session->userdata('id')){
			$members= $this->teams->getTeamMembers($team_id);
			$vars   = array('members'=>$members,'layout'=>'none');
			$this->fuel->pages->render('team/teamMembers',$vars);
		} else {
			redirect('signin/login');
			die();
		}		
	}
	function getAwaitingRequests($team_id){
		$this->load->model('teams_model','teams');
		if ($this->session->userdata('id')){
			$waiting= $this->teams->getMembersAwaiting($team_id);
			$vars   = array('waiting'=>$waiting,'layout'=>'none');
			$this->fuel->pages->render('team/memberRequests',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
}