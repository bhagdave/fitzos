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
    function isFriends($id,$user){
    	$this->db->where('member_id_requested',$id);
    	$this->db->where('member_id_requestee',$user);
    	$num = $this->db->count_all_results('friend');
    	$this->db->where('member_id_requested',$user);
    	$this->db->where('member_id_requestee',$id);
    	$num += $this->db->count_all_results('friend');
    	return ($num > 0);
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
    function getFriendRequest($id){
    	$this->db->where('friend_id',$id);
    	$result = $this->db->get('friend');
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
//     	echo($this->db->last_query());
//     	die();
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
		$this->db->insert(strtolower($data['choice']),$insert);
		return $member;
	}
	function checkIfMemberExists($data){
		$this->db->where('email', $data['email']);
		$count = $this->db->count_all_results('member');
		return ($count > 0);
	}
	function getMember($id){
		$member = $this->getCache('member_' . $id);
		if (isset($member)){
			return $member;
		} else {
			$this->db->select('id,active,first_name,last_name,language,salt,email,image');
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
		$this->db->where('salt',$salt);
		$result = $this->db->get('member');
		$data   = $result->result();
		if (isset($data[0])){
			return $data[0];
		} else {
			return null;
		}
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
			if (isset($data['to_date']) && !empty($data['to_date']) && strtotime($data['to_date'])){
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
	function resetPassword($email){
		$this->db->where('email',$email);
		$result = $this->db->get('member');
		$data = $result->result();
		if (isset($data[0])){
			$newPassword = $this->randomPassword();
			$this->db->where('id',$data[0]->id);
			$this->db->set('password',md5($newPassword));
			$this->db->update('member');
			if ($this->db->affected_rows() > 0){
				return array('success'=>true,'message'=>'Password updated','member'=>$data[0],'password'=>$newPassword);	
			} else {
				return array('success'=>false,'message'=>'Unable to update member record!');
			}					
		} else {
			return array('success'=>false,'message'=>'Email address not found!');
		}
	}
	private function randomPassword(){
		$alphabet = "qwe0rtyuJKLME-8PQ1ioj!h3zxc5YZvbn6mA#B7CDpl2k@RSTUVgfds4aWXFGH9INO";
		$pass = array();
		$length = strlen($alphabet) - 1;
		for ($i = 0; $i < 10; $i++){
			$n = rand(0,$length);
			$pass[] = $alphabet[$n];
		}
		return implode($pass);
	}
}
 
class Member_model extends Base_module_record {
 
}
