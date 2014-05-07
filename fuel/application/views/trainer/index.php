<?php
	if (isset($id) && $id == $member->id){
		$isMember = True;
	} else {
		$isMember = False;
	}
?>
<div class="row">
	<div class="col-md-4 athlete-profile__img">
		<?php 
			if (isset($member) && isset($member->image)){
				echo("<img src='/$member->image'>");
			}
		?>

	<?php
	if (isset($isMember) && $isMember){
		 echo("<a href='/trainer/profile'>Edit your profile</a><br/>");
		 echo("<a href='#' class='js-emailFriend'>Email Invite To Friend</a>");
	}
	?>
	</div>
</div>