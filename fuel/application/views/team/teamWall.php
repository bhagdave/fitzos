		<?php
			if (isset($wall) && count($wall) > 0){
				foreach($wall as $post){
					echo("<div class='wallPost'>");
					echo($post->message);
					if (isset($post->first_name)){
						echo (" by <a href='/athlete/view/$post->memberId'>$post->first_name $post->last_name</a>");
					} else {
						echo (" by Administrator!");
					}
					if (!empty($post->image)){
						echo("<img src='" .$post->image."'>");
					}
					if ((isset($owner) && $owner) || $member->id == $post->memberId){
						echo("<button class='btn-small js-DeletePost' onclick='deletePost(".$team->id.",".$post->id .")'>Delete</button>");
					}	
					echo("</div>");
				}
			} else {
				echo("No wall posts!");
			}
		?>
