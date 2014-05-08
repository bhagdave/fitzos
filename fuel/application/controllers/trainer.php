<?php
class Trainer extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('members_model','members');
		$this->load->model('events_model','events');
		$this->load->model('notifications_model','notify');
		$this->load->model('trainers_model','trainers');
	}
	private function _getCoreData($id){
		// get the athlete from the database
		$member  = $this->members->getMember($id);
		$events  = $this->events->getEventsForMember($id);
		$notifications = $this->notify->getNotifications('member',$id);
		$trainer = $this->trainers->loadProfile($id);
		return array(
				'member'=>$member,
				'notes'=>$notifications,
				'events'=>$events,
				'trainer'=>$trainer
		);
	}
	function index(){
		if ($this->session->userdata('id')){
			$vars = $this->_getCoreData($this->session->userdata('id'));
			$vars['id'] = $this->session->userdata('id');
			$this->fuel->pages->render('trainer/index',$vars);
		} else {
			redirect('signin/login');
		}
	}
	function profile(){
		if ($this->input->post('age')){
			$data = $this->input->post();
			$data['member_id'] = $this->session->userdata('id');
			$this->trainers->save($data);
			$this->session->set_flashdata('message', 'Profile Saved');
			redirect('trainer/index');	
		} else {
			if ($this->session->userdata('id')){
				$trainer = $this->trainers->loadProfile($this->session->userdata('id'));
				$vars = array('trainer'=>$trainer);
				$this->fuel->pages->render('trainer/profile',$vars);
			} else {
				redirect('signin/login');
			}
		}	
	}
	function certs(){
		if ($this->input->post('trainer_id')){
			$affected = $this->trainers->createCertificate($this->input->post());
			if ($affected > 0){
				$this->session->set_flashdata('message', 'Certificate Saved');
			} else {
				$this->session->set_flashdata('message', 'Error saving certificate');
			}
			redirect('trainer/certs');
		}
		if ($this->session->userdata('id')){
			$this->load->model('certificates_model','certificates');
			$vars = $this->_getCoreData($this->session->userdata('id'));
			$vars['quals'] = $this->trainers->getQualifications($vars['trainer']->id);
			$vars['id'] = $this->session->userdata('id');
			$vars['certificates'] = $this->certificates->options_list('id','name');
			$this->fuel->pages->render('trainer/certs',$vars);
		} else {
			redirect('signin/login');
		}
	}
}
?>