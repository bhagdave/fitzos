<div class="row">
	<div class="col-md-4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row">
	<h2>Add a new event for <?=$team->name ?></h2>
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
						<textarea cols="40" rows="2" name="content" placeholder="Details of your event"><?=isset($event->content) ? $event->content: '' ; ?></textarea>
					</div>
				</div>
				<?php 
					if (isset($sports) && count($sports) > 1){
						?>
						<div class="control-group">
							<label class="control-label">Sport</label>
							<div class="controls">	
								<select name="sport_id">
									<?php 
									foreach($sports as $sport){
										echo("<option value='$sport->id'>$sport->name</option>");
									}?>
								</select>
							</div>
						</div>
						<?php 
					} else {
					?>
						<input name="sport_id" value="<?=isset($team->sport_id) ? $team->sport_id : ''  ?>" type="hidden">
					<?php 
					}
				?>
				<div class="control-group">
					<label class="control-label">Location</label>
					<div class="controls">	
						<textarea cols="40" rows="2" name="location" placeholder="Location of your event"><?=isset($event->location) ? $event->location: '' ; ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Date</label>
					<div class="controls">
						<input id="js-eventDate" class="datepicker" name="date"  data-date-format="mm/dd/yyyy" value="<?=isset($event->date) ? $event->date : ''  ?>" type="text" placeholder="Event date">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Start Time</label>
					<div class="controls">
						<input id="js-eventTime" class="timepicker" name="time"  value="<?=isset($event->time) ? $event->time : ''  ?>" type="text" placeholder="Event start time">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Finish Time</label>
					<div class="controls">
						<input id="js-eventTime" class="timepicker" name="end_time"  value="<?=isset($event->end_time) ? $event->end_time : ''  ?>" type="text" placeholder="Finish time">
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
					<label class="control-label">Private to team or Public?</label>
					<div class="controls">	
						<label class="radio">Public<input id="yes" name="public" value="PUBLIC" type="radio" <?= isset($event->public) && $event->public == 'PUBLIC' ? 'checked' : '' ?>></label>					
						<label class="radio">Private<input id="no" name="public" value="PRIVATE" type="radio" <?= isset($event->public) && $event->public == 'PRIVATE' ? 'checked' : '' ?>></label>
					</div>
				</div>
				<input type="hidden" name="type" value="LIVE">
				<input type="hidden" name="sub_type" value="free">
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
			<input type="hidden" name="team_id" value="<?= $team->id ?>" />
		</form>
	</div>
</div>
