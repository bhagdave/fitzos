<div class="row>
	<div class="span4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span4">
		<h2>Team Members</h2>
		<?php 
			if (isset($members)){
				echo("<ul>");
				foreach($members as $member){
					echo("<li>");
					echo($member->first_name);
					echo("</li>");
				}
				echo("</ul>");
			} else {
				echo("<h4>No current members</h4>");
			}
		?>
	</div>
	<div class="span4">
		<h2>Team Wall</h2>
		<form action="teams/addWallPost" method="post">
			<input type="hidden" name="member_id" value="<?=$member->id ?>" />
			<textarea cols="40" rows="2" name="message" placeholder="Your message">
			</textarea>
			<button class="btn-small">Add post</button>
		</form>
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
</div>