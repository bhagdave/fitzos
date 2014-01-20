	<div class="splash col-lg-6 col-md-8 col-sm-12 col-xs-12">
		<form action="/signin/login" method="post">
		<h5>Log In</h5>
		<fieldset class="loginform" id="inputs">
			<input name="username" class="form-control" id="username" data-bind="value:username" type="text" placeholder="Username" autofocus required>   
			<input name="password" class="form-control" id="password" data-bind="value:password" type="password" placeholder="Password" required>
		</fieldset>
		<div class="btn-group">
			<button data-bind="enable: username && password" class="btn-small btn-primary" >Log in</button>
			<a href="/signin/forgotPassword" class="">Forgot your password?</a>
		</div>
		</form>
	</div>
<script type="text/javascript">
	function loginModel(){
		var self = this;
		self.username = ko.observable();
		self.password = ko.observable();
	};
	ko.applyBindings(new loginModel());
</script>
