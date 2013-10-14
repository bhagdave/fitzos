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
			// post to the database baby...
			$data = $_POST;
			$data['id'] = $this->session->userdata('id');
			$this->athletes->saveProfile($data);
			$this->session->set_flashdata('message', 'Profile Saved');			
			$athlete = $this->athletes->loadProfile($data['id']);
		} else {
			if ($this->session->userdata('id')){
				// get the athlete from the database
				$id      = $this->session->userdata('id');
				$athlete = $this->athletes->loadProfile($id);
			} else {
				redirect('signin/login');
			}
		}
		if (isset($athlete)){
			$vars = array('athlete'=>$athlete);
			$vars['message'] = $this->session->flashdata('message');
			$this->fuel->pages->render('athlete/profile',$vars);	
		} else {
			redirect('signin/login');
		}			
	}
}
?>