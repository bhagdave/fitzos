<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Members_model extends Fitzos_model { 
    function __construct()
    {
        parent::__construct('member');
    }
    function checkLogin($username,$password){
    	$this->db->select("email,salt,id");
    	$this->db->where('email',$username);
    	$this->db->where('password',$password);
    	$this->db->where('active','yes');
    	$result = $this->db->get('member');
    	$data = $result->result();
    	if (isset($data[0])){
    		return $data[0];
    	} else {
    		return null;
    	}
    }
    function getMemberType($id){
    	$this->db->select('athlete.id as athlete, trainer.id as trainer');
    	$this->db->from('member');
		$this->db->where('member.id',$id);
    	$this->db->join('athlete','athlete.member_id = member.id','left');
    	$this->db->join('trainer','trainer.member_id = member.id','left');
    	$result = $this->db->get();
    	$data   = $result->result();
    	if (isset($data[0])){
    		if (isset($data[0]->athlete)){
    			return 'athlete';
    		} else if (isset($data[0]->trainer)){
    			return 'trainer';
    		} else {
    			return 'athlete';
    		}
    	} else {
    		return 'athlete';
    	}
    }
	function createMember($data){
		$insert = array(
			'first_name'=>$data['name'],
			'last_name'=>'',
			'language'=>'english',
			'active'=>'no',	
			'salt'=>md5($data['name'] . 'english' . date('disu')),
			'email'=>$data['email'],
			'password'=>md5($data['password'])
		);
		$this->db->insert('member',$insert);
		$member = $this->db->insert_id();
		$insert = array(
			'name'=>$data['name'],
			'member_id'=>$member
		);
		$this->db->insert($data['choice'],$insert);
		return $member;
	}
	function checkIfMemberExists($data){
		$this->db->where('first_name', $data['name']);
		$count = $this->db->count_all_results('member');
		return ($count > 0);
	}
	function getMember($id){
		$member = $this->getCache('member_' . $id);
		if (isset($member)){
			return $member;
		} else {
			$this->db->where('id', $id);
			$result = $this->db->get('member');
			$data   = $result->result();
			if (isset($data[0])){
				$this->setCache('member_'. $id,$data[0]);
				return $data[0];
			} else {
				return null;
			}
		}
	}
	function activate($salt){
		$data = array('active'=>'yes');
		$this->db->where('salt',$salt);
		$this->db->update('member',$data);
		return ($this->db->affected_rows() > 0);	
	}
	function getSports($id){
		$member = $this->getCache('membersports_' . $id);
		if (isset($member)){
			return $member;
		} else {
			$this->db->select('sport.name as sport');
			$this->db->where('member_id', $id);
			$this->db->join('sport','sport.id = member_sports.member_id');
			$result = $this->db->get('member_sports');
			$data   = $result->result();
			if (isset($data[0])){
				$this->setCache('membersports_'. $id,$data[0]);
				return $data[0];
			} else {
				return null;
			}
		}
	}
	function addSport($data){
		$this->db->insert('member_sports',$data);
		return $this->db->last_insert_id();
	}
	
}
 
class Member_model extends Base_module_record {
 
}
