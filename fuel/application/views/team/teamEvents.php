		<?php
			if (isset($events) && count($events) > 0){
				foreach($events as $post){
					echo("<div class='wallEvent'>");
					echo("<h4>".$post->name."</h4>");
					if (!empty($post->content)){
						echo($post->content. "<br>");
					}
					if (isset($owner) && $owner){
						echo("<button class='btn-small js-DeleteEvent' onclick='deleteEvent(".$team->id.",".$post->id .")'>Delete</button>");
					}	
					echo("</div>");
				}
			} else {
				echo("No team events");
			}
		?>
	<a href="/teams/newEvent/<?=$team->id ?>" class='btn-small btn-success'>New Event</a>