<h1>Hooray it worked...</h1>
<?php 
	if (isset($type)){
		if ($type == 'athlete'){
			?>
				<p>
				You can now go and play on Reach Your peak.  Might be a good idea to start by filling <a href="/athlete/profile">in your profile</a>.
				</p>
			<?php 
		} elseif ($type == 'trainer'){
			?>
				<p>
				You can now go and play on Reach Your peak.  Visit your <a href="/trainer/profile">profile page and fill in some details</a>.
				</p>
			<?php 
		}
	}
?>
