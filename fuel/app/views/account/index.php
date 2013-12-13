<h2>Listing <span class='muted'>Accounts</span></h2>
<br>
<?php if ($accounts): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Username</th>
			<th>Password</th>
			<th>Nickname</th>
			<th>Avatar</th>
			<th>Bio</th>
			<th>Mobile</th>
			<th>Points</th>
			<th>Last login</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($accounts as $item): ?>		<tr>

			<td><?php echo $item->username; ?></td>
			<td><?php echo $item->password; ?></td>
			<td><?php echo $item->nickname; ?></td>
			<td><?php echo $item->avatar; ?></td>
			<td><?php echo $item->bio; ?></td>
			<td><?php echo $item->mobile; ?></td>
			<td><?php echo $item->points; ?></td>
			<td><?php echo $item->last_login; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('account/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('account/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('account/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Accounts.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('account/create', 'Add new Account', array('class' => 'btn btn-success')); ?>

</p>
