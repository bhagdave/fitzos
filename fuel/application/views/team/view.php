<div class="row>
	<div class="span4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span4">
		<div class="js-Members">
		<?php $this->load->view('team/teamMembers');?>
		</div>
	</div>
	<div class="span4">
		<h2>Team Wall</h2>
		<form action="teams/addWallPost" method="post">
			<input type="hidden" name="member_id" value="<?=$member->id ?>" />
			<textarea cols="40" rows="2" name="message" placeholder="Your message"></textarea>
			<button class="btn-small">Add post</button>
		</form>
		<?php $this->load->view('team/teamWall');?>
	</div>
</div>
<div class="row-fluid">
	<div class="span4">
		<h2>Team Membership</h2>
		<form action="teams/leave" method="post">
			<input type="hidden" name="member_id" value="<?=$member->id ?>" />
			<input type="hidden" name="team_id" value="<?=$team->id ?>" />
			<button class="btn-small">Leave Team</button>
		</form>
	</div>
</div>