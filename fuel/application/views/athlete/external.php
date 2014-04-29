<div class="row">
	<div class="col-md-8">
		<h1><?=$member->first_name ?> <?=$member->last_name ?></h1>
	</div>
	<div class="col-md-4">
		<p><?=$athlete->gender?></p>
		<p><?=$athlete->location?></p>
		<p><?=$athlete->age?></p>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<h4>Sports</h4>
		<?php
			if (isset($sports)){
				foreach($sports as $sport){
					echo("<div class='athleteSports'>");
					echo("<h5>$sport->sport</h5>");
					if (isset($sport->from_date)){
						$date = new DateTime($sport->from_date);
						echo("From: ". $date->format('m/d/Y'));
					}
					if (isset($sport->to_date)){
						$date = new DateTime($sport->to_date);
						echo(" Until " . $date->format('m/d/Y'));
					}
					echo("</div>");
					$existingSports[] = $sport->sport;
				}
			} else {
				echo("This member has no sports currently set!");
			}
		?>
	</div>
</div>