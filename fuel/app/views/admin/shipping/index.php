<div class="panel panel-default">
<?php if ($shipping): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#ID</th>
            <th>分类</th>
            <th>品牌</th>
            <th>最后更新时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($shipping as $item): ?>
        <tr>
            <td><?php echo $item->id; ?></td>
            <td><?php echo $cates[$item->parent_id]; ?></td>
            <td class="editItem"><?php echo $item->name; ?></td>
            <td><?php echo date('Y-m-d', $item->updated_at); ?></td>
            <td>
                <div class="editing">
                    <?php echo Html::anchor('javascript:void(0);', '保存', ['action' => 'save', 'data-id'=>$item->id]); ?> |
                    <?php echo Html::anchor('javascript:void(0);', '取消', ['action' => 'cancel']); ?>
                </div>
                <div class="edit">
                    <?php echo Html::anchor('javascript:void(0);', '编辑', ['action' => 'edit', 'data-id'=>$item->id]); ?> |
                    <?php echo Html::anchor('admin/cates/delete/'.$item->id, '删除', ['onclick' => "return confirm('亲，你确定要删除吗?')"]); ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p style="text-align:center;padding: 40px">还没有需要发货的商品。</p>
<?php endif; ?>
</div>

