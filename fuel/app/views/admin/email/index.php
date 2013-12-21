<h2>Listing Emails</h2>
<br>
<?php if ($emails): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Content</th>
			<th>User id</th>
			<th>Is bak</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($emails as $item): ?>		<tr>

			<td><?php echo $item->title; ?></td>
			<td><?php echo $item->content; ?></td>
			<td><?php echo $item->user_id; ?></td>
			<td><?php echo $item->is_bak; ?></td>
			<td>
				<?php echo Html::anchor('admin/email/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/email/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/email/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Emails.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/email/create', 'Add new Email', array('class' => 'btn btn-success')); ?>

</p>
