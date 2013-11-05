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
	// TODO:View a management team	
	}
	function leave($team){
	// TODO:Leave a member from the team.	
	}
	function manage($team){
	// TODO:Managing a team but only for team
		$this->load->model('teams_model','teams');
		$this->load->model('sports_model','sports');
		$this->load->model('members_model','members');
		if ($this->session->userdata('id')){
			$id   = $this->session->userdata('id');
			$vars = array('member'=>$member, 'sports'=>$sports);
			$this->fuel->pages->render('team/manage',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
	function wall($team){
		//TODO: Build wall
	}
	function addWallPost(){
		//TODO: Add wall post
	}
}