<div class="row">
	<div class="col-md-4">
		<h2><?=isset($member) ? $member->first_name . ' ' . $member->last_name : '' ; ?></h2>
	</div>
	<div class="col-md-4">
		<?php 
			if (isset($member) && isset($member->image)){
				echo("<img src='/$member->image'>");
			}
		?>
	</div>
	<div class="col-md-4">
		<h2>Their Sports</h2>
	<?php
		if (isset($sports)){
			foreach($sports as $sport){
				echo("<h4>$sport->sport</h4>");
				if (isset($sport->from_date)){
					echo("From $sport->from_date");
				}
				if (isset($sport->to_date)){
					echo(" Until $sport->to_date");
				}
				echo("<br>");
				$existingSports[] = $sport->sport;
			}
		}
	?>
	</div>
</div>
		