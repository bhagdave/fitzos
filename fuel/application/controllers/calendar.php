<?php
class Calendar extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('events_model');
	}
	function publicEvents(){
		$vars['public'] = $this->events_model->getPublicEvents();
		$this->fuel->pages->render('calendar/public',$vars);
	}
	function eventsForMonth(){
		$sports = $this->events_model->getPublicEventsForMonthBySport();
		$this->fuel->pages->render('calendar/bySport',array('sportsForThisMonth'=>$sports,'layout'=>'none'));
	}
	function view($sport = null){
		$events = $this->events_model->getCalendarEvents($sport);
		$this->fuel->pages->render('calendar/view',array('events'=>$events));
	}
}