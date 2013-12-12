<h2>Viewing #<?php echo $item->id; ?></h2>

<p>
	<strong>Title:</strong>
	<?php echo $item->title; ?></p>
<p>
	<strong>Desc:</strong>
	<?php echo $item->desc; ?></p>
<p>
	<strong>Price:</strong>
	<?php echo $item->price; ?></p>
<p>
	<strong>Cate id:</strong>
	<?php echo $item->cate_id; ?></p>
<p>
	<strong>Status:</strong>
	<?php echo $item->status; ?></p>

<?php echo Html::anchor('admin/items/edit/'.$item->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/items', 'Back'); ?>