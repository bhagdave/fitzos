<div class="col-md-6">
<div class="row">
	<div class="span2">&nbsp;</div>
	<div class="span8">
		<h2>Create new team</h2>
		<form action="/teams/create/<?=$member->id ?>" method="post">
			<input type="hidden" name="owner" value="<?=$member->id ?>" />
			<fieldset>
				<input type="text" required name="name" value="" placeholder="Name" />
				<label>Active</label>
				<input type="radio" name="active" value="yes">Yes<br>
				<input type="radio" name="active" value="no">No
				<label>Public?</label>
				<input type="radio" name="public" value="yes">Yes<br>
				<input type="radio" name="public" value="no">No
				<div class="ui-widget">
					<label>Sport</label>
					<select required id="sportsbox" name="sport_id">
	    				<option value="">Select a sport</option>
						<?php
							foreach($sports as $sport){
								echo("<option value='" . $sport['id'] . "'>".$sport['name']."</option>");
							} 
						?>
					</select>
				</div>	
				<button class="btn btn-success">Submit</button>	
			</fieldset>
		</form>
	</div>
</div>
</div>