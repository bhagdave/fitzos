<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Trainers_model extends Fitzos_model {
 
    function __construct()
    {
        parent::__construct('trainer');
    }
    
    function loadProfile($id){
    	$this->db->where('member_id',$id);
    	$result = $this->db->get('trainer');
    	$data = $result->result();
    	if (isset($data[0])){
    		return $data[0];
    	} else {
    		return null;
    	}
    }
}
 
class Trainer_model extends Base_module_record {
 
}
