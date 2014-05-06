<?php
class Event extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('events_model');
		$this->load->model('teams_model');
		$this->load->model('athletes_model');
	}
	function view($id){
		if ($this->session->userdata('id')){
			$user = $this->session->userdata('id');
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
				// get those already invited
				$invited = $this->events_model->getInvitedMembers($event->id);
				// get the team members
				$members = $this->events_model->getTeamMembersToInvite($event->team_id,$event->id);
	 			$wall  = $this->events_model->getWall($id);
	 			$owner = $this->events_model->isOwner($id,$user);
				$vars = array(
						'team'=>$team,
						'wall'=>$wall,
						'owner'=>$owner,
						'members'=>$members, 
						'edit'=>$edit, 
						'event'=>$event,
						'attending'=>$attending,
						'user'=>$user,
						'invited'=>$invited);
				$this->fuel->pages->render('event/view',$vars);
			} else {
				redirect('404');
				die();
			}
		} else {
			redirect('signin/login?url=event/view/'.$id);
			die();
		}
	}
	function attendEvent($event,$member){
		if ($this->session->userdata('id')){
			$user = $this->session->userdata('id');
			if ($this->events_model->setAttendEvent($event,$member)){
				$message = 'Attendance accepted';
			} else {
				$message = 'Attendance rejected';
			}
			$attending = $this->events_model->getMembersAttending($event);
			$event = $this->events_model->getEvent($event);
			if ($event->member_id == $user){
				$edit = true;
			}else {
				$edit = false;
			}
			$vars = array('message'=>$message,'attending'=>$attending,'event'=>$event,'layout'=>'none','edit'=>$edit);
			$this->fuel->pages->render('event/attending',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
	function removeAttendee($event, $member){
		if ($this->session->userdata('id')){
			$user = $this->session->userdata('id');
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
			if ($this->input->post('team_id')){
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
						$data = $this->input->post();
						$data['image'] =$path;
					}
				}
				// lets add the member id for the person adding the event
				$user = $this->session->userdata('id');
				$data['member_id'] = $user;
				$this->events_model->updateEvent($data);
				redirect('event/view/' . $data['id']);
			} else {
				$user = $this->session->userdata('id');
				$event = $this->events_model->getEvent($id);
				$vars = array('event'=>$event);
				$this->fuel->pages->render('event/edit',$vars);
			}
		} else {
			redirect('signin/login?url=event/edit/'.$id);
			die();
		}
	}
	function delete($id){
		$this->events->deleteEvent($id);
	}
	function sendInvites($event){
		$this->load->model('events_model');
		if ($this->session->userdata('id')){
			if (isset($_POST)){
				$user = $this->session->userdata('id');
				foreach($_POST as $key=>$member){
					$memberId = str_replace('mmbrd','',$key);
					$this->events_model->sendInvite($memberId,$user,$event);
				}
				// get the event
				$eventData = $this->events_model->getEvent($event);
				// get those already invited/attending
				$attending = $this->events_model->getMembersAttending($event);
				$invited = $this->events_model->getInvitedMembers($eventData->id);
				// get the team members
				$members = $this->events_model->getTeamMembersToInvite($eventData->team_id,$eventData->id);
				$vars = array('layout'=>'none','ajax'=>'yes','members'=>$members,'event'=>$eventData,'attending'=>$attending,'user'=>$user,'invited'=>$invited);
				$this->fuel->pages->render('event/invitation',$vars);
			}
		} else {
			redirect('signin/login');
			die();
		}
	}
	function getWall($event){
		if ($this->session->userdata('id')){
	 		$wall  = $this->events_model->getWall($event);
	 		$owner = $this->events_model->isOwner($event,$this->session->userdata('id'));
			$data  = $this->events_model->getEvent($event);
	 		$vars  = array('wall'=>$wall,'owner'=>$owner,'layout'=>'none','event'=>$data);
			$this->fuel->pages->render('event/eventWall',$vars);			
		} else {
			redirect('signin/login');
			die();
		}					
	}
	function deleteWallPost($event,$post){
		if ($this->session->userdata('id')){
			$this->events_model->deletePost($event,$post);
			$this->getWall($event);
		} else {
			redirect('signin/login');
			die();
		}					
	}
	function addWallPost(){
		$this->load->model('teams_model','teams');
		if ($this->input->post()){
			if ($this->session->userdata('id')){
				$user = $this->session->userdata('id');
				// check if owner of team..
				$data = array(
						'event_id'=>$this->input->get_post('event_id'), 
						'message'=>$this->input->get_post('message'), 
						'member_id'=>$user);
				$id   = $this->events_model->addWallPost($data);
				$this->getWall($this->input->get_post('event_id'));
			} else {
				redirect('signin/login');
				die();
			}
		}
	}
}