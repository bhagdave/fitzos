<?php
if (isset($sportsForThisMonth) && count($sportsForThisMonth)>0){
	echo("<h2>Upcoming events</h2>");
	echo("<div class='SportsForThisMonth'>");
	foreach($sportsForThisMonth as $sport){
		echo("<div class='sportCount'>");
		echo("<a href='/calendar/view/$sport->name'>");
		echo("There are $sport->count $sport->name events this month");
		echo("</a>");
		echo("</div>");	
	}
	echo("</div>");
} 

