<?php 
//var_dump($athlete);
?>
<div class="row">
	<div class="col-md-4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
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
					<div data-bind="visible: metric" class="controls">
						<input id="height" data-bind="value: height" name="height" type="text" placeholder="Height in metres">
					</div>
					<div data-bind="visible: imperial" class="controls">
						<input id="height" data-bind="value: heightFeet" name="height-feet" type="text" placeholder="Feet">
						<input id="height" data-bind="value: heightInches" name="height-inches" type="text" placeholder="Inches">
					</div>
				<div class="control-group">
					<label class="control-label">Weight</label>
					<div data-bind="visible: metric" class="controls">
						<input id="weight" data-bind="value: weight" name="weight" type="text" placeholder="Weight in Kilos" >
					</div>
					<div data-bind="visible: imperial" class="controls">
						<input id="weight" data-bind="value: weightPounds" name="weight-pounds" type="text" placeholder="Weight in Pounds" >
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Body Fat Percentage</label>
					<div class="controls">
						<input id="bfp" name="bodyFat" data-bind="value: body_fat_percentage" type="text" placeholder="Body Fat Percentage">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Show status to others?</label>
					<div class="controls">	
						<label class="radio">Yes (I am a show off)<input id="yes" name="show_status" value="Yes" type="radio" data-bind="checked: show_status"></label>					
						<label class="radio">No (I am shy)<input id="no" name="show_status" value="No" type="radio" data-bind="checked: show_status"></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Show progress to others?</label>
					<div class="controls">	
						<label class="radio">Yes (I am a show off)<input id="yes" name="show_progress" value="Yes" type="radio" data-bind="checked: show_progress"></label>					
						<label class="radio">No (I am shy)<input id="no" name="show_progress" value="No" type="radio" data-bind="checked: show_progress"></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Show points in league tables?</label>
					<div class="controls">	
						<label class="radio">Yes (I am a show off)<input id="yes" name="show_tables" value="Yes" type="radio" data-bind="checked: show_tables"></label>					
						<label class="radio">No (I am shy)<input id="no" name="show_tables" value="No" type="radio" data-bind="checked: show_tables"></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Appear in searches?</label>
					<div class="controls">	
						<label class="radio">Yes (I am a show off)<input id="yes" name="search" value="Yes" type="radio" data-bind="checked: search"></label>					
						<label class="radio">No (I am shy)<input id="no" name="search" value="No" type="radio" data-bind="checked: search"></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Would you like messaging?</label>
					<div class="controls">	
						<label class="radio">Yes (I like talking)<input id="yes" name="message" value="Yes" type="radio" data-bind="checked: message"></label>					
						<label class="radio">No (I am shy)<input id="no" name="message" value="No" type="radio" data-bind="checked: message"></label>
					</div>
				</div>
<!-- 				<div class="control-group"> -->
<!-- 					<label class="control-label">Can we hook you up with a trainer?</label> -->
<!-- 					<div class="controls">	 -->
<!-- 						<label class="radio">Yes (I need help)<input id="yes" name="find_trainer" value="Yes" type="radio" data-bind="checked: find_trainer"></label>					 -->
<!-- 						<label class="radio">No (I am good)<input id="no" name="find_trainer" value="No" type="radio" data-bind="checked: find_trainer"></label> -->
<!-- 					</div> -->
<!-- 				</div> -->
				<input type="hidden" name="find_trainer" value="No">
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
				<button class="btn btn-success" >Submit</button>	
				
			</fieldset>
			
			</form>
	</div>
	<div class="col-md-4 col-md-offset-1 top-right">
		<?php echo fuel_block('athlete_profile');?>
	</div>		
</div>
<script type="text/javascript">
function roundit(which){
	return Math.round(which*100)
	}
					
function profileView(){
	var self = this;
	self.id = ko.observable();
	self.nickname = ko.observable();
	self.units = ko.observable('Metric');
	self.height = ko.observable();
	self.heightFeet = ko.computed({
		read: function(){
			var feet = (Math.floor(self.height()*3.28084));
			return(feet);	
		},
		write: function(value){
			var inches = value * 12;
			inches = inches + self.heightInches();
			var cm = (inches * 2.54);
			cm = parseFloat(cm).toFixed(2);
			self.height(parseFloat(cm).toFixed(2)/100);
		},
		owner: this
	});
	self.heightInches = ko.computed({
		read: function(){
		return(roundit(self.height()/2.54) % 12);	
		},
		write: function(value){
			var inches = parseInt(value);
			inches = inches + (self.heightFeet() * 12);
			var cm = (inches * 2.54);
			cm = parseFloat(cm).toFixed(2);
			self.height(parseFloat(cm).toFixed(2)/100);
		},
		owner: this
	});
	self.weight = ko.observable();
	self.weightPounds = ko.computed({
		read: function(){
			return(Math.round(self.weight()*2.20462));	
		},
		write: function(value){
			var lbs = value;
			self.weight(Math.round(lbs * 0.453592));
		},
		owner:this
	});
	self.body_fat_percentage = ko.observable();
	self.show_status = ko.observable();
	self.show_progress = ko.observable();
	self.show_tables = ko.observable();
	self.search = ko.observable();
	self.message = ko.observable();
	self.find_trainer = ko.observable();
	self.metric = ko.observable(true);
	self.imperial = ko.observable(false);
	self.units.subscribe(function(newValue){
		if (newValue === 'Metric'){
			self.metric(true);
			self.imperial(false);
		} else {
			self.metric(false);
			self.imperial(true);
		}
	});
	$.getJSON("/athlete/getAthlete", function(data) {
		self.id(data.id); 
		self.nickname(data.nickname);
		self.units(data.units);
		self.height(data.height);
		self.weight(data.weight);
		self.body_fat_percentage(data.body_fat_percentage);
		self.show_status(data.show_status);
		self.show_progress(data.show_progress);
		self.show_tables(data.show_tables);
		self.search(data.search);
		self.message(data.message);
		self.find_trainer(data.find_trainer);	
	})
}
ko.applyBindings(new profileView());
</script>
<script>
	$('#Fuck').bind('click',function(){
		console.log($('#weight').val());
	});	
</script>