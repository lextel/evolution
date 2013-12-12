<h2>编辑商品</h2>
<br>

<?php echo render('admin/items/_form'); ?>
<p>
	<?php echo Html::anchor('admin/items/view/'.$item->id, 'View'); ?> |
	<?php echo Html::anchor('admin/items', '返回'); ?></p>
