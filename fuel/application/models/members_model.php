<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Members_model extends Fitzos_model { 
	// todo : accepFriendRequest
	// todo : declineFriendRequest
    function __construct()
    {
        parent::__construct('member');
    }
    function checkLogin($username,$password){
    	$this->db->select("email,salt,id");
    	$this->db->where('email',$username);
//    	$this->db->where('password',$password);
//    	$this->db->where('active','yes');
    	$result = $this->db->get('member');
    	$data = $result->result();
    	if (isset($data[0])){
    		return $data[0];
    	} else {
    		return null;
    	}
    }
    function acceptFriendRequest($id){
    	return ($this->setFriendStatus($id,'accepted'));
    }
    private function setFriendStatus($id,$status){
    	$this->db->where('friend_id',$id);
    	$this->db->update('friend',array(
    			'status'=>$status
    	));
    	return ($this->db->affected_rows() > 0);
    }
    function declineFriendRequest($id){
    	return ($this->setFriendStatus($id,'rejected'));
    }
    function setFriendRequest($to,$from){
    	$this->db->insert('friend',array(
    		'member_id_requested'=>$to,
    		'member_id_requestee'=>$from,
    		'status'=>'requested',
    		'requested'=>date('Y-m-d')
    	));
    	return $this->db->insert_id();
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
	function getSports($id, $useCache = true){
		if ($useCache){
			$member = $this->getCache('membersports_' . $id);
		}
		if (isset($member)){
			return $member;
		} else {
			$this->db->select('sport.id as id,sport.name as sport,from_date,to_date');
			$this->db->where('member_id', $id);
			$this->db->join('sport','sport.id = member_sports.sport_id');
			$result = $this->db->get('member_sports');
			$data   = $result->result();
			if (isset($data[0])){
				$this->setCache('membersports_'. $id,$data);
				return $data;
			} else {
				return null;
			}
		}
	}
	function addSport($data){
		// check if it already exists first
		$this->db->where('member_id',$data['member_id']);
		$this->db->where('sport_id',$data['sport_id']);
		if ($this->db->count_all_results('member_sports')== 0){
			// lets frig those dates baby..
			if (strtotime($data['from_date'])){
				$data['from_date'] = date('Y-m-d',strtotime($data['from_date']));
			} else {
				unset($data['from_date']);
			}
			if (strtotime($data['to_date'])){
				$data['to_date'] = date('Y-m-d',strtotime($data['to_date']));
			} else {
				unset($data['to_date']);
			}
			$this->db->insert('member_sports',$data);
			return $this->db->insert_id();
		}
	}
	function getFriends($id){
		$id = mysql_real_escape_string($id);
		$this->db->select("CASE $id when member_id_requested then member_id_requestee else member_id_requested end 'friend'",false);
		$this->db->distinct();
		$this->db->where('status','accepted');
		$this->db->where("$id in (member_id_requested,member_id_requestee)",null,false);
		$result = $this->db->get('friend');
//		echo($this->db->last_query());
		$friends = $result->result_array();
		$friendList = array();
		foreach($friends as $friend){
			foreach($friend as $key => $value){
				$friendList[] = $value;
			}
		}
		if (isset($friendList) && count($friendList) > 0){
			$this->db->where_in('id',$friendList);
			$result = $this->db->get('member');
			$data = $result->result();
			return $data;
		} else {
			return null;
		}
	}
	function saveMember($data){
		// check if they exist..
		$this->db->where('id',$data['id']);
		$count = $this->db->count_all_results('member');
		if ($count > 0){
			// if they do update
			$this->db->where('id',$data['id']);
			$this->db->update('member',$data);		
		} else {
			// if not then create
			$this->createMember($data);		
		}
	}	
}
 
class Member_model extends Base_module_record {
 
}
