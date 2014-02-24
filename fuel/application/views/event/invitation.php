<div id="inviteDialog" title="Invite Members" style="display:none;">
	<form id="js-Invitations">
	<?php 
		if (isset($members)){
			foreach($members as $member){
				echo("<label>".$member->first_name . ' ' . $member->last_name."</label>&nbsp;");
				echo("<input type='checkbox' name='mmbrd".$member->id."' value='yes'>");
			}
		}
	?>
		<br/>
		<button class="btn btn-success" onclick="sendInvites(<?=$event->id?>);">Send Invites</button>
	</form>
	<div class="alreadyInvited">
		<h2>Already invited</h2>
	<?php 
		if (isset($invited)){
			foreach($invited as $member){
				echo("<label>".$member->first_name . ' ' . $member->last_name."</label>&nbsp;");
				echo("<input type='checkbox' name='mmbrd".$member->id."' value='yes'>");
			}
		}
	?>
	</div>
</div>