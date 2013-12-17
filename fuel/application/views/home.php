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
	<div class="span12">
		<div class="row-fluid">
			<div class=“span12 splash”>
				<img src="../../../assets/images/splash_lead1.jpg" alt=""/>
			</div>
			
			<div class="span4 sign-in">
				<?php $this->load->view('_blocks/sign-in');?>
			</div>
			
		</div>
	</div>
</div>
