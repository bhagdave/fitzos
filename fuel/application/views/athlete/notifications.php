<div class='js-Notifications'>
<?php
if (isset($notes) && !empty($notes)){
	foreach($notes as $note){
		echo("<div class='athleteNotes' style='border:1px solid;border-radius:10px;'>");
		echo("<p>$note->notification</p><button onclick='markNotificationRead(".$note->id.")'>Mark Read</button>");
		echo("</div>");
	}
} else {
	echo("<h2>You have no outstanding notifications</h2>");
}
?>
</div>