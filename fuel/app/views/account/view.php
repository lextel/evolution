<h2>Viewing <span class='muted'>#<?php echo $account->id; ?></span></h2>

<p>
	<strong>Username:</strong>
	<?php echo $account->username; ?></p>
<p>
	<strong>Password:</strong>
	<?php echo $account->password; ?></p>
<p>
	<strong>Nickname:</strong>
	<?php echo $account->nickname; ?></p>
<p>
	<strong>Avatar:</strong>
	<?php echo $account->avatar; ?></p>
<p>
	<strong>Bio:</strong>
	<?php echo $account->bio; ?></p>
<p>
	<strong>Mobile:</strong>
	<?php echo $account->mobile; ?></p>
<p>
	<strong>Points:</strong>
	<?php echo $account->points; ?></p>
<p>
	<strong>Last login:</strong>
	<?php echo $account->last_login; ?></p>

<?php echo Html::anchor('account/edit/'.$account->id, 'Edit'); ?> |
<?php echo Html::anchor('account', 'Back'); ?>