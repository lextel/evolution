<h2>Editing Email</h2>
<br>

<?php echo render('admin/email/_form'); ?>
<p>
	<?php echo Html::anchor('admin/email/view/'.$email->id, 'View'); ?> |
	<?php echo Html::anchor('admin/email', 'Back'); ?></p>
