<?php 
$existingTeam = array();
//var_dump($athlete);
?>
<div class="row">
	<div class="col-md-4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<h2>Your teams</h2>
		<h3>Teams you own.</h3>
		<?php 
			if (isset($owned) && count($owned) > 0){
				foreach($owned as $team){
					echo("<div class='athleteTeams'>");
					$existingTeam[] = $team->name;
					echo('<a href="/teams/manage/' . $team->id .'"><p>' . $team->name. '</p></a>');
					echo("</div>");
				}
			} else {
				echo("<h5>You do not currently own any teams!</h5>");
			}
		?>
		<h3>Teams you are in.</h3>
		<?php 
			if (isset($member) && count($member) > 0){
				foreach($member as $team){
					echo("<div class='athleteTeams'>");
					$existingTeam[] = $team->name;
					echo("<a href='/teams/view/{$team->id}'>".$team->name. "</a>");
					echo("<a style='padding:10px;margin:0 auto;' id='leaveTeam' href='/teams/leave/{$team->id}/{$athlete->member_id}'><button>Leave</button></a>");
					echo("</div>");
				}
				if (isset($owned) && count($owned) > 0){
					foreach($owned as $team){
						echo("<div class='athleteTeams'>");
						$existingTeam[] = $team->name;
						echo('<a href="/teams/manage/' . $team->id .'"><p>' . $team->name. '</p></a>');
						echo("</div>");
					}
				} 
			} else {
				if (isset($owned) && count($owned) > 0){
					foreach($owned as $team){
						echo("<div class='athleteTeams'>");
						$existingTeam[] = $team->name;
						echo('<a href="/teams/manage/' . $team->id .'"><p>' . $team->name. '</p></a>');
						echo("</div>");
					}
				} else {
					echo("<h5>You are not currently in any teams!</h5>");
				}
			}
		?>
		</div>
	<div class="col-md-6">
		<h2>Public teams</h2>
		<?php 
		if (isset($public_teams) && count($public_teams) > 0){
		?>
		<form action="/athlete/joinTeam" method="post" id="js-JoinTeam">
			<input type="hidden" name="member_id" value="<?=$athlete->member_id ?>" />
			<fieldset>
			<div class="ui-widget">
				<select id="teambox" name="team_id">
    				<option value="">Select a team...</option>
					<?php
						foreach($public_teams as $team){
							echo("<option value='" . $team->id . "'>".$team->name."</option>");
						} 
					?>
				</select>
				<button class="btn btn-success">Join</button>	
			</div>
			</fieldset>
		</form>
		<?php 
		}
		else {
			echo("<h4>There are no public teams that you are not already a member of at the moment!</h4>");
		}
		?>
	</div>
	<div id="js-TeamMessages"></div>
</div>

<div class="row">
	<div class="col-md-4">&nbsp;</div>
	<div class="col-md-8">
		<a href="/teams/create/<?=$athlete->member_id ?>"><h2>Create new team</h2></a>
	</div>
	<div class="col-md-2">&nbsp;</div>
</div>
