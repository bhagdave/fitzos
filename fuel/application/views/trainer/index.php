<?php
	if (isset($id) && $id == $member->id){
		$isMember = True;
	} else {
		$isMember = False;
	}
?>
<div class="row">
	<div class="col-md-4 athlete-profile__img">
		<?php 
			if (isset($member) && isset($member->image)){
				echo("<img src='/$member->image'>");
			}
		?>

	<?php
	if (isset($isMember) && $isMember){
		 echo("<a href='/trainer/profile'>Edit your profile</a><br/>");
		 echo("<a href='#' class='js-emailFriend'>Email Invite To Friend</a>");
	}
	?>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<h4>Events</h4>
		<?php $this->load->view('trainer/events'); ?>
	</div>
	<div class="col-md-5">
		<?php  $this->load->view('calendar/bySport'); ?>
	</div>
</div>
<div class="row">

	<div class="col-md-5">
		<h2>Proteges</h2>
		<?php  $this->load->view('trainer/athletes'); ?>
	</div>

	<div class="col-md-5">
		<h2>Notifications</h2>
		<?php  $this->load->view('trainer/notifications'); ?>
	</div>		
</div>