<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ReachYourPeak</title>
<meta name="fitness socialized" content="www.reach-your-peak.com">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME'] ?>/assets/css/style.css">
<link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME'] ?>/assets/css/jquery.timepicker.css">
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/knockout/2.3.0/knockout-min.js"></script> 
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="http://<?=$_SERVER['SERVER_NAME'] ?>/assets/js/production.min.js"></script>

<!--<link href='http://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>-->
</head>
<html lang="en-US">
<body>
		<header class="header">
			<a href="http://<?=$_SERVER['SERVER_NAME'] ?>">
				<img src="http://<?=$_SERVER['SERVER_NAME'] ?>/assets/images/logo.png" alt="www.reach-your-peak.com" name="www.reach-your-peak.com" width="89" height="49" id="FitZos" class="logo"/>
			</a>
<<<<<<< HEAD
		</header>

=======
<?php
	$ci = &get_instance(); 
	$session = $ci->load->library("session");
	$userId  = $session->userdata('id');
	if (isset($userId)){
		$memberModel  = $ci->load->model("members_model");
		$member = $memberModel->getMember($userId);
		if (isset($member)){
			echo("<div class='welcome'><a href='http://" .$_SERVER['SERVER_NAME']."/athlete/index'>Welcome " . $member->first_name . ' ' . $member->last_name.'</a></div>');
			echo("<a href='http://" .$_SERVER['SERVER_NAME']."/signin/logout'>Logout</a></div>'");
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
<div class="row">
	<div class="col-md-4">
		<?php
		if (isset($this->session)){
			echo($this->session->flashdata('message'));
		} 
		?>
	</div>
</div>
>>>>>>> FETCH_HEAD
