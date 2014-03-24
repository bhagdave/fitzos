<?php
	$uri = $_SERVER["REQUEST_URI"];
	$ci = &get_instance();
	$session = $ci->load->library("session");
	$userId  = $session->userdata('id');
	if ($userId){
		if ($uri != '/athlete/sports'){
		?>
			<div class="row">
				<div class="col-md-2 col-md-offset-5">
					<a href="/athlete/sports" class="btn btn-success btn-block">Sports</a>
				</div>
			</div>
		<?php 
		}
		if ($uri != '/athlete/teams'){
		?>
			<div class="row">
				<div class="col-md-2 col-md-offset-5">
					<a href="/athlete/teams" class="btn btn-success btn-block">Teams</a>
				</div>
			</div>
		<?php 
		}
		if ($uri != '/athlete/notifications'){
		?>
			<div class="row">
				<div class="col-md-2 col-md-offset-5">
					<a href="/athlete/notifications" class="btn btn-success btn-block">Notifications</a>
				</div>
			</div>
		<?php 
		}
		if ($uri != '/find/search'){
		?>
			<div class="row">
				<div class="col-md-2 col-md-offset-5">
					<a href="/find/search" class="btn btn-success btn-block">Find a Friend</a>
				</div>
			</div>
		<?php 
		}
	}
?>
<footer class="footer">
	<a class="btn" href="http://reachyourpeak.spreadshirt.com/">Reach Your Peak Shop</a>
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
	<a class="signin btn" href="http://<?=$_SERVER['SERVER_NAME'] ?>/signin/login">Sign in</a>
	<?php 
		}
	} else {
	?>
	<a class="signin btn" href="http://<?=$_SERVER['SERVER_NAME'] ?>/signin/login">Sign in</a>
	<?php 
	}
	?>
	<p>Copyright &copy; PROformance <?=date("Y") ?> </p>
</footer>
</div>
<?php echo js('main').js($js); ?>
</body>
</html>
