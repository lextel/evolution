<h2>Editing Notify</h2>
<br>

<?php echo render('admin/notify/_form'); ?>
<p>
	<?php echo Html::anchor('admin/notify/view/'.$notify->id, 'View'); ?> |
	<?php echo Html::anchor('admin/notify', 'Back'); ?></p>
