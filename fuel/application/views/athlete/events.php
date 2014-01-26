	<?php
			if (isset($events) && count($events) > 0){
				foreach($events as $post){
					echo("<h4>".$post->name."</h4>");
					if (!empty($post->content)){
						echo($post->content. "<br>");
					}
					if (!empty($post->date)){
						echo($post->date. "<br>");
					}
				}
			} else {
				echo("No upcoming events");
			}
		?>
