<h2>Errors in Signup</h2>
<?php 
	if (isset($messages)){
		foreach($messages as $message){
			echo("<div class='alert'>$message</div>");
		}
	}
?>
<?php $this->load->view('_blocks/sign-in');?>
