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
		if ($this->input->post('owner')){
			$team_id = $this->teams->createTeam($this->input->post());
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
			$sports = $this->sports->list_items();
			$od     = $this->teams->getTeamOwner($team);
			$isMember = $this->teams->isMember($team,$id);
			$vars   = array('member'=>$member,'sports'=>$sports, 'wall'=>$wall, 'team'=>$data, 'members'=>$members, 'events'=>$events, 'od'=>$od,'isMember'=>$isMember);
			$this->fuel->pages->render('team/view',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
	function leave($team,$member){
		$this->load->model('teams_model','teams');
		$this->load->model('members_model','members');
		if ($this->session->userdata('id')){
			$this->teams->leaveTeam($team, $member);
			$id = $this->session->userdata('id');
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
					if (!$owner){
						redirect("teams/view/$team_id");
					}
					$member = $this->members->getMember($id);
					$wall   = $this->teams->getTeamWall($team_id);
					$team   = $this->teams->getTeam($team_id);
					$events = $this->teams->getTeamEvents($team_id);
					$members= $this->teams->getTeamMembers($team_id);
					$friends= $this->teams->getFriendsForTeamOwner($team_id);
					$sports = $this->sports->list_items();
					$linkedSports = $this->teams->getSportsForTeam($team_id);
					$waiting= $this->teams->getMembersAwaiting($team_id);
					$vars   = array('friends'=>$friends,'linkedSports'=>$linkedSports,'member'=>$member, 'wall'=>$wall,'owner'=>$owner, 'team'=>$team, 'members'=>$members, 'waiting'=>$waiting, 'events'=>$events);
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
		$this->load->model('members_model','members');
		if ($this->session->userdata('id')){
			$id     = $this->session->userdata('id');
			$wall   = $this->teams->getTeamWall($team);
	 		$owner  = $this->teams->isOwner($team,$this->session->userdata('id'));
			$data   = $this->teams->getTeam($team);
			$member = $this->members->getMember($id);
	 		$vars   = array('wall'=>$wall,'owner'=>$owner,'layout'=>'none','team'=>$data,'member'=>$member);
			$this->fuel->pages->render('team/teamWall',$vars);			
		} else {
			redirect('signin/login');
			die();
		}					
	}
	function addWallPost(){
		$this->load->model('teams_model','teams');
		if ($this->input->post()){
			if ($this->session->userdata('id')){
				// check if owner of team..
				$user = $this->session->userdata('id');
				$owner= $this->teams->isOwner($this->input->get_post('team_id'),$user);
				$data = array(
						'team_id'=>$this->input->get_post('team_id'), 
						'message'=>$this->input->get_post('message'), 
						'member_id'=>$user);
				$id   = $this->teams->addWallPost($data);
				$team = $this->teams->getTeam($this->input->get_post('team_id'));
				$wall = $this->teams->getTeamWall($this->input->get_post('team_id'));
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
			$vars   = array('waiting'=>$waiting,'layout'=>'none','team'=>$team);
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
			if ($this->input->post('team_id')){
				// ok update the beast...
				$data = $this->input->post();
				if (isset($_FILES['file']['name'])){
					$this->load->library('Fitzos_utility',null,'Futility');
					$path = $this->Futility->saveFile($_FILES); 
					if (isset($path)){
						$data['image'] =$path;
					} else {
						$this->session->set_flashdata('message', 'Unable to save event image');
					}
				}			
				// lets add the member id for the person adding the event
				$user = $this->session->userdata('id');
				$data['member_id'] = $user;
				$id = $this->teams->addTeamEvent($data);
				if (isset($id)){
					$this->session->set_flashdata('message', 'Event added');
				} else {
					$this->session->set_flashdata('message', 'Unable to add event');
				}
				redirect('/teams/manage/' . $team);
			}
			$sports = $this->teams->getSportsForTeam($team);
			$data = $this->teams->getTeam($team);
			$vars = array('team'=>$data,'sports'=>$sports);
			$this->fuel->pages->render('team/addTeamEvent',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
	function deleteEvent($id,$team_id){
		$member = $this->session->userdata('id');
		$this->load->model('teams_model','teams');
		$this->load->model('events_model','events');
		$this->events->deleteEvent($id);
		$events = $this->teams->getTeamEvents($team_id);
		$team = $this->teams->getTeam($team_id);
		$owner  = $this->teams->isOwner($team_id,$member);
		$vars = array('events'=>$events,'team'=>$team,'layout'=>'none','owner'=>$owner);
		$this->fuel->pages->render('team/teamEvents',$vars);
	}
	function sports($teamId = 0){
		if ($this->session->userdata('id')){
			if ($teamId > 0){
				$this->load->model('teams_model','teams');
				$this->load->model('sports_model','sports');
				if ($this->input->post('team_id')){
					$done = $this->teams->createTeamSport($this->input->post());
					if ($done == 0){
						$this->session->set_flashdata('message', 'Unable to add sport');
					} else {
						$this->session->set_flashdata('message', 'Sport added');
					}
				}
				$sports = $this->sports->list_items();
				$linkedSports = $this->teams->getSportsForTeam($teamId);
				$team   = $this->teams->getTeam($teamId);
				$vars   = array('linkedSports'=>$linkedSports,'team'=>$team,'sports'=>$sports);
				$this->fuel->pages->render('team/manageSports',$vars);
			} else {
				redirect('404');
			}
		} else {
			redirect('signin/login');
		}
	}
	function sendInvites($teamId){
		
	}
}