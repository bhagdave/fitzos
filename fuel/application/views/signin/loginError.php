<h2>Errors in Login</h2>
<?php 
	if (isset($message)){
			echo("<div class='alert'>$message</div>");
	}
?>
<?php $this->load->view('_blocks/login');?>
