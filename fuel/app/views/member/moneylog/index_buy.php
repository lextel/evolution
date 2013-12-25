
<br>
<?php if ($list): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>乐拍商品</th>
            <th>购买数量</th>
            <th>购买时间</th>
            <th>消费金额</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($list as $item): ?>      <tr>

            <td><?php echo '('.$item->phase_id.')'.$item->item_id; ?></td>
            <td><?php echo $item->total.'人次'; ?></td>
            <td><?php echo Date::forge($item->created_at)->format("%Y-%m-%d %H:%M:%S"); ?></td>
            <td><?php echo $item->sum; ?></td>
            <td>
                
            </td>
        </tr>
<?php endforeach; ?>    </tbody>
</table>
<?php echo Pagination::instance('ulogpage')->render(); ?>
<?php else: ?>
<p>没有日志</p>

<?php endif; ?><p>
<?php echo Html::anchor('u/moneylog', '用户充值记录'); ?>|
<?php echo Html::anchor('u/moneylog/b/1', '用户消费记录'); ?>
</p>
