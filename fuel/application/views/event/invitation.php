	<form id="js-Invitations">
	<?php 
		$showButton = true;
		if (isset($members) && count($members) > 0){
			foreach($members as $member){
				echo("<label>".$member->first_name . ' ' . $member->last_name."</label>");
				echo("<input type='checkbox' name='mmbrd".$member->id."' value='yes'><br />");
			}
		} else {
			$showButton = false;
			echo("<label>All members invited</label>");
		}
	?>
		<br/>
		<?php 
			if ($showButton){
			?>
				<button class="btn btn-small btn-success" onclick="sendInvites(<?=$event->id?>);">Send Invites</button>
			<?php 
			}
		?>
	</form>
	<div class="alreadyInvited">
		<h2>Already invited</h2>
	<?php 
		if (isset($invited)){
			foreach($invited as $member){
				echo("<label>".$member->first_name . ' ' . $member->last_name."</label><br />");
			}
		}
	?>
	</div>
