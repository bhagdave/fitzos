<div class="col-md-12">
	<div class="row">
		<div class="col-md-4 col-md-offset-3">
			<?= isset($message) ? $message :'' ; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-3">
			<h2><?=$team->name ?>(Manage)</h2>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="row">
		<div class="col-md-4">
			<div class="js-Members">
			<?php $this->load->view('team/teamMembers');?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="js-MemberRequests">
			<?php $this->load->view('team/memberRequests');?>
			</div>
		</div>
		<div class="col-md-4">
			<h3><?=$team->name ?> Sports</h3>
			<?php $this->load->view('team/sports');?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 teamWall">
			<h2>Team Wall</h2>
			<form class="js-wallPostAdd">
				<input type="hidden" name="team_id" value="<?=$team->id ?>" />
				<textarea cols="40" rows="2" name="message" placeholder="Your message"></textarea>
				<button class="btn js-wallPostAddBtn">Add post</button>
			</form>
			<div class="js-teamWall">
				<?php $this->load->view('team/teamWall');?>
			</div>
		</div>
		<div class="col-md-6 teamEvents">
			<h2>Events</h2>
			<div class="js-Events">				
			<?php $this->load->view('team/teamEvents');?>
			</div>
		</div>
		</div>
</div>