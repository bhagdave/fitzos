<?php
class Signin extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('Fitzos_utility',null,'Futility');
		$this->load->library('session');
		$this->load->model("members_model","members");
	}
	
	function start(){
		$mesg = $this->Futility->checkSignin($this->input->post());
		if (count($mesg)> 0){
			// show error
			$vars = array('messages'=>$mesg, 'request'=>$this->input->post());
			$this->fuel->pages->render('signin/error',$vars);
		} else {
			// Put the stuff into the database
			if ($this->members->checkIfMemberExists($this->input->post())){
				$this->session->set_flashdata('message','That email address already taken.');
				redirect('/');
			} else {
				$id = $this->members->createMember($this->input->post());
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
		$url = $this->input->get('url');
		if ($this->input->post('username') && $this->input->post('password')){
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$url      = $this->input->post('url');
			$login    = $this->members->checkLogin($username, $password);
			if (isset($login)){
				// get the member type and go the right way...
				$type = $this->members->getMemberType($login->id);
				$this->session->set_userdata(array('user'=>$login->salt,'type'=>$type, 'id'=>$login->id));
				if (isset($url)){
					redirect($url);
				}
				if ($type == 'athlete' || $type == 'both'){
					redirect('athlete/index');					
				} else {
					redirect('trainer/index');					
				}
				$this->fuel->pages->render("signin/athlete");
			} else {
				$vars = array('message'=>"Username/Password Invalid", 'request'=>$this->input->post());
				$this->fuel->pages->render('signin/loginError',$vars);
			}			
		} else {
			$vars = array('message'=>"", 'url'=>$url,'request'=>$this->input->post());
			$this->fuel->pages->render('signin/login',$vars);
		}
	}	
	function activate($salt){
		$activated = $this->members->activate($salt);
		if ($activated){
			$type = $this->members->getMemberType($activated->id);
			$this->session->set_userdata(array('user'=>$activated->salt,'type'=>$type, 'id'=>$activated->id));
			$this->fuel->pages->render("signin/activationSuccess",array('member'=>$activated, 'type'=>$type) );
		} else {
			$this->fuel->pages->render("signin/activationError" );
		}
	}
	function invite(){
		if ($this->input->post('email')){
			// let us send an invite email..
			$user = $this->session->userdata('id');
			$member = $this->members->getMember($user);
			$this->load->library('Fitzos_email',null,'Femail');
			$emailed = $this->Femail->sendMemberInvite($member,$this->input->post('email'));
			if ($emailed){
				$this->session->set_flashdata('message','Email request sent!');
			} else {
				$this->session->set_flashdata('message','Email request failed to send');
			}
		}
	}
	function forgotPassword(){
		if ($this->input->post('email')){
			$update = $this->members->resetpassword($this->input->post('email'));
			if ($update['success']){
				$this->load->library('Fitzos_email',null,'Femail');
				$emailed = $this->Femail->sendPasswordReset($update['member'],$update['member']->email,$update['password']);
				$this->fuel->pages->render('signin/passwordReset');
			} else {
				$this->fuel->pages->render('signin/passwordResetError');
			}
		} else {
			$this->fuel->pages->render('signin/forgotPassword');
		}
	}
}
?>