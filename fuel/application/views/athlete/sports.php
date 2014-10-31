<?php 
$existingSports = array();
?>
<div class="row">
	<div class="col-md-12">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="col-md-12">
	<div class="row">
		<div class="col-md-4">
			<h2>Your Existing Sports</h2>
		<?php
			if (isset($members_sports)){
				foreach($members_sports as $sport){
					echo("<div class='athleteSports'>");
					echo("<a href='/athlete/stats/{$sport->id}'><h4>$sport->sport</h4></a>");
					if (isset($sport->from_date)){
						$date = new DateTime($sport->from_date);
						echo("Started my ascent on " . $date->format("m/d/Y"));
					}
					$existingSports[] = $sport->sport;
					echo("</div>");
					echo("<hr>");
				}
			}
		?>
		</div>
		<div class="col-md-4">
			<h2>Add a Sport</h2>
			<form action="/athlete/sports" method="post">
				<input type="hidden" name="member_id" value="<?=$athlete->member_id ?>" />
				<fieldset>
				<div class="ui-widget">
					<select id="sportsbox" name="sport_id" placeholder="Type a sport">
	    				<option value="">Select a sport</option>
						<?php
							foreach($sports as $sport){
								if (!in_array($sport['name'],$existingSports)){
									echo("<option value='" . $sport['id'] . "'>".$sport['name']."</option>");
								}
							} 
						?>
					</select>
					<input placeholder="Started my ascent on" type="text" class="datepicker"  data-date-format="mm/dd/yyyy"  name="from_date" />
					<button class="btn btn-success">Submit</button>	
				</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>