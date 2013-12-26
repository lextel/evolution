<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>编号</th>
            <th>商品名称</th>
            <th>购买时间</th>
            <th>购买份数</th>
            <th>期数</th>
        </tr>
    </thead>
    <tbody class="table-striped">
        <?php
            if(empty($orders)) {
                echo '<tr><td colspan="5" style="text-align:center">亲，您还没有购买过商品哦！</td></tr>';
            }
        ?>
        <?php foreach($orders as $order) { ?>
        <tr>
            <td><?php echo $order->id; ?></td>
            <td><a href=""></a></td>
            <td><?php echo date('Y-m-d H:i:s', $order->created_at); ?></td>
            <td class="price"><?php echo $order->code_count; ?></td>
            <td><?php echo $order->phase_id; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
