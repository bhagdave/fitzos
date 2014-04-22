<div class="col-md-12">
	<div class="row">
		<div class="col-md-4 col-md-offset-3">
			<h2><?=$team->name ?>(Manage Sports)</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h2>Existing sports</h2>
			<?php
				if (isset($linkedSports) && !empty($linkedSports)){
					foreach($linkedSports as $sport){
						echo("<p>$sport->name</p>");
					}
				}
			?>
		</div>
		<div class="col-md-4">
		<h2>Add a new sport</h2>
		<form method="post">
			<input type="hidden" name="team_id" value="<?=$team->id ?>" />
			<fieldset>
				<div class="ui-widget">
					<label>Select a sport for your team</label>
					<select multiple required id="sportsbox" name="sport_id">
	    				<option value="">Select a sport</option>
						<?php
							foreach($sports as $sport){
								echo("<option value='" . $sport['id'] . "'>".$sport['name']."</option>");
							} 
						?>
					</select>
				</div>	
				<button class="btn btn-success">Add Sport</button>	
			</fieldset>
		</form>
		</div>
	</div>
</div>

