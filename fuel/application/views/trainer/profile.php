<div class="row">
	<div class="col-md-6">
		<form class="form-horizontal" action="/trainer/profile" method="post" enctype="multipart/form-data">
			<fieldset id="inputs">
				<input name="id"  type="hidden" value="<?=isset($trainer->id) ? $trainer->id : ''  ?>">
			<?php $this->load->view('_blocks/all-members');?>
				<div class="control-group">
					<label class="control-label">Nickname</label>
					<div class="controls">
						<input id="nickname" class="form-control" name="nickname"  type="text" placeholder="Nickname" value="<?=isset($trainer->nickname) ? $trainer->nickname : ''  ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Biography</label>
					<div class="controls">
						<textarea id="bio" class="form-control" name="bio"><?=isset($trainer->bio) ? $trainer->bio : ''  ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Profile image</label>
					<?php 
						if (isset($member->image)){
							echo("<img src='/$member->image'>");
						} 
					?>
					<div class="controls">	
						<input type="file" name="file" id="file" value="<?=isset($member->image) ? $member->image : ''  ?>">
					</div>
				</div>
				<?php 
				if (isset($specialties)){
					?>
					<hr>
					<h3>Specialties</h3>
					<?php 
					foreach($specialties as $key => $value){
						?>
						<div class="control-group">
							<div class="controls">	
								<label class="checkbox"><?=$value ?>
								<input name="specialty[<?=$key ?>]" value="Yes" type="checkbox" <?php 
								if (isset($trainerSpecialties[$key]) && $trainerSpecialties[$key] == $key){
									echo('checked');
								} ?>>					
							</div>
						</div>
						
						<?php 
					}
					?>
					<?php 
				}
				?>
				<button class="btn btn-success" >Submit</button>	
			</fieldset>
		</form>
	</div>
</div>