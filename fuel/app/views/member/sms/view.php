<h2>Viewing <span class='muted'>#<?php echo $member_sm->id; ?></span></h2>

<p>
	<strong>Ower id:</strong>
	<?php echo $member_sm->ower_id; ?></p>
<p>
	<strong>Title:</strong>
	<?php echo $member_sm->title; ?></p>
<p>
	<strong>Type:</strong>
	<?php echo $member_sm->type; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $member_sm->user_id; ?></p>
<p>
	<strong>User name:</strong>
	<?php echo $member_sm->user_name; ?></p>

<?php echo Html::anchor('member/sms/edit/'.$member_sm->id, 'Edit'); ?> |
<?php echo Html::anchor('member/sms', 'Back'); ?>