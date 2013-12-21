<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>晒单图片</th>
            <th>晒单标题</th>
            <th>晒单内容</th>
            <th>晒单状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody class="table-striped">
        <?php
            if(empty($list)) {
                echo '<tr><td colspan="5" style="text-align:center">亲，您还没有晒单哦！</td></tr>';
            }
        ?>
        <?php foreach($list as $post) { ?>
        <tr>
            <td><?php echo $post->topimage; ?></td>
            <td><?php echo $post->title; ?></td>
            <td><?php echo $post->desc; ?></td>
            <td><?php echo $post->status; ?></td>
            <td><?php echo Html::anchor('u/posts/view/'.$post->id, '查看详情'); ?> |
                <?php echo Html::anchor('u/posts/edit/'.$post->id, '编辑'); ?> |
                <?php echo Html::anchor('u/posts/delete/'.$post->id, '删除', array('onclick' => "return confirm('你确定需要删除该晒单吗?')") ); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php echo Html::anchor('member/posts/getadd','添加晒单');?>
