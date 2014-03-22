<?php
	if (isset($friends)){
		foreach($friends as $friend){
			echo("<p>");
			echo("<a href='/athlete/view/$friend->id'>");
			echo("$friend->first_name $friend->last_name");
			echo("</a>");
			echo("</p>");
		}
	}