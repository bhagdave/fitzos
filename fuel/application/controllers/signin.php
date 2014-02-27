<?php
class Signin extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('Fitzos_utility',null,'Futility');
		$this->load->library('session');
	}
	
	function start(){
		$mesg = $this->Futility->checkSignin($_REQUEST);
		if (count($mesg)> 0){
			// show error
			$vars = array('messages'=>$mesg, 'request'=>$_REQUEST);
			$this->fuel->pages->render('signin/error',$vars);
		} else {
			// Put the stuff into the database
			$this->load->model("members_model","members");
			if ($this->members->checkIfMemberExists($_REQUEST)){
				$mesg[] = 'That username is already taken.';
				redirect('/');
			} else {
				$id = $this->members->createMember($_REQUEST);
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
		$this->load->model("members_model","members");
		if (isset($_REQUEST['username']) && isset($_REQUEST['password'])){
			$username = $_REQUEST['username'];
			$password = md5($_REQUEST['password']);
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
				$vars = array('message'=>"Username/Password Invalid", 'request'=>$_REQUEST);
				$this->fuel->pages->render('signin/loginError',$vars);
			}			
		} else {
			$vars = array('message'=>"", 'request'=>$_REQUEST);
			$this->fuel->pages->render('signin/login',$vars);
		}
	}	
	function activate($salt){
		$this->load->model("members_model","members");
		$activated = $this->members->activate($salt);
		if ($activated){
			$this->fuel->pages->render("signin/activationSuccess" );
		} else {
			$this->fuel->pages->render("signin/activationError" );
		}
	}
	function invite(){
		if (isset($_POST['email'])){
			// let us send an invite email..
			$user = $this->session->userdata('id');
			$this->load->model("members_model","members");
			$member = $this->members->getMember($user);
			$this->load->library('Fitzos_email',null,'Femail');
			$this->Femail->sendMemberInvite($member,$_POST['email']);
		}
	}
}
?>