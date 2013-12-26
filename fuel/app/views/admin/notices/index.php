<h2>Listing Notices</h2>
<br>
<?php if ($notices): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Summary</th>
			<th>Desc</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($notices as $item): ?>		<tr>

			<td><?php echo $item->title; ?></td>
			<td><?php echo $item->summary; ?></td>
			<td><?php echo $item->desc; ?></td>
			<td>
				<?php echo Html::anchor('admin/notices/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/notices/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/notices/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Notices.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/notices/create', 'Add new Notice', array('class' => 'btn btn-success')); ?>

</p>
