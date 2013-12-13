<h2>任务通知列表</h2>
<br>
<?php if ($adminsms): ?>
<table class="table table-striped">
	<thead>
		<tr>
		    <th>发送者</th>
			<th>操作</th>
			<th>类型</th>
			<th>操作对象</th>
			<th>操作时间</th>				
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($adminsms as $item): ?>		<tr>
            <td><?php echo $getUsername($item->user_id); ?></td>
			<td><?php echo $item->action; ?></td>
			<td><?php echo Config::get('sms.type')[$item->type]; ?></td>
			<td><?php echo $item->obj_id; ?></td>
            <td><?php echo $getDatetime($item->created_at); ?></td>		
			<td>
				<?php echo Html::anchor('admin/adminsms/view/'.$item->id, $item->isread ? '已查看' : '未查看'); ?>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>该任务通知列表暂时还没任何通知<p>

<?php endif; ?><p>


</p>
