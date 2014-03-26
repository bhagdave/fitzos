<div class="calendar-header">
<?php 
	foreach($events as $event){
		echo("<div class='calendar-event'><h2>");
		echo($event->name);
		echo("</h2></div>");
	}
?>
</div>