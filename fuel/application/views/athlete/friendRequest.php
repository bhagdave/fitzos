<div class="row">
	<div class="col-md-4">
		<?= isset($message) ? $message :'' ; ?>
	</div>
	<div class="col-md-6">
		<p>You have a friend request from <a href="/athlete/view/<?=$member->id ?>"><?=$member->first_name ?> <?=$member->last_name ?></a></p>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<p><a href="/athlete/acceptFriend/<?=$request ?>">Accept</a></p>
		<p><a href="/athlete/declineFriend/<?=$request ?>">Decline</a></p>
	</div>
</div>
