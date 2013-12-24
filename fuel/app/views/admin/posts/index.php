<h2>晒单审核列表</h2>
<br>
<?php if ($posts): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>标题</th>
            <th>内容</th>
            <th>审核状态</th>
            <th>商品名</th>
            <th>发布人</th>
            <th>商品分类</th>
            <th>期数</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($posts as $item): ?>     <tr>

            <td><?php echo $item->title; ?></td>
            <td><?php echo $item->desc; ?></td>
            <td><?php echo $item->status; ?></td>
            <td><?php echo $item->item_id; ?></td>
            <td><?php echo $item->member_id; ?></td>
            <td><?php echo $item->type_id; ?></td>
            <td>第<?php echo $item->phase_id; ?>期</td>
            <td>
                <?php echo Html::anchor('admin/posts/view/'.$item->id, '审核'); ?> |
                <?php echo Html::anchor('admin/posts/delete/'.$item->id, '删除', array('onclick' => "return confirm('Are you sure?')")); ?>

            </td>
        </tr>
<?php endforeach; ?>    </tbody>
</table>

<?php else: ?>
<p>No Posts.</p>

<?php endif; ?><p>
    <?php echo Html::anchor('admin/posts/create', 'Add new Post', array('class' => 'btn btn-success')); ?>

</p>
