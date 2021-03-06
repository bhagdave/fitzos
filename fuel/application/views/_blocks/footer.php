
<footer class="footer">
	<?php
		$uri = $_SERVER["REQUEST_URI"];
		$ci = &get_instance();
		$session = $ci->load->library("session");
		$userId  = $session->userdata('id');
		$type    = $session->userdata('type');
		if ($userId){
			if ($uri != "/$type/sports"){
				echo('<a href="/'.$type.'/sports" class="btn">Sports</a>');
			}
			if ($uri != "/$type/teams"){
				echo('<a href="/'.$type.'/teams" class="btn">Teams</a>');
			}
			if ($uri != "/$type/notifications"){
				echo('<a href="/'.$type.'/notifications" class="btn">Notifications</a>');
			}
			if ($type == "athlete"){
				if ($uri != '/find/search'){
					echo('<a href="/find/search" class="btn">Find a Friend</a>');
				}
			} elseif($type == "trainer"){
				if ($uri != '/trainer/certs'){
					echo('<a href="/trainer/certs" class="btn">Certificates</a>');
				}
			}
		}
	?>
	<a class="btn" href="http://reachyourpeak.spreadshirt.com/">Reach Your Peak Shop</a>
	<?php
		$ci = &get_instance(); 
		$session = $ci->load->library("session");
		$userId  = $session->userdata('id');
		$type    = $session->userdata('type');
		if (isset($userId)){
			$memberModel  = $ci->load->model("members_model");
			$member = $memberModel->getMember($userId);
			if (isset($member)){
				echo("<div class='welcome'><a href='/$type/index'>Welcome " . $member->first_name . ' ' . $member->last_name.'</a></div>');
				echo("<a href='/signin/logout'>Logout</a></div>'");
			} else {
	?>
	<a class="signin btn" href="/signin/login">Sign in</a>
	<?php 
		}
	} else {
	?>
	<a class="signin btn" href="/signin/login">Sign in</a>
	<?php 
	}
	?>
	<p>Copyright &copy; PROformance <?=date("Y") ?> </p>
</footer>
</div>
<?php echo js('main').js($js); ?>
</body>
</html>
