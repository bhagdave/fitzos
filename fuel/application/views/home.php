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
	$fuel_model = $ci->load->model('fuel_data');
	$page = $fuel_model->getFuelPageContent('terms');
?>
<div class="terms" style="display:none;">
	<h1>Terms and Conditions</h1>
<?= $page ?>
</div>