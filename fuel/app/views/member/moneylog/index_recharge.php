
<br>
<?php if ($list): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>充值时间</th>
            <th>资金渠道</th>
            <th>金额</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($list as $item): ?>      <tr>

            <td><?php echo Date::forge($item->created_at)->format("%Y-%m-%d %H:%M:%S"); ?></td>
            <td><?php echo $item->type; ?></td>
            <td>￥<?php echo round($item->sum, 2); ?></td>
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
