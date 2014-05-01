		<?php
			if (isset($events) && count($events) > 0){
				foreach($events as $post){
					echo("<div class='wallEvent'>");
					echo("<h4><a href='/event/view/".$post->id."'>".$post->name."</a></h4>");
					if (!empty($post->content)){
						echo($post->content. "<br>");
					}
					if (isset($owner) && $owner){
						echo("<button class='btn js-DeleteEvent' onclick='deleteEvent(".$team->id.",".$post->id .")'>Delete</button>");
					}
					if (isset($post->image)){
						echo("<a href='/event/view/".$post->id."'><img height=320px src='/".$post->image."' alt='".$post->name."' title='".$post->name."'></a>");
					}	
					if (!empty($post->date)){
						$date = new DateTime($post->date);
						echo("<p>".$date->format('m/d/Y'). "</p>");
					}
					if (!empty($post->time)){
						echo("Starts ".$post->time);
					}
					if (!empty($post->end_time)){
						echo(" Finishes ".$post->end_time. "<br>");
					}
					echo("</div>");
				}
			} else {
				echo("<div class='wallEvent'>No team events</div>");
			}
		?>
	<a href="/teams/newEvent/<?=$team->id ?>" class='btn'>New Event</a>