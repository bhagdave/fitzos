<div class="calendar-header">
	<table>
		<caption>Upcoming events</caption>
		<tr>
			<th>Date</th>
			<th>Event</th>
			<th>Sport</th>
			<th>Location</th>
			<th>Team</th>
			<th>Attendance</th>
		</tr>
<?php 
	foreach($events as $event){
		echo("<tr class='calendar-event'>");
		if (isset($event->date)){
			$eventDate = new DateTime($event->date);
		}
		echo("<td>");
		isset($eventDate) ? $eventDate : '';
		echo("</td>");
		echo("<td><a href='/event/view/$event->id'>$event->name</a></td>");
		echo("<td>$event->sport</td>");
		echo("<td>$event->location</td>");
		echo("<td><a href='/teams/view/$event->teamId'>$event->team</a></td>");
		if (isset($user)){
			echo("<td><button onclick='attendEvent(".$event->id.",".$user.");'>Attend</button></td>");
		} else {
			echo("<td><a href='/signin/start'><button>Register</button></a></td>");
		}
		echo("</tr>");
	}
?>
	</table>
</div>