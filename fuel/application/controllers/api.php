<?php
class Api extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('Fitzos_utility',null,'Futility');
		$this->load->model("api_model","api");
	}
	
	private function convertMemberSaltToId($member){
		$memberId = $this->api->getMemberFromSalt($member);
		return $memberId;	
	}

	private function convertSaltToId($data, $field){
		if (isset($data[$field]) && !is_numeric($data[$field])){
			$data[$field] = $this->convertMemberSaltToId($data[$field]);
		}
		return $data;
	}

	private function convertAllSaltsToId($class,$method,$data){
		$data = $this->convertSaltToId($data,'member_id');
		$data = $this->convertSaltToId($data, 'id');
		$data = $this->convertSaltToId($data, 'from');
		$data = $this->convertSaltToId($data, 'owner');
		$data = $this->convertSaltToId($data, 'user');
		$data = $this->convertSaltToId($data, 'source_id');
		if ($class == 'teams'){
			$data['user'] = $this->convertMemberSaltToId($data['user']);
		}
		if ($class == 'athletes'){
			$data['source_id'] = $this->convertMemberSaltToId($data['source_id']);
		}

		return $data;
	} 
	
	private function doTheMethodCall($class,$method,$request){
		$data['data']     = $request;
		$reflectedMethod  = new ReflectionMethod($class.'_model', $method);
		$parametersToPass = array();
		foreach($reflectedMethod->getParameters() as $methodParameter){
			if (isset($data[$methodParameter->getName()])){
				$parametersTopass[] = $data[$methodParameter->getName()];
			} else {
				if($methodParameter->isOptional()){
					$parametersToPass[] = $methodParameter->getDefaultValue();
				}
			}
		}
		$result = $refclectedMethod->invokeArgs($this->$class, $parametersToPass);
		return $result;
	}
	
	public function request($model,$function){
		if ($this->checkSessionKey()){
			$request= $_REQUEST;
			unset($request['key']);
			$modelName = $model . '_model';
			$error = $this->load->model($modelName,$model);
			if (isset($error)){
				$request = $this->convertAllSaltsToId($model,$function,$request);
				$this->api->logEvent("$function on $model",print_r($request,true));
				$result = $this->doTheMethodCall($model, $function, $request);		
			} else {
				$result = null;
			}
			if (isset($result) && !empty($result)){
				$this->respond('OK', 'API Call worked',$result);
			} else {
				$this->respond('ERR', 'API Call worked but empty');
			}
		} else {
			$this->respond("ERR","Invalid Session Request", $this->input->get_post());
		}		
	}
	
	public function index($model,$function){
		$this->api->logEvent($model . '->' . $function,print_r($_REQUEST,true));
		if ($this->checkSessionKey($function)){
			$data = $_REQUEST;
			$modelName = $model . '_model';
			$err = $this->load->model($modelName,$model);
			if (isset($err)){
				if (isset($data['id'])){
					$data = $this->convertAllSaltsToId($model, $function, $data);
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
				$this->respond('OK', 'API Call worked',$result);
			} else {
				$this->api->logEvent($model . '->' . $function,'No Result and Failed!');
				$this->respond('ERR', 'API Call failed');
			}
		} else {
			$this->respond("ERR","Invalid Session Request", $this->input->get_post());
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

	public function rest($model,$id = null){
		if ($this->checkSessionKey()){
			parse_str(file_get_contents("php://input"),$put);
			$verb = $_SERVER['REQUEST_METHOD'];
			if ($verb === 'PUT'){
				$data = $put;
			} else {
				$data = $_REQUEST;
			}
			if (isset($data['key'])){
				unset($data['key']); // well we dont want to save it
			}
			$modelName = $model . '_model';
			$err = $this->load->model($modelName,$model);
			if (isset($err)){
				$method = $this->_getRestMethod($verb,$id);
				$data = $this->convertAllSaltsToId($model,$method,$data);
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
				$this->respond('OK', 'API Call worked',$result);
			} else {
				$this->respond('ERR', 'API Call failed');
			}
		} else {
			$this->respond("ERR","Invalid Session Request", $this->input->get_post());
		}
	}
	
	public function login(){
		$this->api->logEvent('login',print_r($_REQUEST,true));
		if ($this->checkSessionKey()){
			$this->load->model("members_model","members");
			$username = $this->input->get_post('username');
			$password = md5($this->input->get_post('password'));
	    	$this->api->logEvent('login',"username=$username");
			$login = $this->members->checkLogin($username, $password);
			if (isset($login)){
				$type = $this->members->getMemberType($login->id);
				$data = array('salt'=>$login->salt, 'type'=>$type);
				$this->respond('OK','Login Successful',$data);
			} else {
				$this->respond("ERR","Username or Password Invalid", $login);
			}
		} else {
			$this->respond("ERR","Invalid Session Request", $this->input->get_post());
		}
	}	
	private function respond($status,$message,$result = null){
		$returnData = array(
			'Status'=>$status,
			'Message'=>$message,
			'Result'=>$result
		);
		echo json_encode($returnData);
	}
	public function openSession(){
		$this->load->model("api_model","api");
		if ($this->input->get_post('name') && $this->input->get_post('key')){
			$name = $this->input->get_post('name');
			$key  = $this->input->get_post('key');
			$session_key = $this->api->openSession($name,$key,$_SERVER['REMOTE_ADDR']);
			if (isset($session_key)){
				$this->respond('OK','Session Successful',$session_key);
			} else {
				$this->respond("ERR","Invalid Session Request", $this->input->get_post());
			}
		} else {
				$this->respond("ERR","Invalid Session Request", $this->input->get_post());
		}
	}
	private function checkSessionKey($method = ''){
		if ($this->input->get_post('key')){
			$this->load->model("api_model","api");
			return $this->api->isValidSessionKey($method,$this->input->get_post('key'),null);
		} else {
			return false;
		}
	}
	public function createMember(){
		if ($this->checkSessionKey()){
			$mesg = $this->Futility->checkSignin($this->input->get_post());
			if (count($mesg)> 0){
				$this->respond("ERR","Sign up failed", $mesg);
			} else {
				$this->load->model("members_model","members");
				if ($this->members->checkIfMemberExists($data)){
					$mesg[] = 'That username is already taken.';
					$this->respond("ERR","Sign up failed", $mesg);
				} else {
					$id = $this->members->createMember($this->input->get_post());
					$member = $this->members->getMember($id);
					$this->load->library('Fitzos_email',null,'Femail');
					$this->Femail->sendMemberActivation($member);
					$this->respond("OK","Sign up worked", $id);
				}
			}
		} else {
			$this->respond("ERR","Invalid Session Request", $this->input->get_post());
		}
	}
	public function getMemberDetails($id){
		if ($this->checkSessionKey()){
		} else {
			$this->respond("ERR","Invalid Session Request", $this->input->get_post());
		}		
	}
	public function getAthleteDetails(){
		if ($this->checkSessionKey()){
			$this->load->model('athletes_model','athletes');
			$id = $_POST['id'];
			$athlete = $this->athletes->loadProfile($id);
			$this->respond("OK","Athlete Found",$athlete);
		} else {
			$this->respond("ERR","Invalid Session Request", $this->input->get_post());
		}		
	}
	public function saveAthleteDetails(){
		if ($this->checkSessionKey()){
		} else {
			$this->respond("ERR","Invalid Session Request", $this->input->get_post());
		}		
	}
	public function saveMemberDetails(){
		if ($this->checkSessionKey()){
		} else {
			$this->respond("ERR","Invalid Session Request", $this->input->get_post());
		}		
	}
}
