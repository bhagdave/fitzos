<?php
if (isset($sports)){
	echo("<div class='SportsForThisMonth'");
	foreach($sports as $sport){
		echo("<div class='sportCount'>");
		echo("There are $sport->count $sport->name events this month");
		echo("</div>");	
	}
	echo('</div>');
}

