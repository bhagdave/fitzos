	<h2>Members</h2>
		<?php
			if (isset($members) && count($members) > 0){
				echo("<ul>");
				foreach($members as $member){
					echo("<li>");
					echo("<a href='/athlete/view/$member->id'>$member->first_name $member->last_name</a>");
					echo("</li>");
				}
				echo("</ul>");
			} else {
				echo("<h4>No members currently</h4>");
			}
			if (isset($od)){
				echo("<h4>Team Owner:");
				echo("<a href='/athlete/view/$od->id'>$od->first_name $od->last_name</a></h4>");
			}
		?>
