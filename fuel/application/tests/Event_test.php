<?php
require_once('fitzos_testbase.php');
class Event_test extends fitzos_testbase {
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
		$this->MyController = new EventController();
	}
	public function test_setupok(){
		$this->run($this->MyController->done,'DONE','Setup ok');
	}
	public function test_canattend(){
		$this->run($this->MyController->canAttend(2, 5),false,'None public event none team member');
		$this->run($this->MyController->canAttend(4, 1),true,'None public event team owner');
		$this->run($this->MyController->canAttend(4, 2),true,'None public event team member');
	}
	public function test_attendEvent(){
		$attending = $this->MyController->setAttend(2, 5); 
		$this->run(true,$attending === false,'None public event none team member');
		$attending = $this->MyController->setAttend(4, 1); 
		$this->run(true,$attending === true,'None public event team owner');
	}
}
class EventController {
	private $CI;
	private $members;
	private $events;
	public $done;
	function __construct(){
		$this->CI =& get_instance();
		$this->members = $this->CI->load->model('members_model');
		$this->events = $this->CI->load->model('events_model');
		$this->done = 'DONE';
	}
	function canAttend($event,$user){
		return $this->events->_canAttend($event,$user);
	}
	function setAttend($event,$user){
		return $this->events->setAttendEvent($event,$user);
	}
}