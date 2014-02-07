<?php
class Event extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
	}
	function view($id){
		if ($this->session->userdata('id')){
			$user = $this->session->userdata('id');
			$this->load->model('events_model');
			$this->load->model('teams_model');
			$this->load->model('athletes_model');
			$event = $this->events_model->getEvent($id);
			if (isset($event)){
				$edit = false;
				$team = $this->teams_model->getTeam($event->team_id);
				if (isset($team)){
					if ($team->owner == $user || $event->member_id == $user){
						$edit = true;
					}
				} else {
					$edit = false;
				}
				$vars = array('team'=>$team, 'edit'=>$edit, 'event'=>$event);
				$this->fuel->pages->render('event/view',$vars);
			} else {
				redirect('404');
				die();
			}
		} else {
			redirect('signin/login');
			die();
		}
	}
	function edit($id){
		if ($this->session->userdata('id')){
		} else {
			redirect('signin/login');
			die();
		}
	}
}