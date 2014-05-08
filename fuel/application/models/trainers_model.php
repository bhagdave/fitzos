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
	function saveSpecialties($data,$id){
		$this->db->where('trainer_id',$id);
		$this->db->delete('trainer_specialties');
		$insert = array();
		foreach($data as $key => $value){
			$insert[] = array('trainer_id'=>$id,'specialty_id'=>$key);
		}
		$this->db->insert_batch('trainer_specialties',$insert);	
	}
	function getSpecialties($id){
		$this->db->where('trainer_id',$id);
		$this->db->select('specialty_id');
		$result = $this->db->get('trainer_specialties');
		$data =  $result->result_array();
		foreach($data as $id => $arrData){
			foreach($arrData as $key => $value)
				$return[$value] = $value;
		}
		return $return;
	}
}
 
class Trainer_model extends Base_module_record {
 
}
