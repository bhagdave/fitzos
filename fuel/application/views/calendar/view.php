<div class="calendar-header">
<?php 
	foreach($events as $event){
		echo("<div class='calendar-event'><h3>");
		echo("<a href='/event/view/".$event->id."'>");
		
		echo($event->name . ' ' . $event->sport);
		echo("</a></h3>");
		if (isset($event->date)){
			$eventDate = new DateTime($event->date);
		}
		?>
		<h4><?=isset($event->location) ? $event->location : ''; ?><?=isset($eventDate) ? ' on ' .$eventDate->format('d/m/Y') : ''; ?><?=isset($event->time) ? ' @ ' . $event->time : ''; ?></h4>
		<?php 				
		echo("</div>");
	}
?>
</div>