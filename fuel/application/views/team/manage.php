<div class="row">
	<div class="span4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row-fluid">
	<h2><?=$team->name ?></h2>
</div>
<div class="row-fluid">
	<div class="span4"><h2>Members</h2></div>
	<div class="span4">
		<h2>Member Requests</h2>
		<?php
			if (isset($waiting)){
				echo("<ul>");
				foreach($waiting as $member){
					echo("<li>");
					echo("$member->name <button class='btn-small'>Accept</button><button class='btn-small'>Decline</button>");
					echo("</li>");
				}
				echo("</ul>");
			} else {
				echo("<h4>No members awaiting approval</h4>");
			}
		?>
	</div>
	<div class="span4">
		<h2>Team Wall</h2>
		<form class="js-wallPostAdd">
			<input type="hidden" name="team_id" value="<?=$team->id ?>" />
			<textarea cols="40" rows="2" name="message" placeholder="Your message"></textarea>
			<button class="btn-small btn-success js-wallPostAddBtn">Add post</button>
		</form>
		<?php $this->load->view('team/teamWall');?>
	</div>
</div>
<div class="row-fluid">
	<div class="span4"><h2>Events</h2></div>
	<div class="span4"><h2></h2></div>
	<div class="span4"><h2></h2></div>
</div>