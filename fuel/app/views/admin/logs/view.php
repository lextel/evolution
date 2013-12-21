<h2>Viewing #<?php echo $log->id; ?></h2>

<p>
	<strong>User id:</strong>
	<?php echo $log->user_id; ?></p>
<p>
	<strong>Desc:</strong>
	<?php echo $log->desc; ?></p>
<p>
	<strong>Ip:</strong>
	<?php echo $log->ip; ?></p>

<?php echo Html::anchor('admin/logs/edit/'.$log->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/logs', 'Back'); ?>