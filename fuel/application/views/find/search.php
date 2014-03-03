<div class="suggestions">
	<?php 
		if (isset($suggestions)){
			if (count($suggestions['locations'])>0){
				echo("<h2>Members with a similar location</h2>");
				foreach($suggestions['locations'] as $location){
					echo("<a href='/athlete/view/$location->id'>$location->first_name $location->last_name</a>");	
				}
			}
			if (count($suggestions['sports'])>0){
				echo("<h2>Members with the same sports</h2>");
				foreach($suggestions['sports'] as $sport){
					echo("<a href='/athlete/view/$sport->id'>$sport->first_name $sport->last_name</a>");
				}
			}
		}
	?>
</div>