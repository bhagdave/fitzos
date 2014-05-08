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
	function getQualifications($id){
		$this->db->where('trainer_id',$id);
		$this->db->join('trainer_certificates','certificate_id = trainer_certificates.id');	
		$result = $this->db->get('trainer_qualifications');
		return $result->result();
	}
	function createCertificate($data){
		$this->db->insert('trainer_qualifications',$data);
		return $this->db->affected_rows();
	}
}
 
class Trainer_model extends Base_module_record {
 
}
