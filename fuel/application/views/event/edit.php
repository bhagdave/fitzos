<div class="row">
	<div class="col-md-4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row">
	<h2>Edit event <?=$event->name ?></h2>
</div>
<div class="row">
	<div class="col-md-4">
		<form class="form-horizontal" method="post" enctype="multipart/form-data">
			<fieldset id="inputs">
				<div class="control-group">
					<label class="control-label">Name</label>
					<div class="controls">
						<input id="name" name="name" value="<?=isset($event->name) ? $event->name : ''  ?>" type="text" placeholder="Name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Details</label>
					<div class="controls">	
						<textarea cols="40" rows="2" name="content" placeholder="Details of your event"><?isset($event->content) ? $event->content: '' ; ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Location</label>
					<div class="controls">	
						<textarea cols="40" rows="2" name="location" placeholder="Location of your event"><?isset($event->location) ? $event->location: '' ; ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Date</label>
					<div class="controls">
						<input id="js-eventDate" class="datepicker" name="date"  data-date-format="mm/dd/yyyy" value="<?=isset($event->date) ? $event->date : ''  ?>" type="text" placeholder="Event date">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Time</label>
					<div class="controls">
						<input id="js-eventTime" class="timepicker" name="time"  value="<?=isset($event->time) ? $event->time : ''  ?>" type="text" placeholder="Event time">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Published?</label>
					<div class="controls">	
						<label class="radio">Yes<input id="yes" name="published" value="yes" type="radio" <?= isset($event->published) && $event->published == 'Yes' ? 'checked' : '' ?>></label>					
						<label class="radio">No<input id="no" name="published" value="no" type="radio" <?= isset($event->published) && $event->published == 'No' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Type?</label>
					<div class="controls">	
						<label class="radio">Live<input id="yes" name="type" value="LIVE" type="radio" <?= isset($event->type) && $event->type == 'LIVE' ? 'checked' : '' ?>></label>					
						<label class="radio">Virtual<input id="no" name="type" value="VIRTUAL" type="radio" <?= isset($event->type) && $event->type == 'VIRTUAL' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Fee?</label>
					<div class="controls">	
						<label class="radio">Free<input id="yes" name="sub_type" value="FREE" type="radio" <?= isset($event->type) && $event->type == 'FREE' ? 'checked' : '' ?>></label>					
						<label class="radio">Paid<input id="no" name="sub_type" value="PAID" type="radio" <?= isset($event->type) && $event->type == 'PAID' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Event image</label>
					<?php 
						if (isset($event->image)){
							echo("<img src='/$event->image'>");
						} 
					?>
					<div class="controls">	
						<input type="file" name="file" id="file" value="<?=isset($event->image) ? $event->image : ''  ?>">
					</div>
				</div>
				<button class="btn btn-success">Submit</button>				
			</fieldset>
			<input type="hidden" name="team_id" value="<?= $event->team_id ?>" />
			<input type="hidden" name="id" value="<?= $event->id ?>" />
		</form>
	</div>
</div>
