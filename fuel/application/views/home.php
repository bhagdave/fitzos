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
			<div class="col-md-offset-6 col-lg-offset-6 col-md-3 sign-in col-sm-6 col-xs-6">
				<?php $this->load->view('_blocks/sign-in');?>
			</div>
		</div>
	</div>
</div>

