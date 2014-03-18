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
<div class="row">
	<div class="splash col-lg-6 col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-md-offset-5 col-lg-offset-5 col-md-4 sign-in col-sm-6 col-xs-6">
				<?php $this->load->view('_blocks/sign-in');?>
			</div>
		</div>
	</div>
</div>
<?php 
// load the calendar bit..
	$events_model = $ci->load->model('events_model');
	$public = $events_model->getPublicEvents();
	$this->load->view('calendar/public',array('public'=>$public));
?>
