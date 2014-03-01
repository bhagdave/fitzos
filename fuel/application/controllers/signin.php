<?php
class Signin extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('Fitzos_utility',null,'Futility');
		$this->load->library('session');
		$this->load->model("members_model","members");
	}
	
	function start(){
		$mesg = $this->Futility->checkSignin($this->input->get_post());
		if (count($mesg)> 0){
			// show error
			$vars = array('messages'=>$mesg, 'request'=>$this->input->get_post());
			$this->fuel->pages->render('signin/error',$vars);
		} else {
			// Put the stuff into the database
			if ($this->members->checkIfMemberExists($this->input->get_post())){
				$mesg[] = 'That username is already taken.';
				redirect('/');
			} else {
				$id = $this->members->createMember($this->input->get_post());
				$member = $this->members->getMember($id);
				// Send email to user to activate account...
				$this->load->library('Fitzos_email',null,'Femail');
				$this->Femail->sendMemberActivation($member);
				$this->fuel->pages->render("signin/activationPending" );
			}
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}
	function login(){
		if ($this->input->get_post('username') && $this->input->get_post('password')){
			$username = $this->input->get_post('username');
			$password = md5($this->input->get_post('password'));
			$login    = $this->members->checkLogin($username, $password);
			if (isset($login)){
				// get the member type and go the right way...
				$type = $this->members->getMemberType($login->id);
				$this->session->set_userdata(array('user'=>$login->salt,'type'=>$type, 'id'=>$login->id));
				if ($type == 'athlete' || $type == 'both'){
					redirect('athlete/index');					
				} else {
					redirect('trainer/index');					
				}
				$this->fuel->pages->render("signin/athlete");
			} else {
				$vars = array('message'=>"Username/Password Invalid", 'request'=>$this->input->get_post());
				$this->fuel->pages->render('signin/loginError',$vars);
			}			
		} else {
			$vars = array('message'=>"", 'request'=>$this->input->get_post());
			$this->fuel->pages->render('signin/login',$vars);
		}
	}	
	function activate($salt){
		$activated = $this->members->activate($salt);
		if ($activated){
			$this->fuel->pages->render("signin/activationSuccess" );
		} else {
			$this->fuel->pages->render("signin/activationError" );
		}
	}
	function invite(){
		if ($this->inout->post('email')){
			// let us send an invite email..
			$user = $this->session->userdata('id');
			$member = $this->members->getMember($user);
			$this->load->library('Fitzos_email',null,'Femail');
			$this->Femail->sendMemberInvite($member,$this->inout->post('email'));
		}
	}
}
?>