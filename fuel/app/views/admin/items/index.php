<h2>商品列表</h2>
<br>
<?php if ($items): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>标题</th>
			<th>价格</th>
			<th>分类</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($items as $item): ?>		<tr>

			<td><?php echo $item->title; ?></td>
			<td><?php echo $item->price; ?></td>
			<td><?php echo $cates[$item->cate_id]; ?></td>
			<td><?php echo $item->status ? '已上架' : '未上架'; ?></td>
			<td>
				<?php echo empty($item->status) ? Html::anchor('admin/items/operate/?operate=up'.$item->id, '上架') : Html::anchor('admin/items/operate/?operate=down'.$item->id, '下架'); ?> |
				<?php echo Html::anchor('admin/items/edit/'.$item->id, '编辑'); ?> |
				<?php echo Html::anchor('admin/items/delete/'.$item->id, '删除', array('onclick' => "return confirm('亲，确定删除么?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>还没有商品.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/items/create', '添加', array('class' => 'btn btn-success')); ?>

</p>
