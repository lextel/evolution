<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>详细地址</th>
            <th>邮编</th>
            <th>收货人</th>
            <th>电话</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody class="table-striped">
        <?php
            if(empty($list)) {
                echo '<tr><td colspan="5" style="text-align:center">亲，您还没有添加收货地址哦！</td></tr>';
            }
        ?>
        <?php foreach($list as $post) { ?>
        <tr>
            <td><?php echo $post->address; ?></td>
            <td><?php echo $post->postcode; ?></td>
            <td><?php echo $post->name; ?></td>
            <td><?php echo $post->mobile; ?></td>
            <td><?php echo Html::anchor('u/address/'.$post->id, '查看详情'); ?> |
                <?php echo Html::anchor('u/address/edit/'.$post->id, '编辑'); ?> |
                <?php echo Html::anchor('u/address/delete/'.$post->id, '删除', array('onclick' => "return confirm('你确定需要删除该晒单吗?')") ); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<br />
<?php echo Html::anchor('u/address/add','添加收货地址');?>
