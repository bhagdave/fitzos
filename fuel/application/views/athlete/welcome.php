<div class="row">
	<div class="col-md-4">
		<h2>Athlete Home Page</h2>
	</div>
	<div class="col-md-4">
		<?php 
			if (isset($member->image)){
				echo("<img src='".$member->image."' alt='".$member->first_name . " " . $member->last_name ."' title='".$member->first_name . " " . $member->last_name ."'");
			}
		?>
	</div>
	<div class="col-md-4">
		<h3><?=isset($member) ? $member->first_name . ' ' . $member->last_name : '' ; ?></h3>
	</div>
</div>
<div class="row">
	<div class="col-md-2 col-xs-12 col-lg-6">
		<h2>Notifications</h2>
	</div>
	<div class="col-md-10 col-xs-12 col-lg-6">
		<?php $this->load->view('athlete/notifications'); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-2 col-xs-12 col-lg-6">
		<h2>Events</h2>
	</div>
	<div class="col-md-10 col-xs-12 col-lg-6">
		<?php $this->load->view('athlete/events'); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-xs-12 col-lg-12">
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-md-1">
	</div>
	<div class="col-md-10">
		<?php echo fuel_block('athlete_welcome');?>
	</div>
	<div class="col-md-1">
	</div>
</div>
<div class="row">
	<div class="col-md-5"></div>
	<div class="col-md-2">
		<a href="/athlete/profile" width="400px" class="btn btn-success btn-block">Profile</a>
	</div>
	<div class="col-md-5"></div>
</div>
<div class="row">
	<div class="col-md-5"></div>
	<div class="col-md-2">
		<a href="/athlete/sports" class="btn btn-success btn-block">Sports</a>
	</div>
	<div class="col-md-5"></div>
</div>
<div class="row">
	<div class="col-md-5"></div>
	<div class="col-md-2">
		<a href="/athlete/teams" class="btn btn-success btn-block">Teams</a>
	</div>
	<div class="col-md-3"></div>
</div>
<div class="row">
	<div class="col-md-5"></div>
	<div class="col-md-2">
		<a href="/athlete/notifications" class="btn btn-success btn-block">Notifications</a>
	</div>
	<div class="col-md-3"></div>
</div>
		