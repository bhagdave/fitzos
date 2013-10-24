<?php 
class Athlete extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
	}
	function index(){
		if ($this->session->userdata('id')){
			$this->load->model('athletes_model','athletes');
			$this->load->model('members_model','members');
			// get the athlete from the database
			$id      = $this->session->userdata('id');
			$athlete = $this->athletes->loadProfile($id);
			$member  = $this->members->getMember($id);
		} else {
			redirect('signin/login');
			die();
		}
		$vars = array('athlete'=>$athlete,'member'=>$member);
		$this->fuel->pages->render('athlete/welcome',$vars);
	}
	function signUp(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
	}
	function portal(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function calendar(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function events(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function badges(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function plans(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function messages(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function progress(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function profile(){
		$this->load->model('athletes_model','athletes');
		if (isset($_POST['age'])){	
			$this->load->model('members_model','members');
			// post to the database baby...
			$data = $_POST;
			$data['id'] = $this->session->userdata('id');
			$this->athletes->saveProfile($data);
			$this->session->set_flashdata('message', 'Profile Saved');			
			$athlete = $this->athletes->loadProfile($data['id']);
			// get the athlete from the database
			$member  = $this->members->getMember($data['id']);
			$vars = array('athlete'=>$athlete,'member'=>$member);
			$this->fuel->pages->render('athlete/welcome',$vars);
		} else {
			if ($this->session->userdata('id')){
				// get the athlete from the database
				$id      = $this->session->userdata('id');
				$athlete = $this->athletes->loadProfile($id);
				if (isset($athlete)){
					$vars = array('athlete'=>$athlete);
					$vars['message'] = $this->session->flashdata('message');
					$this->fuel->pages->render('athlete/profile',$vars);	
				} else {
					redirect('signin/login');
				}			
			} else {
				redirect('signin/login');
			}
		}
	}
	function sports(){
		$this->load->model('athletes_model','athletes');
		$this->load->model('members_model','members');
		$this->load->model('sports_model','sports');
		$vars = array();
		if (isset($_POST['member_id'])){
			// new sport lets take it...
			$data = $_POST;
			$id = $this->members->addSport($data);
			if ($id > 0){
				$vars['message'] = "Sport added to your profile!";				
			} else {
				$vars['message'] = "Unable to add sport to your profile!";				
			}				
		}
		if ($this->session->userdata('id')){
			// get the athlete from the database
			$id      = $this->session->userdata('id');
			$athlete = $this->athletes->loadProfile($id);
			// let us get all of the sports man....
			// Lets us get the sports attached to the member
			$athlete_sports = $this->members->getSports($id, false);
			$sports = $this->sports->list_items();
			if (isset($athlete)){
				$vars['athlete']=$athlete;
				$vars['sports']=$sports; 
				$vars['members_sports']=$athlete_sports;
				$this->fuel->pages->render('athlete/sports',$vars);	
			} else {
				redirect('signin/login');
			}			
		} else {
			redirect('signin/login');
		}
	}	
}
?>