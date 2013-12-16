<h2>任务列表</h2>
<br>
<?php if ($tasks): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>接收者</th>
			<th>发送者</th>
			<th>操作</th>
			<th>任务类型</th>
			<th>是否已读</th>
			<th>操作对象</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
    <?php foreach ($tasks as $item): ?>		<tr>

          <td><?php echo $item->owner_id; ?></td>
          <td><?php echo $item->user_id; ?></td>
          <td><?php echo $item->action; ?></td>
          <td><?php echo $item->type_id; ?></td>
          <td><?php echo $item->is_read; ?></td>
          <td><?php echo $item->obj_id; ?></td>
          <td>
            <?php echo Html::anchor('admin/tasks/view/'.$item->id, '预览'); ?>
          </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

<?php else: ?>
<p>亲，工作已做完。</p>
<?php endif; ?><p>
</p>
