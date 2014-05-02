	<form id="js-Invitations">
	<?php 
		$showButton = true;
		if (isset($friends) && count($friends) > 0){
			foreach($friends as $friend){
				echo("<label>".$friend->first_name . ' ' . $friend->last_name."</label>");
				echo("<input type='checkbox' name='mmbrd".$friend->id."' value='yes'><br />");
			}
		} else {
			$showButton = false;
			echo("<label>You have no friends to invite!</label>");
		}
	?>
		<br/>
		<?php 
			if ($showButton){
			?>
				<button class="btn btn-small btn-success" onclick="sendTeamInvites(<?=$team->id?>);">Send Invites</button>
			<?php 
			}
		?>
	</form>
	<?php 
		if (isset($invited)){
		?>
<div class="alreadyInvited">
<h2>Already invited</h2>
			<?php 
			foreach($invited as $member){
				echo("<label>".$member->first_name . ' ' . $member->last_name."</label><br />");
			}
		}
	?>
	</div>
