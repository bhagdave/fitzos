<div class="row">
	<div class="col-md-4">
		<h2><?=isset($member) ? $member->first_name . ' ' . $member->last_name : '' ; ?></h2>
		<p>Nickname:<?= isset($athlete->nickname) ? $athlete->nickname :'' ?></p>
		<p>DOB:<?= isset($athlete->dob) ? $athlete->dob :'' ?></p>
		<p>Gender:<?= isset($athlete->gender) ? $athlete->gender :'' ?></p>
		<p>Activity:<?= isset($athlete->activity) ? $athlete->activity :'' ?></p>
		<p>Country:<?= isset($athlete->country) ? $athlete->country :'' ?></p>
		<p>Location:<?= isset($athlete->location) ? $athlete->location :'' ?></p>
	</div>
	<div class="col-md-4">
		<?php 
			if (isset($member) && isset($member->image)){
				echo("<img src='/$member->image'>");
			}
		?>
	</div>
	<div class="col-md-4">
		<h2>Their Sports</h2>
	<?php
		if (isset($sports)){
			foreach($sports as $sport){
				echo("<h4>$sport->sport</h4>");
				if (isset($sport->from_date)){
					$date = new DateTime($sport->from_date);
					echo("From: ". $date->format('m/d/Y'));
				}
				if (isset($sport->to_date)){
					$date = new DateTime($sport->to_date);
					echo(" Until " . $date->format('m/d/Y'));
				}
				echo("<br>");
				$existingSports[] = $sport->sport;
			}
		}
	?>
	</div>
</div>
		