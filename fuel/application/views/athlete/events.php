	<?php
			if (isset($events) && count($events) > 0){
				foreach($events as $post){
					echo("<div class='athleteEvents' style='border:1px solid;border-radius:10px;'>");
					echo("<h4>".$post->name."</h4>");
					if (!empty($post->content)){
						echo($post->content. "<br>");
					}
					if (!empty($post->date)){
						echo($post->date. "<br>");
					}
					echo("</div>");
				}
			} else {
				echo("No upcoming events");
			}
		?>
