<?php 
var_dump($sports);
?>
<div class="row">
	<div class="span4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span4">
		<h2>Your Existing Sports</h2>
	</div>
	<div class="span4">
	</div>
	<div class="span4">
		<h2>Add a Sport</h2>
		<form action="" method="post">
			<input type="hidden" name="member_id" value="<?=$athlete->member_id ?>" />
			<fieldset>
				<select name="sport_id">
					<?php
						foreach($sports as $sport){
							echo("<option value='" . $sport['id'] . "'>".$sport['name']."</option>");
						} 
					?>
				</select>
			</fieldset>
		</form>
	</div>
</div>