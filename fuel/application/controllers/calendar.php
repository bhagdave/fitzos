<?php
class Calendar extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('events_model');
	}
	function publicEvents(){
		$vars['events'] = $this->events_model->getPublicEvents();
		$this->fuel->pages->render('calendar/public',$vars);
	}
}