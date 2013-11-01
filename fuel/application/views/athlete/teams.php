<?php 
$existingTeam = array();
//var_dump($athlete);
?>
<div class="row">
	<div class="span4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span4">
		<h2>Your teams</h2>
		<h4>Teams you own.</h4>
		<?php 
			if (isset($owned) && count($owned) > 0){
				foreach($owned as $team){
					$existingTeam[] = $team->name;
					echo('<a href="/teams/manage/' . $team->id .'"><p>' . $team->name. '</p></a>');
				}
			} else {
				echo("<h5>You do not currently own any teams!</h5>");
			}
		?>
		<h4>Teams you are in.</h4>
		<?php 
			if (isset($member) && count($member) > 0){
				foreach($member as $team){
					$existingTeam[] = $team->name;
					echo($team->name);
					echo("<a href='/teams/leave/{$team->id}/{$athlete->member_id}'><button>Leave</button></a>");
					echo("<a href='/teams/view/{$team->id}'><button>View</button></a>");
				}
			} else {
				echo("<h5>You are not currently in any teams!</h5>");
			}
		?>
		</div>
	<div class="span4">
		<h2>Public teams</h2>
		<?php 
		if (isset($public_teams) && count($public_teams) > 0){
		?>
		<form action="/athlete/joinTeam" method="post">
			<input type="hidden" name="member_id" value="<?=$athlete->member_id ?>" />
			<fieldset>
			<div class="ui-widget">
				<select id="teambox" name="team_id">
    				<option value="">Select a team...</option>
					<?php
						foreach($public_teams as $team){
							if (!in_array($team['name'],$existingTeams)){
								echo("<option value='" . $team['id'] . "'>".$team['name']."</option>");
							}
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
			echo("<h4>There are no public teams available at the moment!</h4>");
		}
		?>
	</div>
</div>
<div class="row-fluid">
	<div class="span2">&nbsp;</div>
	<div class="span8">
		<a href="/teams/create/<?=$athlete->member_id ?>"><h2>Create new team</h2></a>
	</div>
	<div class="span2">&nbsp;</div>
</div>