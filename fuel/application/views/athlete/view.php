<?php
	if (isset($id) && $id == $member->id){
		$isMember = True;
	} else {
		$isMember = False;
	}
?>
<div class="row>
	<div class="col-md-12">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<h2><?=isset($member) ? $member->first_name . ' ' . $member->last_name : '' ; ?></h2>
		<p>Nickname:<?= isset($athlete->nickname) ? $athlete->nickname :'' ?></p>
		<p>DOB:<?= isset($athlete->dob) ? $athlete->dob :'' ?></p>
		<p>Gender:<?= isset($athlete->gender) ? $athlete->gender :'' ?></p>
		<p>Activity:<?= isset($athlete->activity) ? $athlete->activity :'' ?></p>
		<p>Country:<?= isset($athlete->country) ? $athlete->country :'' ?></p>
		<p>Location:<?= isset($athlete->location) ? $athlete->location :'' ?></p>
	</div>
	<div class="col-md-4">
		<?php 
			if (isset($member) && isset($member->image)){
				echo("<img src='/$member->image'>");
			}
		?>
	</div>
	<div class="col-md-4">
		<h2>Their Sports</h2>
	<?php
		if (isset($sports)){
			foreach($sports as $sport){
				echo("<h4>$sport->sport</h4>");
				if (isset($sport->from_date)){
					$date = new DateTime($sport->from_date);
					echo("From: ". $date->format('m/d/Y'));
				}
				if (isset($sport->to_date)){
					$date = new DateTime($sport->to_date);
					echo(" Until " . $date->format('m/d/Y'));
				}
				echo("<br>");
				$existingSports[] = $sport->sport;
			}
		}
	?>
	</div>
</div>
<div>
<?php
	if ($isMember){
		echo("<a href='/athlete/profile'>Edit your profile</a><br/>");
		echo("<a href='#' class='js-emailFriend'>Email Invite To Friend</a>");
	?>
		<div class="row">
			<div class="col-md-6 col-lg-10 col-xs-12">
					<div class="row">
						<div class="col-md-3 col-xs-12 col-lg-6">
							<h2>Notifications</h2>
						</div>
						<div class="col-md-3 col-xs-12 col-lg-6">
							<?php $this->load->view('athlete/notifications'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 col-xs-12 col-lg-6">
							<h2>Events</h2>
						</div>
						<div class="col-md-4 col-xs-12 col-lg-6">
							<?php $this->load->view('athlete/events'); ?>
						</div>
					</div>			
			</div>
		</div>

	<?php
	} else {
		echo("<a href='/athlete/beFriend/".$member->id."'>Friend Request</a>");
	}
?>
</div>
<?php 
	$this->load->view('athlete/inviteFriend');
?>
		