<h2>Listing Project_entries</h2>
<br>
<?php if ($project_entries): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Abstract</th>
			<th>Full text</th>
			<th>Project id</th>
			<th>Is draft</th>
			<th>Order</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($project_entries as $item): ?>		<tr>

			<td><?php echo $item->title; ?></td>
			<td><?php echo $item->abstract; ?></td>
			<td><?php echo $item->full_text; ?></td>
			<td><?php echo $item->project_id; ?></td>
			<td><?php echo $item->is_draft; ?></td>
			<td><?php echo $item->order; ?></td>
			<td>
				<?php echo Html::anchor('admin/project/entry/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/project/entry/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/project/entry/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Project_entries.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/project/entry/create', 'Add new Project entry', array('class' => 'btn btn-success')); ?>

</p>
