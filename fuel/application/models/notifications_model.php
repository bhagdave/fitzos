<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Notifications_model extends Base_module_model {
 
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
    		$data['read'] = 'no';
    		$this->db->insert('notifications',$data);
    		return $this->db->insert_id();
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
}
 
class Notification_model extends Base_module_record {
 
}
