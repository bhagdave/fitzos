		<div class="js-attending">
		<?php 
		if (isset($attending) && !empty($attending)){
			echo("<h4>Members Attending</h4>");
			foreach($attending as $member){
				echo("<p>$member->name</p>");
			}
		} else {
			echo("<h4>No members currently attending</h4>");
		}
		?>
		</div>
