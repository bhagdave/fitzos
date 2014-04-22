<?php
if (isset($linkedSports) && !empty($linkedSports)){
} else {
	echo("No sports currently linked!");	
}
?>
<a href="/teams/sports/<?=$team->sport_id ?>">Manage team sports</a>
