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
			<div class="span4 signin">
				<?php $this->load->view('_blocks/sign-in');?>
			</div>
		</div>
	</div>
</div>
