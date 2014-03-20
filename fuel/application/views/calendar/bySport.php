<h2>Upcoming events</h2>
<?php
if (isset($sportsForThisMonth) && count($sportsForThisMonth)>0){
	echo("<div class='SportsForThisMonth'>");
	foreach($sportsForThisMonth as $sport){
		echo("<div class='sportCount'>");
		echo("There are $sport->count $sport->name events this month");
		echo("</div>");	
	}
	echo("</div>");
} else {
	echo("<h4>None at the moment. Check again later!</h4>");
}

