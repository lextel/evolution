<h2>Viewing <span class='muted'>#<?php echo $member->id; ?></span></h2>

<p>
	<strong>Username:</strong>
	<?php echo $member->username; ?></p>
<p>
	<strong>Password:</strong>
	<?php echo $member->password; ?></p>
<p>
	<strong>Nickname:</strong>
	<?php echo $member->nickname; ?></p>
<p>
	<strong>Avatar:</strong>
	<?php echo $member->avatar; ?></p>
<p>
	<strong>Bio:</strong>
	<?php echo $member->bio; ?></p>
<p>
	<strong>Mobile:</strong>
	<?php echo $member->mobile; ?></p>
<p>
	<strong>Points:</strong>
	<?php echo $member->points; ?></p>
<p>
	<strong>Last login:</strong>
	<?php echo $member->last_login; ?></p>
<p>
	<strong>Email:</strong>
	<?php echo $member->email; ?></p>
<p>
	<strong>Login hash:</strong>
	<?php echo $member->login_hash; ?></p>
<p>
	<strong>Profile fields:</strong>
	<?php echo $member->profile_fields; ?></p>

<?php echo Html::anchor('member/edit/'.$member->id, 'Edit'); ?> |
<?php echo Html::anchor('member', 'Back'); ?>