<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ReachYourPeak</title>
<meta name="fitness socialized" content="www.reach-your-peak.com">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="http://<?=$_SERVER['SERVER_NAME'] ?>/assets/css/bootstrap-responsive.css" rel="stylesheet">
<link href="http://<?=$_SERVER['SERVER_NAME'] ?>/assets/css/bootstrap.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/knockout/2.3.0/knockout-min.js"></script> 
<script src="http://<?=$_SERVER['SERVER_NAME'] ?>/assets/js/jquery.form.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
<link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME'] ?>/assets/css/style.css">

<!--<link href='http://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>-->
</head>
<html lang="en-US">
<body>
		<header>
			<a href="http://<?=$_SERVER['SERVER_NAME'] ?>">
				<img src="http://<?=$_SERVER['SERVER_NAME'] ?>/assets/images/logo.png" alt="FitZos.com" name="Fitzos.com" width="178" height="99" id="FitZos" style="display:block;" class="logo"/>
			</a>
<?php
	$ci = &get_instance(); 
	$session = $ci->load->library("session");
	$userId  = $session->userdata('id');
	if (isset($userId)){
		$memberModel  = $ci->load->model("members_model");
		$member = $memberModel->getMember($userId);
		if (isset($member)){
			echo("<div class='welcome'><a href='http://" .$_SERVER['SERVER_NAME']."/athlete/index'>Welcome " . $member->first_name . ' ' . $member->last_name.'</a></div>');
		} else {
?>
		<div class="signin">
			<a href="http://<?=$_SERVER['SERVER_NAME'] ?>/signin/login">Sign in</a>
		</div>
	<?php 
		}
	} else {
	?>
		<div class="signin">
			<a href="http://<?=$_SERVER['SERVER_NAME'] ?>/signin/login">Sign in</a>
		</div>
	<?php 
	}
?>
		</header>

