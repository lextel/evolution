<?php if($breadcrumb): ?>
<ol class="breadcrumb">
    <?php echo $breadcrumb; ?>
</ol>
<?php endif; ?>
<?php if ($notices): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>标题</th>
            <th>概要</th>
            <td>发布时间</th>
            <th>置顶</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($notices as $item): ?>
        <tr>
            <td><?php echo $item->title; ?></td>
            <td><?php echo $item->summary; ?></td>
            <td><?php echo date('Y-m-d H:i:s', $item->create_at); ?></td>
            <!--td>
                <?php echo Html::anchor('admin/notices/view/'.$item->id, '查看'); ?> |
                <?php echo Html::anchor('admin/notices/edit/'.$item->id, '编辑'); ?> |
                <?php echo Html::anchor('admin/notices/delete/'.$item->id, '删除', array('onclick' => "return confirm('Are you sure?')")); ?>

            </td-->
        </tr>
        <?php endforeach; ?>
        </tbody>
</table>

<?php else: ?>
<p style="text-align:center">没有任何公告.</p>

<?php endif; ?><p>
    <?php echo Html::anchor('admin/notices/create', '发布公告', array('class' => 'btn btn-success')); ?>

</p>
