<div class="row col-md-12">
<div class="row>
	<div class="col-md-4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="js-Members">
		<?php $this->load->view('team/teamMembers');?>
		</div>
	</div>
	<div class="col-md-4">
		<h2>Team Wall</h2>
		<form class="js-wallPostAdd">
			<input type="hidden" name="team_id" value="<?=$team->id ?>" />
			<textarea cols="40" rows="2" name="message" placeholder="Your message"></textarea>
			<button class="btn-small btn-success js-wallPostAddBtn">Add post</button>
		</form>
		<div class="js-teamWall">
			<?php $this->load->view('team/teamWall');?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<h2>Team Membership</h2>
		<?php echo("<a href='/teams/leave/{$team->id}/{$member->id}'><button>Leave</button></a>"); ?>	
	</div>
</div>
</div>