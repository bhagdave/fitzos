<?php 
	if (isset($message) && !empty($message)){
			echo("<div class='alert'>$message</div>");
	}
?>
<?php $this->load->view('_blocks/login');?>