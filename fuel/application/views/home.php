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
<div class="row-fluid">
	<div class="span6 splash">
		<div class="row-fluid">
			<div class="offset7 span4 sign-in">
				<?php $this->load->view('_blocks/sign-in');?>
			</div>
		</div>
	</div>
	<div class="span12">
		<div class="row-fluid">
			<div class="span8 info">
				<h1>Information and Material</h1>
			</div>
			<div class="span4 cal">
				<p>Link to modified Calendar</p>
			</div>
			<div class="span4 photo">
				<p>link to photo page</p>
			</div>
		</div>
	</div>
</div>
<a href="https://plus.google.com/111706559051974640132" rel="publisher">Google+</a>

