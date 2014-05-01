<section class="calendar-small">
	<h2>Upcoming events</h2>
<?php 
	if (isset($public)){
		foreach($public as $post){
			echo("<div class='event'>");
 			echo("<h4><a href='/event/view/".$post->id."'>".$post->name." ".$post->sport."</a></h4>");
			if (!empty($post->content)){
				echo($post->content. "<br>");
			}
			if (!empty($post->date)){
				$date = new DateTime($post->date);
				echo($date->format('m/d/Y'). "<br>");
			}
			if (isset($post->image)){
				echo("<a href='/event/view/".$post->id."'><img height=320px src='/".$post->image."' alt='".$post->name."' title='".$post->name."'></a>");
			}
 			echo("</div>");
			
		}
	}
?>
</section>