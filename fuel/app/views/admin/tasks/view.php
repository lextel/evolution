<h2>Viewing #<?php echo $task->id; ?></h2>

<p>
	<strong>Owner id:</strong>
	<?php echo $task->owner_id; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $task->user_id; ?></p>
<p>
	<strong>Action:</strong>
	<?php echo $task->action; ?></p>
<p>
	<strong>Type id:</strong>
	<?php echo $task->type_id; ?></p>
<p>
	<strong>Is read:</strong>
	<?php echo $task->is_read; ?></p>
<p>
	<strong>Obj id:</strong>
	<?php echo $task->obj_id; ?></p>

<?php echo Html::anchor('admin/tasks/edit/'.$task->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/tasks', 'Back'); ?>