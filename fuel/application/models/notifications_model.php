<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notifications_model extends Fitzos_model {
 
    function __construct()
    {
        parent::__construct('notifications');
    }
    private function getTeamOwnerId($team){
    	$this->db->where("id",$team);
    	$this->db->select('owner,name');
    	$result = $this->db->get("team");
    	$data = $result->result();
    	if (isset($data[0])){
    		return $data[0];
    	} else {
    		return null;
    	}
    }
    function createNotification($data){
    	if (is_array($data)){
    		$data['date_added'] = date('Y-m-d');
    		$data['read'] = 0;
    		$this->db->insert('notifications',$data);
    		return $this->db->insert_id();
    	}
    }
    private function getMemberDetails($id){
    	$this->db->where('id',$id);
    	$result = $this->db->get('member');
    	$data = $result->result();
    	if (isset($data[0])){
    		return $data[0];
    	} else {
    		return null;
    	}
    }
    function getTeam($id){
    	$this->db->where('id',$id);
    	$result = $this->db->get('team');
        	$data = $result->result();
    	if (isset($data[0])){
    		return $data[0];
    	} else {
    		return null;
    	}
    }
    function notifyJoining($team,$member){
		// get member details..
		$memberData = $this->getMemberDetails($member);
		if (isset($memberData)){
			$owner = $this->getTeamOwnerId($team);
			$teamData = $this->getTeam($team);
			if (!empty($owner)){
				$data = array();
				$data['from_table'] = 'member';
				$data['from_key'] = $member;
				$data['to_table'] = 'member';
				$data['to_key'] = $owner->owner;
				$data['notification'] = "The member $memberData->first_name $memberData->last_name requested team memebrship of <a href='/teams/view/".$teamData->id."'>$teamData->name</a>";
				$data['published'] = 'yes';
				$data['type'] = 'MESSAGE';
				$notification = $this->createNotification($data);
			}
		}
    }
    function sendDecline($team,$member){
   		$owner = $this->getTeamOwnerId($team);
   		if (!empty($owner)){
	    	$data = array();
	    	$data['from_table'] = 'team';
	    	$data['from_key'] = $team;
	    	$data['to_table'] = 'member';
	    	$data['to_key'] = $member;
	    	$data['notification'] = "The team $owner->name rejected your membership!";
	    	$data['published'] = 'yes';
	    	$data['type'] = 'MESSAGE';
	    	$notification = $this->createNotification($data);
	    	return $notification;
   		}
    }
    function sendAcceptance($team,$member){
   		$owner = $this->getTeamOwnerId($team);
   		if (!empty($owner)){
	    	$data = array();
	    	$data['from_table'] = 'team';
	    	$data['from_key'] = $team;
	    	$data['to_table'] = 'member';
	    	$data['to_key'] = $member;
	    	$data['notification'] = "The team $owner->name accepted your membership!";
	    	$data['published'] = 'yes';
	    	$data['type'] = 'MESSAGE';
	    	$notification = $this->createNotification($data);
	    	return $notification;
   		}
    }
	function getMemberNotifications($member){
		$this->db->where("to_table","member");
		$this->db->where("to_key",$member);
		$this->db->where("read",0);
		$this->db->order_by('date_added','desc');
		$result = $this->db->get("vw_notifications");
		$notifications = $result->result();
		return $notifications;
	}
	function getNotifications($type,$id){
		$this->db->where("to_table",$type);
		$this->db->where("to_key",$id);
		$this->db->where("read",0);
		$this->db->order_by('date_added','desc');
    	$this->db->limit(10);
		$result = $this->db->get("notifications");
		return $result->result();
	}
	function markRead($id){
		$this->db->where('id',$id);
		$this->db->update('notifications',array('read'=>1));
	}
}
 
class Notification_model extends Base_module_record {
 
}
