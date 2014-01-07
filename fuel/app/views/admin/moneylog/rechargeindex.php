<?php if ($logs): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>管理员</th>
            <th>描述</th>
            <th>IP</th>
            <th>操作时间</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($logs as $item): ?>
        <tr>
            <td><?php echo $getUsername($item->user_id); ?></td>
            <td><?php echo $item->desc; ?></td>
            <td><?php echo $item->ip; ?></td>
            <td><?php echo date('Y-m-d H:i:s', $item->created_at); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>没有日志</p>
<?php endif; ?>
<?php echo Pagination::instance('mypagination')->render();?>
