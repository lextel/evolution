乐拍提醒： 您总共乐购获得商品 <?php echo $count;?> 件。
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>商品图片</th>
            <th>商品名称</th>
            <th>乐拍状态</th>
            <th>购买数量/乐拍码</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody class="table-striped">
        <?php
            if(empty($list)) {
                echo '<tr><td colspan="5" style="text-align:center">亲，您还没有中过奖，请再努力点哦！</td></tr>';
            }
        ?>
        <?php foreach($list as $win) { ?>
        <tr>
            <td>我是图片<?php echo $win->item_id; ?></td>
            <td><?php echo $win->phase_id.'<br />'.$win->item_id.'<br />'.$win->updated_at; ?></td>
            <td>已经揭晓啦</td>
            <td class="price"><?php echo $win->code; ?></td>
            <td><?php echo Html::anchor('w/'.$win->id, '查看详情'); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php echo Pagination::instance('ulottery')->render(); ?>
