<?php
echo Asset::js(['admin/items/index.js']);
?>
<h2>商品列表</h2>
<br>
<?php if ($items): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>标题</th>
            <th>价格</th>
            <th>发布时间</th>
            <th>审核状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
          <tr>
            <td><?php echo '(第'.$item->phase->phase_id.'期)'.$item->title; ?></td>
            <td><?php echo '￥' . sprintf('%.2f', $item->price); ?></td>
            <td><?php echo date('Y-m-d H:i', $item->created_at); ?></td>
            <td><?php echo $item->status ? '已审核' : '未审核'; ?></td>
            <td>
            <!--<?php echo Html::anchor('admin/items/edit/'.$item->id, '编辑'); ?> |-->
            <?php echo Html::anchor('admin/items/check/'.$item->id, '详情'); ?> |
            <?php echo Html::anchor('admin/items/checkPass/'.$item->id, '通过'); ?> |
            <?php echo Html::anchor('admin/items/checkUnPass/'.$item->id, '不通过'); ?> |
            <?php echo Html::anchor('admin/items/delete/'.$item->id, '删除', array('onclick' => "return confirm('亲，确定删除么?')")); ?>

            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
  OPERATE_URL = '<?php echo Uri::base() . 'admin/items/operate'?>';
</script>
<?php else: ?>
<p>还没有商品.</p>
<?php endif; ?><p>
<?php echo Html::anchor('admin/items/create', '添加', array('class' => 'btn btn-success')); ?>
</p>
