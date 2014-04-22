<?php
if (isset($linkedSports) && !empty($linkedSports)){
} else {
	echo("<p>No sports currently linked!</p>");	
}
?>
<a href="/teams/sports/<?=$team->sport_id ?>">Manage team sports</a>
