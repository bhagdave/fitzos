<?php
class Api extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('Fitzos_utility',null,'Futility');
	}
	
	function index($model,$function){
		if ($this->_checkSessionKey($function)){
			$data = $_REQUEST;
			$modelName = $model . '_model';
			$err = $this->load->model($modelName,$model);
			if (isset($err)){
				if (isset($data['id'])){
					$result = $this->$model->$function($data['id']);
				} else {
					$result = $this->$model->$function($data);
				}
			} else {
				$result = null;
			}
			if (isset($result) && !empty($result)){
				$this->_respond('OK', 'API Call worked',$result);
			} else {
				$this->_respond('ERR', 'API Call failed');
			}
		} else {
			$this->_respond("ERR","Invalid Session Request", $this->input->get_post());
		}
	}
	
	private function _getRestMethod($verb,$id = null){
		if ($verb === 'DELETE'){
			return 'delete';
		}
		if ($verb === 'PUT'){
			return 'update';
		}
		if ($verb === 'POST'){
			return 'create';
		}
		if ($verb === 'GET'){
			if (isset($id)){
				return 'find_one';
			} else {
				return 'find_all';
			}
		}
	}

	function rest($model,$id = null){
		parse_str(file_get_contents("php://input"),$put);
		$verb = $_SERVER['REQUEST_METHOD'];
		if ($verb === 'PUT'){
			$data = $put;
		} else {
			$data = $_REQUEST;
		}
		$modelName = $model . '_model';
		$err = $this->load->model($modelName,$model);
		if (isset($err)){
			$method = $this->_getRestMethod($verb,$id);
			if (isset($id)){
				$result = $this->$model->$method($id);
			} else {
				if ($verb === 'POST' || $verb === 'PUT'){
					$result = $this->$model->$method($data);
				} else {
					$result = $this->$model->$method($id);
				}
			}
		} else {
			$result =  null;
		}
		if (isset($result)){
			$this->_respond('OK', 'API Call worked',$result);
		} else {
			$this->_respond('ERR', 'API Call failed');
		}
	}
	
	function login(){
		if ($this->_checkSessionKey('login')){
			$this->load->model("api_model","api");
			$this->load->model("members_model","members");
			$username = $this->input->get_post('username');
			$password = md5($this->input->get_post('password'));
	    	$this->api->logEvent('login',"username=$username");
			$login = $this->members->checkLogin($username, $password);
			if (isset($login)){
				$type = $this->members->getMemberType($login->id);
				$data = array('salt'=>$login->salt, 'type'=>$type);
				$this->_respond('OK','Login Successful',$data);
			} else {
				$this->_respond("ERR","Username or Password Invalid", $login);
			}
		} else {
			$this->_respond("ERR","Invalid Session Request", $this->input->get_post());
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
		if ($this->input->get_post('name') && $this->input->get_post('key')){
			$name = $this->input->get_post('name');
			$key  = $this->input->get_post('key');
			$session_key = $this->api->openSession($name,$key,$_SERVER['REMOTE_ADDR']);
			if (isset($session_key)){
				$this->_respond('OK','Session Successful',$session_key);
			} else {
				$this->_respond("ERR","Invalid Session Request", $this->input->get_post());
			}
		} else {
				$this->_respond("ERR","Invalid Session Request", $this->input->get_post());
		}
	}
	private function _checkSessionKey($method){
		if ($this->input->get_post('key') && $this->input->get_post('signature')){
			$this->load->model("api_model","api");
			return $this->api->isValidSessionKey($method,$this->input->get_post('key'),$this->input->get_post('signature'));
		} else {
			return false;
		}
	}
	function createMember(){
		if ($this->_checkSessionKey()){
			$mesg = $this->Futility->checkSignin($this->input->get_post());
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
					$id = $this->members->createMember($this->input->get_post());
					$member = $this->members->getMember($id);
					// Send email to user to activate account...
					$this->load->library('Fitzos_email',null,'Femail');
					$this->Femail->sendMemberActivation($member);
					$this->respond("OK","Sign up worked", $id);
				}
			}
		} else {
			$this->_respond("ERR","Invalid Session Request", $this->input->get_post());
		}
	}
	function getMemberDetails($id){
		if ($this->_checkSessionKey()){
		} else {
			$this->_respond("ERR","Invalid Session Request", $this->input->get_post());
		}		
	}
	function getAthleteDetails(){
		if ($this->_checkSessionKey()){
			$this->load->model('athletes_model','athletes');
			$id = $_POST['id'];
			$athlete = $this->athletes->loadProfile($id);
			$this->_respond("OK","Athlete Found",$athlete);
		} else {
			$this->_respond("ERR","Invalid Session Request", $this->input->get_post());
		}		
	}
	function saveAthleteDetails(){
		if ($this->_checkSessionKey()){
		} else {
			$this->_respond("ERR","Invalid Session Request", $this->input->get_post());
		}		
	}
	function saveMemberDetails(){
		if ($this->_checkSessionKey()){
		} else {
			$this->_respond("ERR","Invalid Session Request", $this->input->get_post());
		}		
	}
}