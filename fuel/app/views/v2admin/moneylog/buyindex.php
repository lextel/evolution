

<?php if ($logs): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>用户ID</th>
            <th>用户邮箱</th>
            <th>商品ID</th>
            <th>商品名称</th>
            <th>商品状态</th>
            <th>消费时间</th>
            <th>购买数量</th>
            <th>消费金额</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($logs as $item): ?>
        <tr>
            <td><?php echo $item->id; ?></td>
            <td><?php echo $item->member_id; ?></td>
            <td><?php echo $getuser($item->member_id); ?></td>
            <td><?php echo $item->phase_id; ?></td>
            <td class="col-sm-3"><?php echo $title($item); ?></td>
            <td><?php echo $getStatus($item); ?></td>            
            <td class="col-sm-1"><?php echo date('Y-m-d H:i:s', $item->created_at); ?></td>
            <td class="col-sm-1"><?php echo $item->total; ?></td>
            <td class="col-sm-1"><?php echo $item->sum; ?></td>
            <td><?php echo '详情'; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>暂无用户消费日志</p>
<?php endif; ?>
<?php echo Pagination::instance('alogspage')->render();?>
