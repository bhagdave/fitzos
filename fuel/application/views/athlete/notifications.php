<div class='js-Notifications'>
<?php
if (isset($notes) && !empty($notes)){
	foreach($notes as $note){
		echo("<div class='athleteNotes' >");
		echo("<p>$note->notification</p><button class='btn' onclick='markNotificationRead(".$note->id.")'>Mark Read</button>");
		echo("</div>");
	}
} else {
	echo("<p>You have no outstanding notifications</p>");
}
?>
</div>