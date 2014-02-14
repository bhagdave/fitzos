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
				// get the team
				$team = $this->teams_model->getTeam($event->team_id);
				$edit = false;
				if ($event->member_id == $user){
					$edit = true;
				}
				// lets get a list of those attending
				$attending = $this->events_model->getMembersAttending($event->id);
				// get the team members
				$members = $this->teams_model->getTeamMembers($event->team_id);
				$vars = array('team'=>$team,'members'=>$members, 'edit'=>$edit, 'event'=>$event,'attending'=>$attending,'user'=>$user);
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
	function attendEvent($event,$member){
		if ($this->session->userdata('id')){
			$user = $this->session->userdata('id');
			$this->load->model('events_model');
			$this->events_model->setAttendEvent($event,$member);
			$attending = $this->events_model->getMembersAttending($event);
			$event = $this->events_model->getEvent($event);
			if ($event->member_id == $user){
				$edit = true;
			}else {
				$edit = false;
			}
			$vars = array('attending'=>$attending,'layout'=>'none','edit'=>$edit);
			$this->fuel->pages->render('event/attending',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
	function removeAttendee($event, $member){
		if ($this->session->userdata('id')){
			$user = $this->session->userdata('id');
			$this->load->model('events_model');
			$this->events_model->rejectAttendee($event,$member);
			$attending = $this->events_model->getMembersAttending($event);
			$event = $this->events_model->getEvent($event);
			if ($event->member_id == $user){
				$edit = true;
			}else {
				$edit = false;
			}
			$vars = array('attending'=>$attending,'layout'=>'none','edit'=>$edit);
			$this->fuel->pages->render('event/attending',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
	function edit($id){
		if ($this->session->userdata('id')){
			$this->load->model('events_model');
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
				// lets add the member id for the person adding the event
				$user = $this->session->userdata('id');
				$_POST['member_id'] = $user;
				$this->events_model->updateEvent($_POST);
				redirect('event/view/' . $_POST['id']);
			} else {
				$user = $this->session->userdata('id');
				$event = $this->events_model->getEvent($id);
				$vars = array('event'=>$event);
				$this->fuel->pages->render('event/edit',$vars);
			}
		} else {
			redirect('signin/login');
			die();
		}
	}
	function delete($id){
		$this->load->model('events_model','events');
		$this->events->deleteEvent($id);
	}
	function sendInvites(){
		if ($this->session->userdata('id')){
			if (isset($_POST)){
				$this->load->model('events_model');
				foreach($_POST as $member){
					$memberId = str_replace('mmbrd','',$member);
					$this->events_model->sendInvite($memberId);
				}
			}
		} else {
			redirect('signin/login');
			die();
		}
	}
}