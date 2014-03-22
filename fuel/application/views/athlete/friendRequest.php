<div class="row">
	<div class="col-md-4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
	<div class="col-md-6">
		<?php 
			if (isset($member)){
				?>
					<p>You have a friend request from <a href="/athlete/view/<?=$member->id ?>"><?=$member->first_name ?> <?=$member->last_name ?></a></p>
				<?php 
			}
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<?php 
			if (isset($request)){
				?>
				<p><a href="/athlete/acceptFriend/<?=$request->friend_id ?>">Accept</a></p>
				<p><a href="/athlete/declineFriend/<?=$request->friend_id ?>">Decline</a></p>
				<?php 
			}
		?>
	</div>
</div>
