<h2>Viewing #<?php echo $cate->id; ?></h2>

<p>
	<strong>Parent id:</strong>
	<?php echo $cate->parent_id; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $cate->name; ?></p>

<?php echo Html::anchor('admin/cates/edit/'.$cate->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/cates', 'Back'); ?>