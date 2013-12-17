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
			
			<div class="span4 signin">
				<?php $this->load->view('_blocks/sign-in');?>
			</div>
<<<<<<< HEAD
			<!--
			<div class="span4 login">
				<?php $this->load->view('_blocks/login');?>
			</div>
			-—>
=======
>>>>>>> 23dd39a853516d6c5302ed4503b586a2b437f76a
		</div>
	</div>
</div>
