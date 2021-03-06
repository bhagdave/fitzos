<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH.'models/base_module_model.php');

class Api_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('api_access');
    }
    function openSession($name,$key,$ipAddress = ''){
    	$this->logEvent('OpenSession',"name=$name&key=$key");
    	$this->db->select("name,session_key,key");
    	$this->db->where('name',$name);
    	$result = $this->db->get('api_access');
    	$data = $result->result();
    	//echo($data[0]->hash);
    	if (isset($data[0])){
    		$hash = md5($data[0]->key . $data[0]->name);
    		if (strtoupper($hash) == strtoupper($key)){
    			// lets create a session key and wack it in to the session table....
    			$session_key = md5("name=$name&key=". $data[0]->session_key . date("H:i:s"));
    			// create the session key and timestamp
    			$this->db->insert('session',array('session_name'=>$name,'ip_address'=>$ipAddress,'session_key'=>$session_key,'timestamp'=>date("Y-m-d H:i:s")));
    			return $session_key;
    		} else {
    			$this->logEvent('OpenSession Failed',"name=$name&key=$key&hash=$hash");
    			return null;
    		}
    	} else {
    		$this->logEvent('OpenSession Failed',"name=$name&key=$key");
    		return null;
    	}
    }
	function logEvent($event, $message){
		$message = substr($message,0,144);
		$insert = array('event'=>$event,'message'=>$message, 'time'=>date("Y-m-d H:i:s"));
		$this->db->insert('api_log',$insert);
	}
	function isValidSessionKey($method,$key, $signature=null){
		$this->logEvent('isValidSessionKey',"Method=$method Key=$key");
    	$this->db->where('session.session_key',strtolower($key));
//     	$this->db->where('session.timestamp >','now() + interval - 1 hour',false);
    	$result = $this->db->get('session');
    	$data = $result->result();
    	if (isset($data[0])){
    		return true;
    	} else {
    		return false;
    	}
	}
	function getMemberFromSalt($salt){
		$this->db->where('salt',$salt);
		$result = $this->db->get('member');
		$data = $result->result();
		if (isset($data[0])){
			return $data[0]->id;
		} else {
			return null;
		}
	}
}