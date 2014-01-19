<div class='js-Notifications'>
<?php
if (isset($notes) && !empty($notes)){
	foreach($notes as $note){
		echo("<p>$note->notification</p><button onclick='markNotificationRead(".$note->id.")'>Mark Read<button>");
	}
} else {
	echo("<h2>You have no outstanding notifications</h2>");
}
?>
</div>