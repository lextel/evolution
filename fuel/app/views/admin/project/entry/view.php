<h2>Viewing #<?php echo $project_entry->id; ?></h2>

<p>
	<strong>Title:</strong>
	<?php echo $project_entry->title; ?></p>
<p>
	<strong>Abstract:</strong>
	<?php echo $project_entry->abstract; ?></p>
<p>
	<strong>Full text:</strong>
	<?php echo $project_entry->full_text; ?></p>
<p>
	<strong>Project id:</strong>
	<?php echo $project_entry->project_id; ?></p>
<p>
	<strong>Is draft:</strong>
	<?php echo $project_entry->is_draft; ?></p>
<p>
	<strong>Order:</strong>
	<?php echo $project_entry->order; ?></p>

<?php echo Html::anchor('admin/project/entry/edit/'.$project_entry->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/project/entry', 'Back'); ?>