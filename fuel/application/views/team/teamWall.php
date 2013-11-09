		<div class="teamWall">
		<?php
			if (isset($wall)){
				foreach($wall as $post){
					echo("<div class='wallPost'>");
					echo($post->message);
					if (!empty($post->image)){
						echo("<img src='" .$post->image."'>");
					}	
					echo("</div>");
				}
			} 
		?>
		</div>
