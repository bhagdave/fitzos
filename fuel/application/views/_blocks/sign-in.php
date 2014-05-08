	<div class="signin-splash">
			<h1>Sign up now and start your ascent</h1>
			<h4>While exploring Reach Your Peak's features, please excuse our appearance and any bugs.  We are still in early development (Alpha) but want to start our ascent with a select few chosen athletes.  Thank you</h4>
		<form action="../signin/start" method="post">
  			<label class="select-label">
  				<select name="choice" id="trainer" value="trainer">
  					<option value="athlete">Athlete</option>
<!--   					<option value="trainer">Trainer</option> -->
  				</select>
  			</label>
			<input id="name" class="form-control" data-bind="value: name" name="name" type="text" placeholder="Name" autofocus required>   
			<input id="email" class="form-control" data-bind="value: email" name="email" value="" type="text" placeholder="Email" required>
			<input id="password" class="form-control" data-bind="value: password,valueUpdate: 'afterkeydown'" name="password" type="password" placeholder="Password" required>
	  		<input type="radio" name="TC" id="TC" value="Accept">
	  		<label for="TC">I accept <a class="js-terms" href="#">the terms and conditions</a></label>
			<button class="submit-btn" data-bind="twButton:isDone()">Sign me up</button>
		</form>
	</div>


<script type="text/javascript">
	function SignupModel(){
		var self   = this;
		self.name  = ko.observable(<?=isset($request['name']) ? $request['name'] : ''  ?>);
		self.email = ko.observable(<?=isset($request['email']) ? $request['email'] : ''  ?>);
		self.password = ko.observable();
		self.confirm  = ko.observable();
		self.isDone   = ko.computed(function(){
			var showButton = (self.name() != undefined);
			if (showButton){
				showButton = (self.email() != undefined); 
			}
			if (showButton){
				showButton = (self.password() != undefined); 
			}
			return showButton;	
		},this);
		self.matched  = ko.computed(function(){
			return self.confirm() != self.password();	
		},this);
	};
	ko.bindingHandlers.twButton = {
		init  : function(element){
			$(element).addClass('btn btn-success btn-mini');
			$(element).prop('disabled',true);
		},
		update: function(element, valueAccessor){
			var current = valueAccessor();
			$(element).prop('disabled',!current);
		}
	};
	ko.applyBindings(new SignupModel());
</script>
	

