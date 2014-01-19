<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>FitZos.com</title>
<meta name="fitness socialized" content="FitZos.com">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<html lang="en-US">
		<header>
			<a href="http://beta.fitzos.com">
				<img src="http://beta.fitzos.com/assets/images/logo.png" alt="FitZos.com" name="Fitzos.com" width="178" height="99" id="FitZos" style="display:block;" class="logo"/>
			</a>
		</header>
<body>
	<p>You have a request to join one of your teams on reach your peak.</p>
	<p> The member <?=$member->first_name ?> <?=$member->last_name ?> with the email address <?=$member->email ?> requested membership to the <?=$team->name ?>.</p>
	<p>Please click on this <a href="http://www.reach-your-peak.com/signin/activate/{$member->salt}"></a>link to activate your account....</p>
	<div id="footer">
		<p>Copyright &copy; PROformance 2013 </p>
	</div>
</div>
</body>
</html>