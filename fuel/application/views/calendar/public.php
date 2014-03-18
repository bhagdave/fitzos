<div class="calendar-small">
<?php 
	if (isset($public)){
		foreach($public as $event){
			echo("<div class='event'>");
			echo($event->id);
			echo("</div>");
		}
	}
?>
</div>