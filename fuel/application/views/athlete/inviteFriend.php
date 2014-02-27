<div id="inviteFriendDialog" title="Send email Invite" style="display:none;">
	<form id="js-InviteFriend">
		<input type="text" name="email" placeholder="Email Address">
		<button class="btn btn-small btn-success" onclick="sendEmailInvite(<?=$member->id?>);">Send Invite</button>
	</form>
</div>