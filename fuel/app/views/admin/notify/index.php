<h2>Listing Notifies</h2>
<br>
<?php if ($notifies): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Content</th>
			<th>User id</th>
			<th>Is top</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($notifies as $item): ?>		<tr>

			<td><?php echo $item->title; ?></td>
			<td><?php echo $item->content; ?></td>
			<td><?php echo $item->user_id; ?></td>
			<td><?php echo $item->is_top; ?></td>
			<td>
				<?php echo Html::anchor('admin/notify/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/notify/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/notify/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Notifies.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/notify/create', 'Add new Notify', array('class' => 'btn btn-success')); ?>

</p>
