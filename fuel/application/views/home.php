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
			</div>
			<div class="span4 cal">
			</div>
			<div class="span4 photo">
			</div>
		</div>
	</div>
</div>

