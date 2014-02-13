<?php 
	// lets see if the current user is attending
	if (isset($attending) && !empty($attending)){
		foreach($attending as $member){
			if ($member->member_id == $user){
				$userAttending = true;
				break;
			}
		}
	} else {
		$userAttending = false;
	}
?>
<div class="row">
	<div class="col-md-4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-4">
		<h2><?=isset($event->name) ? $event->name : '' ; ?></h2>
		<p><?=isset($event->content) ? $event->content : ''; ?></p>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<h4><?=isset($event->location) ? $event->location : ''; ?><?=isset($event->date) ? ' on ' .$event->date : ''; ?><?=isset($event->time) ? ' @ ' . $event->time : ''; ?></h4>
	</div>
	<div class="col-md-4">
		<?php 
			if (isset($event->image)){
				echo("<img height=320px src='/".$event->image."' alt='".$event->name."' title='".$event->name."'>");
			}
		?>
	</div>
	<div class="col-md-4">
		<?php $this->load->view('event/attending');?>
	</div>
</div>
<div class="row actions">
	<div class="col-md-2 col-md-offset-2">
		<?php 
		if ($edit){
			echo("<a class='btn btn-primary' href='/event/edit/".$event->id."'>Edit Event</a>");				
		}
		?>
	</div>
	<div class="col-md-2">
		<?php 
			if (!isset($userAttending) || !$userAttending){
				echo("<button class='btn btn-primary' onclick='attendEvent(".$event->id.",".$user.");'>Attend Event</button>");
			}
		?>
	</div>
</div>
