<?php if ($logs): ?>
<div class="panel panel-default">
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
                <th width="10%">消费金额</th>
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
                <td class="col-sm-1"><?php echo \Helper\Coins::showIconCoins($item->sum, true); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>暂无用户消费日志</p>
    <?php endif; ?>
</div>
<?php echo Pagination::instance('alogspage')->render();?>
