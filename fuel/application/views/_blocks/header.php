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
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/knockout/2.3.0/knockout-min.js"></script> 
<script src="http://<?=$_SERVER['SERVER_NAME'] ?>/assets/js/jquery.timepicker.min.js"></script>
<script src="http://<?=$_SERVER['SERVER_NAME'] ?>/assets/js/jquery.form.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet">

<!--<link href='http://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>-->
</head>
<html lang="en-US">
<body class='<?=is_home() ? 'homeBG' :'' ; ?>'>
		<header class="header">
			<a href="http://<?=$_SERVER['SERVER_NAME'] ?>">
				<img src="/assets/images/logo.png" alt="www.reach-your-peak.com" name="www.reach-your-peak.com" width="129" height="89" id="FitZos" class="logo"/>
			</a>
			<div class="row">
				<div class="col-md-6">
				<?php
					if (isset($this->session)){
						$mesg = $this->session->flashdata('message');
						if (isset($mesg) && !empty($mesg)){
							echo("<div class='header-mesg alert alert-danger'>".$mesg."</div>");
						}
					}
				?>
				</div>
				<div class="col-md-6">BETA BETA BETA</div>
			</div>
			</header>


