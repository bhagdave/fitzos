<?php
	$ci = &get_instance(); 
	$session = $ci->load->library("session");
	if ($session->userdata('type')){
		$type = $session->userdata('type');
			if ($type == 'athlete' || $type == 'both'){
				redirect('athlete/index');					
			} else {
				redirect('trainer/index');					
			}
	}
?>

<?php $this->load->view('_blocks/sign-in');?>

<?php 
// load the calendar bit..
	$events_model = $ci->load->model('events_model');
	$public = $events_model->getPublicEvents();
	$this->load->view('calendar/public',array('public'=>$public));
?>
