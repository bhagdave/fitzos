		<?php
			if (isset($wall)){
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
			} 
		?>
