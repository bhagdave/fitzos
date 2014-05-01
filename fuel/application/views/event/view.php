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
//echo('User attending is ' . $userAttending);
?>
<div class="row">
	<div class="col-md-4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-4">
		<h2><?=isset($event->name) ? $event->name : '' ; ?> ON <?=$team->name ?></h2>
		<p>Created by <?=$event->first_name ?> <?=$event->last_name ?></p>
		<p><?=isset($event->content) ? $event->content : ''; ?></p>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
	<?php
		if (isset($event->date)){
			$eventDate = new DateTime($event->date);
		} 
		
	?>
		<h4><?=isset($event->location) ? $event->location : 'Location not set '; ?><?=isset($eventDate) ? ' on ' .$eventDate->format('d/m/Y') : ''; ?><?=isset($event->time) ? ' @ ' . $event->time : ''; ?></h4>
	</div>
	<div class="col-md-4">
		<?php 
		if (isset($event->image)){
				echo("<img height=320px src='/".$event->image."' alt='".$event->name."' title='".$event->name."'>");
			}
			?>
	</div>
	<div class="col-md-4">
	<?php 
	$result = $this->load->view('event/attending');
	?>
	</div>
</div>
<div class="row">
	<div class="col-md-4 teamWall">
		<h2>Event Wall</h2>
		<form class="js-eventWallPostAdd">
			<input type="hidden" name="event_id" value="<?=$event->id ?>" />
			<textarea cols="40" rows="2" name="message" placeholder="Your message"></textarea>
			<button class="btn-small btn-success js-wallPostAddBtn">Add post</button>
		</form>
		<div class="js-eventWall">
			<?php $this->load->view('event/eventWall');?>
		</div>
	</div>
</div>
<div class="row actions">
	<?php 
	if (isset($owner) && $owner){
	?>
	<div class="col-md-2">
		<button class="btn btn-primary js-Invite" onclick="showInviteForm();">Invite Members</button>
	</div>
	<?php 
	}
	?>
	<div class="col-md-2">
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
<div id="inviteDialog" title="Invite Members" style="display:none;">
<?php $this->load->view('event/invitation');?>
</div>
