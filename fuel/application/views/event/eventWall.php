		<?php
			if (isset($wall) && count($wall) > 0){
				foreach($wall as $post){
					echo("<div class='wallPost'>");
					echo($post->message);
					if (isset($post->first_name)){
						echo (" by $post->first_name $post->last_name");
					} else {
						echo (" by Administrator!");
					}
					if (!empty($post->image)){
						echo("<img src='" .$post->image."'>");
					}
					if (isset($owner) && $owner){
						echo("<button class='btn-small js-DeletePost' onclick='deleteEventPost(".$event->id.",".$post->id .")'>Delete</button>");
					}	
					echo("</div>");
				}
			} else {
				echo("No wall posts!");
			}
		?>
