		<?php
			if (isset($wall) && count($wall) > 0){
				foreach($wall as $post){
					echo("<div class='wallPost'>");
					echo($post->message);
					if (!empty($post->image)){
						echo("<img src='" .$post->image."'>");
					}
					if (isset($owner) && $owner){
						echo("<button class='btn-small js-DeletePost' onclick='deletePost(".$team->id.",".$post->id .")'>Delete</button>");
					}	
					echo("</div>");
				}
			} else {
				echo("No wall posts!");
			}
		?>
