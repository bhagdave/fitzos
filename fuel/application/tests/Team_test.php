<?php
require_once('fitzos_testbase.php');
class Team_test extends fitzos_testbase {
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
		$this->MyController = new TeamController();
	}
	public function test_setupok(){
		$this->run($this->MyController->done,'DONE','Setup ok');
	}
	public function test_isMember(){
		$this->run($this->MyController->isMember(1, 2),true,'Team member isMember');
		$this->run($this->MyController->isMember(2, 5),false,'None Team member is not Member');
		$this->run($this->MyController->isMember(2, 2),true,'Team owner isMember');
	}
	public function test_createNewEvent(){
		$this->_login();
		$post = array(
			'name'=>'Just Testing',
			'content'=>'Just Testing',
			'location'=>'Here',
			'date'=>'2014-03-29',
			'published'=>'yes',
			'public'=>'PUBLIC',
			'type'=>'VIRTUAL',
			'sub_type'=>'FREE',
			'team_id'=>1
		);
		$this->load_page('teams/newEvent/1',$post);
		$this->run($this->page_contains('Event added',false),true,'Adding a new team event');
		
	}
}
class TeamController {
	private $CI;
	private $members;
	private $teams;
	public $done;
	function __construct(){
		$this->CI =& get_instance();
		$this->members = $this->CI->load->model('members_model');
		$this->teams = $this->CI->load->model('teams_model');
		$this->done = 'DONE';
	}
	function isMember($team,$user){
		return $this->teams->isMember($team,$user);
	}
}