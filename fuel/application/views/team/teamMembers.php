	<h2>Members</h2>
		<?php
			if (isset($members)){
				echo("<ul>");
				foreach($members as $member){
					echo("<li>");
					echo("$member->first_name $member->last_name");
					echo("</li>");
				}
				echo("</ul>");
			} else {
				echo("<h4>No members</h4>");
			}
		?>
