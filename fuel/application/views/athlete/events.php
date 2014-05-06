	<?php
			if (isset($events) && count($events) > 0){
				foreach($events as $post){
					echo("<div class='event'>");
					echo("<h4 class='event__title'><a href='/event/view/".$post->id."'>".$post->name."</a></h4>");				
					if (isset($post->image)){
						echo("<a class='event__image' href='/event/view/" . $post->id . "'><img src='/".$post->image."' alt='".$post->name."' title='".$post->name."'></a>");
					}	
					if (!empty($post->content)){
						echo('<div class="event__content">' . $post->content . '</div>');
					}
					if (!empty($post->date)){
						$date = new DateTime($post->date);
						if (isset($post->end_date)){
							$enddate = new DateTime($post->end_date);
						} else {
							$enddate = null;
						}
						echo('<div class="event__date">' . $date->format('m/d/Y'));
						if (isset($enddate)){
							echo(' until ' . $enddate->format('m/d/Y'));
						}
						echo("</div>");
					}
					echo("</div>");
				}
			} else {
				echo("No upcoming events");
			}
		?>
