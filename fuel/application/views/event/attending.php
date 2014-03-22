		<div class="js-attending">
		<?php 
		if (isset($message)){
			echo($message);
		}
		if (isset($attending) && !empty($attending)){
			echo("<h4>Members Attending</h4>");
			foreach($attending as $member){
				echo("<p>$member->name</p>");
				// if they can edit give them the ability to remove the attendee
				if (isset($edit) && $edit == true){
					echo("<button onclick='removeAttendee(".$event->id.",".$member->member_id.");'>Remove $member->name from event.</button>");
				}
			}
		} else {
			echo("<h4>No members currently attending</h4>");
		}
		?>
		</div>
