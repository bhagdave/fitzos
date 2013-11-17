		<h2>Member Requests</h2>
		<?php
			if (isset($waiting)){
				echo("<ul>");
				foreach($waiting as $member){
					echo("<li>");
					echo("$member->first_name $member->last_name<button class='btn-small' onclick='acceptMember(".$team->id.",".$member->id.")'>Accept</button><button class='btn-small' onclick='declineMember(".$team->id.",".$member->id.")'>Decline</button>");
					echo("</li>");
				}
				echo("</ul>");
			} else {
				echo("<h4>No members awaiting approval</h4>");
			}
		?>
	</div>
