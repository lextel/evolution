<h2>Editing Cate</h2>
<br>

<?php echo render('admin/cates/_form'); ?>
<p>
	<?php echo Html::anchor('admin/cates/view/'.$cate->id, 'View'); ?> |
	<?php echo Html::anchor('admin/cates', 'Back'); ?></p>
