<div class="row">
	<div class="col-md-8 col-md-offset2">
		<h2>Your existing qualifications</h2>
		<?php 
		foreach($quals as $qual){
			echo("<div class='qualification'>");
			echo("<p>$qual->name ");
			if (!empty($qual->date)){
				$date = new DateTime($qual->date);
				echo(" on ".$date->format('m/d/Y'));
			}
			echo(" Certificate Number:$qual->number</p>");
			echo("</div>");
		}
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h2>Add a new qualification</h2>
		<form class="form-horizontal" method="post">
			<fieldset id="inputs">
				<input type="hidden" name="trainer_id" value="<?=$trainer->id ?>">
				<div class="control-group">
					<label class="control-label">Certificate</label>
					<div class="controls">
						<div class="ui-widget">	
							<select class="form-control" name="certificate_id">
								<?php 
								foreach($certificates as $key => $value){
									echo("<option value='$key'>$value</option>");
								}
								?>
							</select>
						</div>
					</div>					
				</div>
				<div class="control-group">
					<label class="control-label">Certificate Number</label>
					<div class="controls">
						<input class="form-control" name="number"  type="text" placeholder="Number">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Date</label>
					<div class="controls">
						<input class="datepicker form-control" name="date"  data-date-format="mm/dd/yyyy" type="text" placeholder="Certificate date">
					</div>
				</div>
			</fieldset>	
		</form>
	</div>
</div>
