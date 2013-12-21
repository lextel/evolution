<h2>Viewing #<?php echo $notify->id; ?></h2>

<p>
	<strong>Title:</strong>
	<?php echo $notify->title; ?></p>
<p>
	<strong>Content:</strong>
	<?php echo $notify->content; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $notify->user_id; ?></p>
<p>
	<strong>Is top:</strong>
	<?php echo $notify->is_top; ?></p>

<?php echo Html::anchor('admin/notify/edit/'.$notify->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/notify', 'Back'); ?>