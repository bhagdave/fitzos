<div class="findFriendForm">
	<form action="/find/search" method="post" >
		<input type="text" name="name" placeholder="Name" value="<?=isset($criteria['name']) ? $criteria['name'] : ''; ?>" />
		<input type="text" name="sport" placeholder="Sport" value="<?=isset($criteria['sport']) ? $criteria['sport'] : ''; ?>" />
		<input type="text" name="location" placeholder="Location" value="<?=isset($criteria['location']) ? $criteria['location'] : ''; ?>" />
		<input type="submit" class="btn btn-success" value="Search"/>
	</form>
</div>
<div class="results">
	<?php 
		if (isset($results)){
			if (count($results['locations'])>0){
				echo("<h2>Members matching location</h2>");
				foreach($results['locations'] as $location){
					echo("<a href='/athlete/view/$location->id'>$location->first_name $location->last_name</a>");	
				}
			}
			if (count($results['sports'])>0){
				echo("<h2>Members matching sport</h2>");
				foreach($results['sports'] as $sport){
					echo("<a href='/athlete/view/$sport->id'>$sport->first_name $sport->last_name</a>");
				}
			}
			if (count($results['names'])>0){
				echo("<h2>Members matching name</h2>");
				foreach($results['names'] as $name){
					echo("<a href='/athlete/view/$name->id'>$name->first_name $name->last_name</a>");
				}
			}
		}
		?>
</div>
<div class="suggestions">
	<?php 
		if (isset($suggestions)){
			if (count($suggestions['locations'])>0){
				echo("<h2>Members with a similar location</h2>");
				foreach($suggestions['locations'] as $location){
					echo("<a href='/athlete/view/$location->id'>$location->first_name $location->last_name</a>");	
				}
			}
			if (count($suggestions['sports'])>0){
				echo("<h2>Members with the same sports</h2>");
				foreach($suggestions['sports'] as $sport){
					echo("<a href='/athlete/view/$sport->id'>$sport->first_name $sport->last_name</a>");
				}
			}
		}
	?>
</div>

