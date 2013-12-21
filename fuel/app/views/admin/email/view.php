<h2>Viewing #<?php echo $email->id; ?></h2>

<p>
	<strong>Title:</strong>
	<?php echo $email->title; ?></p>
<p>
	<strong>Content:</strong>
	<?php echo $email->content; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $email->user_id; ?></p>
<p>
	<strong>Is bak:</strong>
	<?php echo $email->is_bak; ?></p>

<?php echo Html::anchor('admin/email/edit/'.$email->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/email', 'Back'); ?>