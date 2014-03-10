<?php
class Simple_test extends Tester_base {

	public $init = array();

	public function __construct()
	{
		parent::__construct();
	}

	public function setup()
	{
		$this->load_sql('fitzos_test.sql', NULL);
	}
	public function test_myname(){
		$test = 'Dave';
		$expected = "Dave";
		$this->run($test,$expected,"MyName","Does this work!!");
	}
}
