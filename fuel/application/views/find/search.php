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
		$noResults = true;
		if (isset($results)){
			if (count($results['combined'])>0){
				echo("<div class='row'>");
				echo("<div class='col-md-12'>");
				echo("<h4>All criteria</h4>");
				foreach($results['combined'] as $combined){
					echo("<div class='searchResult'>");
					echo("<a href='/athlete/view/$combined->id'>");
					if (isset($combined->image)){
						echo("<img src='/$combined->image'></a>");
						echo("<p>$combined->first_name $combined->last_name</p>");
					} else {
						echo("$combined->first_name $combined->last_name</a>");
					}
					echo("</div>");	
					$noResults = false;
				}
				echo("</div></div>");
			}
			if (count($results['locations'])>0){
				echo("<div class='row'>");
				echo("<div class='col-md-12'>");
				echo("<h4>Location</h4>");
				foreach($results['locations'] as $location){
					echo("<div class='searchResult'>");
					echo("<a href='/athlete/view/$location->id'>");
					if (isset($location->image)){
						echo("<img src='/$location->image'></a>");
						echo("<p>$location->first_name $location->last_name</p>");
					} else {
						echo("$location->first_name $location->last_name</a>");
					}
					echo("</div>");	
					$noResults = false;
				}
				echo("</div></div>");
			}
			if (count($results['sports'])>0){
				echo("<div class='row'>");
				echo("<div class='col-md-12'>");
				echo("<h4>Sport</h4>");
				foreach($results['sports'] as $sport){
					echo("<div class='searchResult'>");
					echo("<a href='/athlete/view/$sport->id'>");
					if (isset($sport->image)){
						echo("<img src='/$sport->image'></a>");
						echo("<p>$sport->first_name $sport->last_name</p>");
					} else {
						echo("$sport->first_name $sport->last_name</a>");
					}
					echo("</div>");	
					$noResults = false;
				}
				echo("</div></div>");
			}
			if (count($results['names'])>0){
				echo("<div class='row'>");
				echo("<div class='col-md-12'>");
				echo("<h4>Name</h4>");
				foreach($results['names'] as $name){
					echo("<div class='searchResult'>");
					echo("<a href='/athlete/view/$name->id'>");
					if (isset($name->image)){
						echo("<img src='/$name->image'></a>");
						echo("<p>$name->first_name $name->last_name</p>");
					} else {
						echo("$name->first_name $name->last_name</a>");
					}
					echo("</div>");	
					$noResults = false;
				}
				echo("</div></div>");
			}
		}
		if ($noResults && isset($criteria)){
			echo("<div class='row'><div class='col-md-12'>");
			echo("<h2>No results found.</h2>");
			echo("</div></div>");
		}
		?>
</div>
<div class="suggestions">
	<?php 
		if (isset($suggestions)){
			if (count($suggestions['locations'])>0){
				echo("<h2>Members with a similar location as you</h2>");
				foreach($suggestions['locations'] as $location){
					echo("<a href='/athlete/view/$location->id'>");
					if (isset($location->image)){
						echo("<img src='/$location->image'>");
					}
					echo("$location->first_name $location->last_name</a>");
				}
			}
			if (count($suggestions['sports'])>0){
				echo("<h2>Members with the same sports as you</h2>");
				foreach($suggestions['sports'] as $sport){
					echo("<a href='/athlete/view/$sport->id'>");
					if (isset($sport->image)){
						echo("<img src='/$sport->image'>");
					}
					echo("$sport->first_name $sport->last_name</a>");
				}
			}
		}
	?>
</div>

