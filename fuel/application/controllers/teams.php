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
			var_dump($_POST);
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
	}
	function manage($team_id = 0){
		if ($team_id > 0){
			$this->load->model('teams_model','teams');
			$this->load->model('sports_model','sports');
			$this->load->model('members_model','members');
			if ($this->session->userdata('id')){
				$id     = $this->session->userdata('id');
				$member = $this->members->getMember($id);
				$wall   = $this->teams->getTeamWall($team_id);
				$team   = $this->teams->getTeam($team_id);
				$events = $this->teams->getTeamEvents($team_id);
				$members= $this->teams->getTeamMembers($team_id);
				$waiting= $this->teams->getMembersAwaiting($team_id);
				$vars   = array('member'=>$member, 'wall'=>$wall, 'team'=>$team, 'members'=>$members, 'waiting'=>$waiting);
				$this->fuel->pages->render('team/manage',$vars);
			} else {
				redirect('signin/login');
				die();
			}
		} else {
			redirect('404');
		}
	}
	function wall($team){
		//TODO: Build wall
	}
	function addWallPost(){
		$this->load->model('teams_model','teams');
		if (isset($_REQUEST)){
			if ($this->session->userdata('id')){
				$id   = $this->teams->addWallPost($_REQUEST);
			 	$wall = $this->teams->getTeamWall($_REQUEST['team_id']);
			 	$vars = array('wall'=>$wall,'layout'=>'none');
				$this->fuel->pages->render('_blocks/teamWall',$vars);
			} else {
				redirect('signin/login');
				die();
			}					
		}
	}
	
}