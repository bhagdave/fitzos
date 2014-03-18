<?php
require_once('fitzos_testbase.php');
class Calendar_test extends fitzos_testbase {

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
		$this->MyController = new CalendarController();
	}
	public function test_setupok(){
		$this->run($this->MyController->done,'DONE','Setup ok');
	}
	public function test_loadevents(){
		$events = $this->MyController->getEvents();
		$this->run(count($events)>0,true,'Events loaded');
	}
	public function test_calendarPageLoadsEvents(){
		$this->load_page('calendar/publicEvents');
		$this->run(pq('.calendar-small')->size() > 0,true,'Testing calendar/public has view','PQ statement');		
	}
}
class CalendarController {
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
	function getEvents(){
		return $this->events->getPublicEvents();
	}
}