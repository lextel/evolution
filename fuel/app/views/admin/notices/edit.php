<h2>Editing Notice</h2>
<br>

<?php echo render('admin/notices/_form'); ?>
<p>
	<?php echo Html::anchor('admin/notices/view/'.$notice->id, 'View'); ?> |
	<?php echo Html::anchor('admin/notices', 'Back'); ?></p>
