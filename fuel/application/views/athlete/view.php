<?php
	if (isset($id) && $id == $member->id){
		$isMember = True;
	} else {
		$isMember = False;
	}
?>
<div class="athlete-profile">
	<div class="athlete-profile__img">
		<?php 
			if (isset($member) && isset($member->image)){
				echo("<img src='/$member->image'>");
			}
		?>
	</div>
	<div class="athlete-profile__goal">
		<div class="goal-indicator"></div>
		<i class="fa fa-star fa-3x"></i>
	</div>
	<div class="athlete-profile__calendar">
		<div class="calendar"></div>
		<i class="fa fa-calendar fa-3x"></i>
	</div>
	<div class="athlete-profile__actions">
		<i class="fa fa-user fa-3x js-emailFriend"></i>
		<i class="fa fa-gift fa-3x"></i>
		<a href="/athlete/notifications"><i class="fa fa-inbox fa-3x"></i></a>
	</div>

	<?php
	if ($isMember){
		// echo("<a href='/athlete/profile'>Edit your profile</a><br/>");
		// echo("<a href='#' class='js-emailFriend'>Email Invite To Friend</a>");
	?>

	<div class="athlete-profile__sports">
		<h4>Sports</h4>
		<?php
			if (isset($sports)){
				foreach($sports as $sport){
					echo("<h5>$sport->sport</h5>");
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

	<div class="athlete-profile__events">
		<h4>Events</h4>
		<?php $this->load->view('athlete/events'); ?>
	</div>

</div>

<div class="athlete-calendar">
	<?php // $this->load->view('calendar/bySport'); ?>
</div>

	<div class="athlete-friends">
		<!-- 		<h2>Friends</h2> -->
		<?php // $this->load->view('athlete/friendList'); ?>
	</div>

	<div class="athlete-notifications">
		<!-- 		<h2>Notifications</h2> -->
		<?php // $this->load->view('athlete/notifications'); ?>
	</div>		

	<?php
	} else {
		echo("<a href='/athlete/beFriend/".$member->id."'>Friend Request</a>");
	}
?>
<?php 
	$this->load->view('athlete/inviteFriend');
?>
		