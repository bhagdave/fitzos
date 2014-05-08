<?php 
	if (isset($athlete)){
		$person = $athlete;
	}
	if (isset($trainer)){
		$person = $trainer;
	}
	?>
		<h2>Personal Details</h2>
			<div class="control-group">	
				<label class="control-label">Age:</label>
				<div class="controls">
					<input id="age" class="form-control" name="age" value="<?=isset($person->age) ? $person->age : ''  ?>" type="text" placeholder="Age" autofocus required>   
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Gender</label>
				<div class="controls">	
					<label class="radio">Male<input id="male" name="gender" value="male" type="radio" required <?= isset($person->gender) && ucfirst($person->gender) == 'Male' ? 'checked' : '' ?>></label>					
					<label class="radio">Female<input id="female" name="gender" value="female" type="radio" required <?= isset($person->gender) && ucfirst($person->gender) == 'Female' ? 'checked' : '' ?>></label>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Location</label>
				<div class="controls">
					<input id="location" class="form-control" name="location" value="<?=isset($person->location) ? $person->location : ''  ?>" type="text" placeholder="Location" required>
				</div>
			</div>
