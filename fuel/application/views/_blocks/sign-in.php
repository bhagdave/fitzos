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
			<input id="name" name="name" value="<?=isset($request['name']) ? $request['name'] : ''  ?>" type="text" placeholder="Name" autofocus required>   
			<input id="email" name="email" value="<?=isset($request['email']) ? $request['email'] : ''  ?>" type="text" placeholder="Email" required>
			<input id="password" name="password" value="<?=isset($request['password']) ? $request['password'] : ''  ?>" type="password" placeholder="Password" required>
			<input id="confirm_password" name="confirm_password" value="<?=isset($request['confirm_password']) ? $request['confirm_password'] : ''  ?>" type="password" placeholder="Confirm Password" required>			
			<br>
			<label class="radio inline">
  				<input type="radio" name="TC" id="TC" value="Accept">
  				<small>I accept these <br clear> <a href="terms">terms and conditions</a></small>
			</label>
			<button class="btn btn-success btn-mini">Sign me up</button>
		</fieldset>
		</form>
	</section>
