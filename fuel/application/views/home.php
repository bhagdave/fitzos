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
			<div class="span8">
				<div class="row-fluid">
					<div class="span8 top-right">
						<?php $this->load->view('_blocks/news');?>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6 left-top">
						<?php $this->load->view('_blocks/trending');?>
					</div>
					<div class="span2 right-top">
						<?php $this->load->view('_blocks/login');?>
					</div>
				</div>
			</div>		
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span2">
		span2
	</div>
	<div class="span2">
		span2
	</div>
	<div class="span2">
		span2
	</div>
	<div class="span6">
		span6
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		
	</div>
</div>
