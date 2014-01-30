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
		<div class="col-md-4 col-md-offset-1">
			<h2>Your Existing Sports</h2>
		<?php
			if (isset($members_sports)){
				foreach($members_sports as $sport){
					echo("<div class='athleteSports' style='border:1px solid;border-radius:10px;'>");
					echo("<a href='/athlete/stats/{$sport->id}'><h4>$sport->sport</h4></a>");
					if (isset($sport->from_date)){
						echo("From $sport->from_date");
					}
					if (isset($sport->to_date)){
						echo(" Until $sport->to_date");
					}
					$existingSports[] = $sport->sport;
					echo("</div>");
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
					<select id="sportsbox" name="sport_id">
	    				<option value="">Select one...</option>
						<?php
							foreach($sports as $sport){
								if (!in_array($sport['name'],$existingSports)){
									echo("<option value='" . $sport['id'] . "'>".$sport['name']."</option>");
								}
							} 
						?>
					</select>
					<input placeholder="From Date" type="text" class="datepicker" name="from_date" />
					<input placeholder="To date" type="text" class="datepicker" name="to_date" />	
					<button class="btn btn-success">Submit</button>	
				</div>
				</fieldset>
			</form>
			<a href="#"  class="btn js-addASport">Add a new sport!</a>
		</div>
	</div>
</div>