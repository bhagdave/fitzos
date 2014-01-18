<?php 
//var_dump($athlete);
?>
<div class="row">
	<div class="col-md-4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="col-md-6">
<div class="row">
	<div class="col-md-6">
		<form class="form-horizontal" action="/athlete/profile" method="post" enctype="multipart/form-data">
			<fieldset id="inputs">
				<?php $this->load->view('_blocks/all-members');?>
				<div class="control-group">
					<label class="control-label">Nickname</label>
					<div class="controls">
						<input id="nickname" data-bind="value: nickname" name="nickname"  type="text" placeholder="Nickname">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Units</label>
					<div class="controls">	
						<label class="radio">Metric<input data-bind="checked: units" id="metric" name="units" value="Metric" type="radio"></label>					
						<label class="radio">Imperial<input data-bind="checked: units" id="imperial" name="units" value="Imperial" type="radio"></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Height</label>
					<div class="controls">
						<input id="height" data-bind="value: height" name="height" type="text" placeholder="Height">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Weight</label>
					<div class="controls">
						<input id="weight" data-bind="value: weight" name="weight" type="text" placeholder="Weight" >
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
						<label class="radio">Yes (I am a show off)<input id="yes" name="show_status" value="Yes" type="radio" data-bind="checked: showstatus"></label>					
						<label class="radio">No (I am shy)<input id="no" name="show_status" value="No" type="radio" data-bind="checked: showstatus"></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Show progress to others?</label>
					<div class="controls">	
						<label class="radio">Yes (I am a show off)<input id="yes" name="show_progress" value="Yes" type="radio" <?= isset($athlete->show_progress) && $athlete->show_progress == 'Yes' ? 'checked' : '' ?>></label>					
						<label class="radio">No (I am shy)<input id="no" name="show_progress" value="No" type="radio" <?= isset($athlete->show_progress) && $athlete->show_progress == 'No' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Show points in league tables?</label>
					<div class="controls">	
						<label class="radio">Yes (I am a show off)<input id="yes" name="show_tables" value="Yes" type="radio" <?= isset($request['show_tables']) && $request['show_tables'] == 'Yes' ? 'checked' : '' ?>></label>					
						<label class="radio">No (I am shy)<input id="no" name="show_tables" value="No" type="radio" <?= isset($athlete->show_tables) && $athlete->show_tables == 'No' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Appear in searches?</label>
					<div class="controls">	
						<label class="radio">Yes (I am a show off)<input id="yes" name="search" value="Yes" type="radio" <?= isset($athlete->search) && $athlete->search == 'Yes' ? 'checked' : '' ?>></label>					
						<label class="radio">No (I am shy)<input id="no" name="search" value="No" type="radio" <?= isset($athlete->search) && $athlete->search == 'No' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Would you like messaging?</label>
					<div class="controls">	
						<label class="radio">Yes (I like talking)<input id="yes" name="message" value="Yes" type="radio" <?= isset($athlete->message) && $athlete->message == 'Yes' ? 'checked' : '' ?>></label>					
						<label class="radio">No (I am shy)<input id="no" name="message" value="No" type="radio" <?= isset($athlete->message) && $athlete->message == 'No' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Can we hook you up with a trainer?</label>
					<div class="controls">	
						<label class="radio">Yes (I need help)<input id="yes" name="find_trainer" value="Yes" type="radio" <?= isset($athlete->find_trainer) && $athlete->find_trainer == 'Yes' ? 'checked' : '' ?>></label>					
						<label class="radio">No (I am good)<input id="no" name="find_trainer" value="No" type="radio" <?= isset($athlete->find_trainer) && $athlete->find_trainer == 'No' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Profile image</label>
					<?php 
						if (isset($member->image)){
							echo("<img src='/$member->image'>");
						} 
					?>
					<div class="controls">	
						<input type="file" name="file" id="file" value="<?=isset($member->image) ? $member->image : ''  ?>">
					</div>
				</div>
				<button class="btn btn-success">Submit</button>	
				
			</fieldset>
			
			</form>
	</div>
	<div class="col-md-4 col-md-offset-1 top-right">
		<?php echo fuel_block('athlete_profile');?>
	</div>		
</div>
</div>
<script type="text/javascript">
function profileView(){
	var self = this;
	self.nickname   = ko.observable();
	self.units      = ko.observable();
	self.height     = ko.observable();
	self.weight     = ko.observable();
	self.bfp	    = ko.observable();
	self.showstatus = ko.observable();
	$.getJSON("/athlete/getAthlete", function(data) { 
		self.nickname(data.nickname);
		self.units(data.units);
		self.height(data.height);	
		self.weight(data.weight);
		self.bfp(data.body_fat_percentage);
		self.showstatus(data.show_status);
			
	})		
}
ko.applyBindings(new profileView());
</script>