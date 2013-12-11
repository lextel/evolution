<h2>Editing Project_entry</h2>
<br>

<?php echo render('admin/project/entry/_form'); ?>
<p>
	<?php echo Html::anchor('admin/project/entry/view/'.$project_entry->id, 'View'); ?> |
	<?php echo Html::anchor('admin/project/entry', 'Back'); ?></p>
