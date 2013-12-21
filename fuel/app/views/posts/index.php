<br>
<?php if ($posts): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Desc</th>
			<th>User id</th>
			<th>Phase id</th>
			<th>Topimage</th>
			<th>发布时间</th>
			<th>羡慕</th>
			<th>评论</th>
			<th>最新评论</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($posts as $item): ?>		<tr>

			<td><?php echo $item->title; ?></td>
			<td><?php echo $item->desc; ?></td>
			<td><?php echo $item->member_id; ?></td>
			<td><?php echo $item->phase_id.$item->item_id; ?></td>
			<td><?php echo $item->topimage; ?></td>
			<td><?php echo $item->created_at; ?></td>
			<td><?php echo $item->up; ?></td>
			<td><?php echo $item->comment_count; ?></td>
			<td><?php echo $item->comment_top; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('posts/view/'.$item->id, '<i class="icon-eye-open"></i> 点击查看', array('class' => 'btn btn-small')); ?></div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Posts.</p>

<?php endif; ?><p>


</p>
