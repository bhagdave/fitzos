<?php
class Api extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('Fitzos_utility',null,'Futility');
	}
	
	function login(){
		if ($this->_checkSessionKey()){
			$this->load->model("api_model","api");
			$this->load->model("members_model","members");
			$username = $_REQUEST['username'];
			$password = md5($_REQUEST['password']);
	    	$this->api->logEvent('login',"username=$username");
			$login = $this->members->checkLogin($username, $password);
			if (isset($login)){
				unset($login->id);
				$this->_respond('OK','Login Successful',$login);
			} else {
				$this->_respond("ERR","Username or Password Invalid", $_REQUEST);
			}
		} else {
			$this->_respond("ERR","Invalid Session Request", $_REQUEST);
		}
	}	
	private function _respond($status,$message,$result = null){
		$returnData = array(
			'Status'=>$status,
			'Message'=>$message,
			'Result'=>$result
		);
		echo json_encode($returnData);
	}
	function openSession(){
		$this->load->model("api_model","api");
		if (isset($_REQUEST['name']) && isset($_REQUEST['key'])){
			$name = $_REQUEST['name'];
			$key  = $_REQUEST['key'];
			$session_key = $this->api->openSession($name,$key);
			if (isset($session_key)){
				$this->_respond('OK','Session Successful',$session_key);
			} else {
				$this->_respond("ERR","Invalid Session Request", $_REQUEST);
			}
		} else {
				$this->_respond("ERR","Invalid Session Request", $_REQUEST);
		}
	}
	private function _checkSessionKey(){
		if (isset($_REQUEST['access_name']) && isset($_REQUEST['api_key'])){
			$this->load->model("api_model","api");
			return $this->api->isValidSessionKey($_REQUEST['access_name'],$_REQUEST['api_key']);
		} else {
			return false;
		}
	}
	function createMember(){
		if ($this->_checkSessionKey()){
			$mesg = $this->Futility->checkSignin($_REQUEST);
			if (count($mesg)> 0){
				// show error
				$this->respond("ERR","Sign up failed", $mesg);
			} else {
				// Put the stuff into the database
				$this->load->model("members_model","members");
				if ($this->members->checkIfMemberExists($data)){
					$mesg[] = 'That username is already taken.';
					$this->respond("ERR","Sign up failed", $mesg);
				} else {
					$id = $this->members->createMember($_REQUEST);
					// Send email to user to activate account...
					$this->load->library('Fitzos_email',null,'Femail');
					$this->Femail->sendMemberActivation($id);
					$this->respond("OK","Sign up worked", $id);
				}
			}
		} else {
			$this->_respond("ERR","Invalid Session Request", $_REQUEST);
		}
	}
}