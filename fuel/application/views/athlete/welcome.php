<div class="row">
	<div class="span4">
		<h2>Athlete Home Page</h2>
	</div>
	<div class="span4">
		
	</div>
	<div class="span4">
		<h3><?=isset($member) ? $member->first_name . ' ' . $member->last_name : '' ; ?></h3>
	</div>
</div>
<div class="row">
	<div class="span1">
	</div>
	<div class="span10">
		<?php echo fuel_block('athlete_welcome');?>
	</div>
	<div class="span1">
	</div>
</div>
<div class="row">
	<div class="span5"></div>
	<div class="span2">
		<a href="/athlete/profile" width="400px" class="btn btn-success btn-block">Profile</a>
	</div>
	<div class="span5"></div>
</div>
<div class="row">
	<div class="span5"></div>
	<div class="span2">
		<a href="#" class="btn btn-success btn-block">Messages</a>
	</div>
	<div class="span5"></div>	
</div>
<div class="row">
	<div class="span5"></div>
	<div class="span2">
		<a href="#" class="btn btn-success btn-block">News</a>
	</div>
	<div class="span5"></div>
</div>
<div class="row">
	<div class="span5"></div>
	<div class="span2">
		<a href="#" class="btn btn-success btn-block">Sports</a>
	</div>
	<div class="span5"></div>
</div>
<div class="row">
	<div class="span5"></div>
	<div class="span2">
		<a href="#" class="btn btn-success btn-block">Leagues</a>
	</div>
	<div class="span5"></div>
</div>
<div class="row">
	<div class="span5"></div>
	<div class="span2">
		<a href="#" class="btn btn-success btn-block">Achievements</a>
	</div>
	<div class="span3"></div>
</div>
<div class="row">
	<div class="span5"></div>
	<div class="span2">
		<a href="#" class="btn btn-success btn-block">Badges</a>
	</div>
	<div class="span3"></div>
</div>
<div class="row">
	<div class="span5"></div>
	<div class="span2">
		<a href="#" class="btn btn-success btn-block">Calendar</a>
	</div>
	<div class="span3"></div>
</div>
<div class="row">
	<div class="span5"></div>
	<div class="span2">
		<a href="#" class="btn btn-success btn-block">Events</a>
	</div>
	<div class="span3"></div>
</div>
		