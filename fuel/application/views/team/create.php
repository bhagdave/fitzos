<div class="row">
	<div class="span2">&nbsp;</div>
	<div class="span8">
		<h2>Create new team</h2>
		<form class="teamCreate" action="/teams/create/<?=$member->id ?>" method="post">
			<input type="hidden" name="owner" value="<?=$member->id ?>" />
			<fieldset>
				<input type="text" required name="name" value="" placeholder="Name" /><br>
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
				<div class="ui-widget">
					<label>Active</label>
					<input type="radio" name="active" value="yes">Yes
					<input type="radio" name="active" value="no">No
				</div>
				<div class="ui-widget">
					<label>Public?</label>
					<input type="radio" name="public" value="yes">Yes
					<input type="radio" name="public" value="no">No
				</div>
				<button class="btn btn-success">Submit</button>	
			</fieldset>
		</form>
	</div>
</div>
