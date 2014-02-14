<div id="inviteDialog" style="display: hidden">
	<h1>Invite Members</h1>
	<?php 
		if (isset($members)){
			foreach($members as $member){
				echo($member->first_name . ' ' . $member->last_name);
			}
		}
	?>
</div>