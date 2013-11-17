<?php
if (isset($notes) && !empty($notes)){
	foreach($notes as $note){
		echo("<p>$note->notification</p>");
	}
} else {
	echo("<h2>You have no outstanding notifications</h2>");
}