<div class="row">
	<div class="span4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row-fluid">
	<h2><?=$team->name ?></h2>
</div>
<div class="row-fluid">
	<div class="span4">
		<div class="js-Members">
		<?php $this->load->view('team/teamMembers');?>
		</div>
	</div>
	<div class="span4">
		<div class="js-MemberRequests">
		<?php $this->load->view('team/memberRequests');?>
		</div>
	</div>
	<div class="span4">
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
<div class="row-fluid">
	<div class="span4"><h2>Events</h2>
		<?php $this->load->view('team/teamEvents');?>
	</div>
</div>