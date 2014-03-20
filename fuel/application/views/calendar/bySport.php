<?php
if (isset($sportsForThisMonth)){
	echo("<div class='SportsForThisMonth'");
	foreach($sportsForThisMonth as $sport){
		echo("<div class='sportCount'>");
		echo("There are $sport->count $sport->name events this month");
		echo("</div>");	
	}
	echo('</div>');
}

