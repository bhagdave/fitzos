<?php 
//var_dump($athlete);
?>
<div class="row">
	<div class="span4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span4">
		<form class="form-horizontal" action="/athlete/profile" method="post">
			<fieldset id="inputs">
				<?php $this->load->view('_blocks/all-members');?>
				<div class="control-group">
					<label class="control-label">Nickname</label>
					<div class="controls">
						<input id="nickname" name="nickname" value="<?=isset($athlete->nickname) ? $athlete->nickname : ''  ?>" type="text" placeholder="Nickname">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Units</label>
					<div class="controls">	
						<label class="radio">Metric<input id="metric" name="units" value="metric" type="radio"  <?= isset($athlete->units) && $athlete->units == 'Metric' ? 'checked' : '' ?>></label>					
						<label class="radio">Imperial<input id="imperial" name="units" value="imperial" type="radio" <?= isset($athlete->units) && $athlete->units == 'Imperial' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Height</label>
					<div class="controls">
						<input id="height" name="height" value="<?=isset($athlete->height) ? $athlete->height : ''  ?>" type="text" placeholder="Height">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Weight</label>
					<div class="controls">
						<input id="weight" name="weight" value="<?=isset($athlete->weight) ? $athlete->weight : ''  ?>" type="text" placeholder="Weight" >
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Body Fat Percentage</label>
					<div class="controls">
						<input id="bfp" name="bodyFat" value="<?=isset($athlete->body_fat_percentage) ? $athlete->body_fat_percentage : ''  ?>" type="text" placeholder="Body Fat Percentage">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Show status to others?</label>
					<div class="controls">	
						<label class="radio">Yes (I am a show off)<input id="yes" name="show_status" value="yes" type="radio" <?= isset($athlete->show_status) && $athlete->show_status == 'yes' ? 'checked' : '' ?>></label>					
						<label class="radio">No (I am shy)<input id="no" name="show_status" value="no" type="radio" <?= isset($athlete->show_status) && $athlete->show_status == 'no' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Show progress to others?</label>
					<div class="controls">	
						<label class="radio">Yes (I am a show off)<input id="yes" name="show_progress" value="yes" type="radio" <?= isset($athlete->show_progress) && $athlete->show_progress == 'yes' ? 'checked' : '' ?>></label>					
						<label class="radio">No (I am shy)<input id="no" name="show_progress" value="no" type="radio" <?= isset($athlete->show_progress) && $athlete->show_progress == 'no' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Show points in league tables?</label>
					<div class="controls">	
						<label class="radio">Yes (I am a show off)<input id="yes" name="show_tables" value="yes" type="radio" <?= isset($request['show_tables']) && $request['show_tables'] == 'yes' ? 'checked' : '' ?>></label>					
						<label class="radio">No (I am shy)<input id="no" name="show_tables" value="no" type="radio" <?= isset($athlete->show_tables) && $athlete->show_tables == 'no' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Appear in searches?</label>
					<div class="controls">	
						<label class="radio">Yes (I am a show off)<input id="yes" name="search" value="yes" type="radio" <?= isset($athlete->search) && $athlete->search == 'yes' ? 'checked' : '' ?>></label>					
						<label class="radio">No (I am shy)<input id="no" name="search" value="no" type="radio" <?= isset($athlete->search) && $athlete->search == 'no' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Would you like messaging?</label>
					<div class="controls">	
						<label class="radio">Yes (I like talking)<input id="yes" name="message" value="yes" type="radio" <?= isset($athlete->message) && $athlete->message == 'yes' ? 'checked' : '' ?>></label>					
						<label class="radio">No (I am shy)<input id="no" name="message" value="no" type="radio" <?= isset($athlete->message) && $athlete->message == 'no' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Can we hook you up with a trainer?</label>
					<div class="controls">	
						<label class="radio">Yes (I need help)<input id="yes" name="find_trainer" value="yes" type="radio" <?= isset($athlete->find_trainer) && $athlete->find_trainer == 'yes' ? 'checked' : '' ?>></label>					
						<label class="radio">No (I am good)<input id="no" name="find_trainer" value="no" type="radio" <?= isset($athlete->find_trainer) && $athlete->find_trainer == 'no' ? 'checked' : '' ?>></label>
					</div>
				</div>
				
				<button class="btn btn-success">Submit</button>	
				
			</fieldset>
			
			</form>
	</div>
	<div class="span4 top-right">
		<?php echo fuel_block('athlete_profile');?>
	</div>		
</div>
