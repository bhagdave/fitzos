	<?php
			if (isset($events) && count($events) > 0){
				foreach($events as $post){
					echo("<div class='event'>");
					if (isset($post->image)){
						echo("<a class='event__image' href='/event/view/" . $post->id . "'><img src='/".$post->image."' alt='".$post->name."' title='".$post->name."'></a>");
					}	
					echo("<h4><a href='/event/view/".$post->id."'>".$post->name."</a></h4>");				
					if (!empty($post->content)){
						echo('<div class="event__content">' . $post->content . '</div>');
					}
					if (!empty($post->date)){
						$date = new DateTime($post->date);
						echo('<div class="event__date">' . $date->format('m/d/Y'). "</div>");
					}
					echo("</div>");
				}
			} else {
				echo("No upcoming events");
			}
		?>
