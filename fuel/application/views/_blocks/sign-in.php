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
			<input id="name" data-bind="value: name" name="name" value="<?=isset($request['name']) ? $request['name'] : ''  ?>" type="text" placeholder="Name" autofocus required>   
			<input id="email" data-bind="value: email" name="email" value="<?=isset($request['email']) ? $request['email'] : ''  ?>" type="text" placeholder="Email" required>
			<input id="password" data-bind="value: password,valueUpdate: 'afterkeydown'" name="password" value="<?=isset($request['password']) ? $request['password'] : ''  ?>" type="password" placeholder="Password" required>
			<input id="confirm_password" data-bind="value: confirm,valueUpdate: 'afterkeydown'" name="confirm_password" value="<?=isset($request['confirm_password']) ? $request['confirm_password'] : ''  ?>" type="password" placeholder="Confirm Password" required>			
			<br>
			<p><span data-bind="visible: matched" >Your passwords do not match</span></p>
			
			<label class="radio inline">
  				<input type="radio" name="TC" id="TC" value="Accept">
  				<small>I accept these <br clear> <a href="terms">terms and conditions</a></small>
			</label>
			<button data-bind="twButton:matched()">Sign me up</button>
		</fieldset>
		</form>
	</section>
<script type="text/javascript">
	function SignupModel(){
		var self   = this;
		self.name  = ko.observable();
		self.email = ko.observable();
		self.password = ko.observable();
		self.confirm  = ko.observable();
		self.rgdhfhj  = ko.observable(true);
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
			console.log('Changing!!!' + current);
			$(element).prop('disabled',current);
		}
	};
	ko.applyBindings(new SignupModel());
</script>
	

