<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH.'models/base_module_model.php');

class Api_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('api_access');
    }
    function openSession($name,$key){
    	$this->logEvent('OpenSession',"name=$name&key=$key");
    	$this->db->select("name,session_key");
    	$this->db->where('name',$name);
    	$this->db->where('key',$key);
    	$result = $this->db->get('api_access');
    	$data = $result->result();
    	if (isset($data[0])){
    		return $data[0]->session_key;
    	} else {
    		$this->logEvent('OpenSession Failed',"name=$name&key=$key");
    		return null;
    	}
    }
	function logEvent($event, $message){
		$insert = array('event'=>$event,'message'=>$message, 'time'=>date("Y-m-d H:i:s"));
		$this->db->insert('api_log',$insert);
	}
	function isValidSessionKey($name,$key){
    	$this->db->where('name',$name);
    	$this->db->where('session_key',$key);
    	$result = $this->db->get('api_access');
    	$data = $result->result();
    	if (isset($data[0])){
    		return true;
    	} else {
    		return false;
    	}
	}
}