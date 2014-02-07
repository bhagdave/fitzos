<div class="row">
	<div class="col-md-4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-4">
		<h2><?=isset($event->name) ? $event->name : '' ; ?></h2>
		<p><?=isset($event->content) ? $event->content : ''; ?></p>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<h4><?=isset($event->location) ? $event->location : ''; ?><?=isset($event->date) ? ' on ' .$event->date : ''; ?><?=isset($event->time) ? ' @ ' . $event->time : ''; ?></h4>
	</div>
	<div class="col-md-4">
		<?php 
			if (isset($event->image)){
				echo("<img height=320px src='/".$event->image."' alt='".$event->name."' title='".$event->name."'>");
			}
		?>
	</div>
	<div class="col-md-4">
		<h4>Attending</h4>
	</div>
</div>