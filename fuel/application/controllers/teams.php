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
			$data   = $this->teams->getTeam($team);
			$events = $this->teams->getTeamEvents($team);
			$members= $this->teams->getTeamMembers($team);
			$vars   = array('member'=>$member, 'wall'=>$wall, 'team'=>$data, 'members'=>$members, 'events'=>$events);
			$this->fuel->pages->render('team/view',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
	function leave($team,$member){
	// TODO:Leave a member from the team.	
		$this->load->model('teams_model','teams');
		$this->load->model('members_model','members');
		if ($this->session->userdata('id')){
			$this->teams->leaveTeam($team, $member);
			$id     = $this->session->userdata('id');
			redirect('/');
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
					$vars   = array('member'=>$member, 'wall'=>$wall,'owner'=>$owner, 'team'=>$team, 'members'=>$members, 'waiting'=>$waiting, 'events'=>$events);
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
			$data  = $this->teams->getTeam($team);
	 		$vars  = array('wall'=>$wall,'owner'=>$owner,'layout'=>'none','team'=>$data);
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
				$data = array('team_id'=>$_REQUEST['team_id'], 'message'=>$_REQUEST['message'], 'member_id'=>$user);
				$id   = $this->teams->addWallPost($data);
				$team = $this->teams->getTeam($_REQUEST['team_id']);
				$wall = $this->teams->getTeamWall($_REQUEST['team_id']);
			 	$vars = array('wall'=>$wall,'owner'=>$owner,'layout'=>'none','team'=>$team);
				$this->fuel->pages->render('team/teamWall',$vars);
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
	function newEvent($team){
		if ($this->session->userdata('id')){
			$this->load->model('teams_model','teams');
			if (isset($_POST['team_id'])){
				// ok update the beast...
				if (isset($_FILES['file']['name'])){
					if ($_FILES["file"]["error"] > 0){	
						$this->session->set_flashdata('message', 'Unable to save image');
					} else {
						$path = 'assets/images/events/' . $_FILES["file"]["name"];
						if (file_exists($path)){
							// update member image to point here...
						} else {
							// save file...
							move_uploaded_file($_FILES["file"]["tmp_name"],$path);
						}
						// update the member
						$_POST['image'] =$path;
					}
				}			
				$id = $this->teams->addTeamEvent($_POST);
				if (isset($id)){
					$this->session->set_flashdata('message', 'Event added');
				}
				redirect('teams/manage/' . $_POST['team_id']);
			}
			$data = $this->teams->getTeam($team);
			$vars = array('team'=>$data);
			$this->fuel->pages->render('team/addTeamEvent',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
}