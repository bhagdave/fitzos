	<section class="sign-in">
		<form action="../signin/start" method="post">
		<h3>Sign up</h3>
		<label class="radio inline">
  			<input type="radio" name="choice" id="athlete" value="athlete" checked>
  			Athlete
		</label>
		<label class="radio inline">
  			<input type="radio" name="choice" id="trainer" value="trainer">
  			Trainer
		</label>
		<fieldset id="inputs">
			<input id="name" class="form-control" data-bind="value: name" name="name" type="text" placeholder="Name" autofocus required>   
			<input id="email" class="form-control" data-bind="value: email" name="email" value="" type="text" placeholder="Email" required>
			<input id="password" class="form-control" data-bind="value: password,valueUpdate: 'afterkeydown'" name="password" type="password" placeholder="Password" required>
			<input id="confirm_password" class="form-control" data-bind="value: confirm,valueUpdate: 'afterkeydown'" name="confirm_password" type="password" placeholder="Confirm Password" required>			
			<br>
			<p><span data-bind="visible: matched" >Your passwords do not match</span></p>
			
			<label class="radio inline">
  				<input type="radio" name="TC" id="TC" value="Accept">
  				<small>I accept these <br clear> <a href="terms">terms and conditions</a></small>
			</label>
			<button data-bind="twButton:isDone()">Sign me up</button>
		</fieldset>
		</form>
	</section>
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
			if (showButton){
				showButton = (self.confirm() != undefined); 
			}
			if (showButton){
				showButton = self.confirm() === self.password(); 
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
	

