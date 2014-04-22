<?php
if (isset($linkedSports) && !empty($linkedSports)){
} else {
	echo("<p>No sports currently linked!</p>");	
}
?>
<a href="/teams/sports/<?=$team->id ?>">Manage team sports</a>
