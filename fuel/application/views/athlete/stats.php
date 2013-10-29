<?php
//var_dump($athlete);
//var_dump($positions);
//var_dump($stats);
//var_dump($athlete_stats);
if (isset($athlete_stats) && count($athlete_stats) > 0){
	// show them stats baby....
	echo("<h2>Current statistics for " .$sport['name'] .".</h2>");
	foreach($athlete_stats as $stat){
	?>
		<h4><?=$stat->statistic_name ?></h4>
		<h4><?=$stat->statistic_value ?></h4>
		<h4><?=$stat->date ?></h4>
	<?php 
	}
} else {
	echo("<h2>You do not currently have any statistics recorded for " .$sport['name'] .".</h2>");
}
?>
<h3>Add a new statistic!</h3>
<form action="/athlete/addStats" method="post" />
<input type="hidden" name="source_table" value="member" />
<input type="hidden" name="source_id" value="<?=$athlete->member_id ?>" />
<input type="hidden" name="sport_id" value="<?=$sport['id'] ?>" />
<?php 
if (isset($positions) && count($positions) > 0){
	echo('<select class="js-positionSelect" name="position_id">');
	foreach($position as $position){
		?>
		<option value="<?=$position->id ?>"><?=$position->name ?></option>
		<?php 
	}
	echo('</select>');
} else {
	echo("<div class='js-stats'>");
	// no positions for this sport so just show stats..
	if (isset($stats) && count($stats) > 0){
		echo('<select name="statistic_name">');
		foreach($stats as $stat){
			?>
			<option value="<?=$stat->statistic_name ?>"><?=$stat->description ?></option>
			<?php 
		}
		echo('</select>');
	} else {
		// no stats setup add input box
		?>
			<input type="text" placeholder="Statistic" name="statistic_name" value="" />
		<?php 
	}
	echo('<input type="text" placeholder="Statistic Value" name="statistic_value" value="" />');
	echo('</div>');
}
?>
<input placeholder="Date" type="text" class="datepicker" name="date" />
<button class="btn btn-success">Submit</button>	
</form>