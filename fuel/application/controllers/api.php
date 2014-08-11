<?php
class Api extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('Fitzos_utility',null,'Futility');
		$this->load->model("api_model","api");
	}
	
	private function _convertMemberSaltToId($member){
		$memberId = $this->api->getMemberFromSalt($member);
		return $memberId;	
	}
	
	private function doTheMethodCall($class,$method,$data){
		if (isset($data['signature'])){
			unset($data['signature']);	
		}
		if (isset($data['key'])){
			unset($data['key']);	
		}
		$data['data'] = $data;
		$r = new ReflectionMethod($class.'_model', $method);
		$pass = array();
		foreach($r->getParameters() as $param){
			if (isset($data[$param->getName()])){
				$pass[] = $data[$param->getName()];
			} else {
				if($param->isOptional()){
					$pass[] = $param->getDefaultValue();
				}
			}
		}
		$result = $r->invokeArgs($this->$class, $pass);
		return $result;
	}
	
	function r($model,$function){
		$data = $_REQUEST;
		$modelName = $model . '_model';
		$this->api->logEvent($model . '->' . $function,print_r($data,true));
		$err = $this->load->model($modelName,$model);
		if (isset($err)){
			if (isset($data['member_id']) && !is_numeric($data['member_id'])){
				// convert salt to memberid
				$data['member_id'] = $this->_convertMemberSaltToId($data['member_id']);
			}
			if (isset($data['id']) && !is_numeric($data['id'])){
				// convert salt to memberid
				$data['id'] = $this->_convertMemberSaltToId($data['id']);
			}
			if (isset($data['from']) && !is_numeric($data['from'])){
				// convert salt to memberid
				$data['from'] = $this->_convertMemberSaltToId($data['from']);
			}
			$result = $this->doTheMethodCall($model, $function, $data);		
		} else {
			$result = null;
		}
		$this->_respond('OK', 'API Call worked',$result);
	}
	
	function index($model,$function){
//		$this->api->logEvent($model . '->' . $function,print_r($_REQUEST,true));
//		if ($this->_checkSessionKey($function)){
			$data = $_REQUEST;
			$modelName = $model . '_model';
			$err = $this->load->model($modelName,$model);
			if (isset($err)){
				if (isset($data['id'])){
					// if the id is not a number then treat it as a salt.
					if (!is_numeric($data['id'])){
						// convert salt to memberid
						$data['id'] = $this->_convertMemberSaltToId($data['id']);
					}
					if (isset($data['member_id']) && !is_numeric($data['member_id'])){
						// convert salt to memberid
						$data['member_id'] = $this->_convertMemberSaltToId($data['member_id']);
					}
//					$this->api->logEvent($model . '->' . $function . ' PRECALL',print_r($data,true));
//					$result = $this->doTheMethodCall($model, $function, $data);
 					$result = $this->$model->$function($data['id']);
				} else {
					$result = $this->$model->$function($data);
				}
			} else {
				$result = null;
			}
			$this->api->logEvent($model . '->' . $function . ' RESULT',print_r($result,true));
			if (isset($result) && !empty($result)){
				$this->api->logEvent($model . '->' . $function,'Result Returned!');
				$this->_respond('OK', 'API Call worked',$result);
			} else {
				$this->api->logEvent($model . '->' . $function,'No Result and Failed!');
				$this->_respond('ERR', 'API Call failed');
			}
// 		} else {
// 			$this->_respond("ERR","Invalid Session Request", $this->input->get_post());
// 		}
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
		// frig the ids if they are salted
		if (isset($data['id']) && !is_numeric($data['id'])){
			// convert salt to memberid
			$data['id'] = $this->_convertMemberSaltToId($data['id']);
		}
		if (isset($data['member_id']) && !is_numeric($data['member_id'])){
			// convert salt to memberid
			$data['member_id'] = $this->_convertMemberSaltToId($data['member_id']);
		}
		if (isset($data['owner']) && !is_numeric($data['owner'])){
			// convert salt to memberid
			$data['owner'] = $this->_convertMemberSaltToId($data['owner']);
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
}