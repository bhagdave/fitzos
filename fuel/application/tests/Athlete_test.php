<?php
require_once('fitzos_testbase.php');
class Athlete_test extends fitzos_testbase {

	public $init = array();

	private $MyController; 
	private $session;
	public function __construct()
	{
		parent::__construct();
	}

	public function setup()
	{
		$this->load_sql('fitzos_test.sql', NULL);
		$this->MyController = new AthleteController();
	}
  	public function test_befriend(){
  		$request = $this->MyController->befriend(2);
  		$this->run($request['request'],true,'Befriend','Request set');
  		$this->run(isset($request['requestee']),true,'Befriend','Requestee set');
  		$this->run(isset($request['requested']),true,'Befriend','Requested set');
  		$this->run($request['notification']>0,true,'Befriend','Notification set');
  	}
  	public function test_acceptFriend(){
 		$result = $this->MyController->acceptFriend(1);		
  		$this->run($result,true,'Accept friend','Accept set');
  	}
  	public function test_declineFriend(){
  		$result = $this->MyController->declineFriend(1);
  		$this->run($result,true,'Decline friend','Decline set');
  	}
  	public function test_AthleteIndex(){
		$login = $this->_login();
  		$page = $this->load_page("athlete/index");
  		// check welcome is there
  		$this->run(pq('.welcome')->size() > 0,true,'Testing index page','PQ statement');
  		//check calendar exist on index page
  		$this->run(pq('.SportsForThisMonth')->size() > 0,true,'Testing index page has calendar','PQ statement');
  	}
  	
  	public function test_calendarpage(){
  		$this->_login();
  		$this->load_page('athlete/calendar');
  		$this->run($this->page_contains(".calendar"),true,"Calendar page loads","Page contains");
  	}
  	
}
class AthleteController {
	private $CI;
	private $members;
	private $notify;
	public $done;
	function __construct(){
		$this->CI =& get_instance();
		$this->members = $this->CI->load->model('members_model');
		$this->notify = $this->CI->load->model('notifications_model');
		$this->done = 'DONE'; 
	}
	function acceptFriend($id){
		$result = $this->members->acceptFriendRequest($id);
		return $result;
	}
	function declineFriend($id){
		$result = $this->members->declineFriendRequest($id);
		return $result;
	}
	function befriend($id){
		$request = $this->members->setFriendRequest($id,1);
		if ($request > 0){
			// send notification
			// get the member details for the requestee
			$requestee = $this->members->getMember(1);
			$requested = $this->members->getMember($id);
			$message =  "The user $requestee->first_name $requestee->last_name has requested friendship.";
			$message .= "<a href='athlete/acceptFriend/$request'>Accept</a><a href='athlete/declineFriend/$request'>Decline</a> ";
			// get the member details for the requester
			$notification = $this->notify->createNotification(array(
				'from_table'=>'member',
				'from_key'=>1,
				'to_table'=>'member',
				'to_key'=>$id,
				'notification'=>'',						
			));
		} else {
			//TODO: Send error message
		}
		return array(
			'request'=>$request,
			'requested'=>$requestee,
			'requestee'=>$requested,
			'notification'=>$notification		
		);
	}
}