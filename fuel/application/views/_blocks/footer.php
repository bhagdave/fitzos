<div class="row">
	<div class="col-md-12 col-xs-12 col-lg-12">
		<hr>
	</div>
</div>
<?php 
	$uri = $_SERVER["REQUEST_URI"];
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
	if ($uri != '/athlete/find'){
	?>
		<div class="row">
			<div class="col-md-2 col-md-offset-5">
				<a href="/find/search" class="btn btn-success btn-block">Find a Friend</a>
			</div>
		</div>
	<?php 
	}
?>
<div class="col-md-12">
	<div class="row">
		<div id="footer">
			<p>Copyright &copy; PROformance <?=date("Y") ?> </p>
		</div>
	</div>
</div>
<a href="http://reachyourpeak.spreadshirt.com/">Reach Your Peak Shop</a>
</div>
<?php echo js('main').js($js); ?>
<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-52d44f4a5cedc019"></script>
<script type="text/javascript">
  addthis.layers({
    'theme' : 'transparent',
    'share' : {
      'position' : 'right',
      'numPreferredServices' : 5
    }, 
    'follow' : {
      'services' : [
        {'service': 'facebook', 'id': 'meetotherathletes'},
        {'service': 'twitter', 'id': 'whatsyourpeak'},
        {'service': 'google_follow', 'id': '111706559051974640132'}
      ]
    },  
    'whatsnext' : {},  
    'recommended' : {} 
  });
</script>
<!-- AddThis Smart Layers END -->
</body>
</html>
