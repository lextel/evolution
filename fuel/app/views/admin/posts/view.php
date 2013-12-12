<h2>晒单审核</h2>

<p>
	<strong>晒单标题:</strong>
	<?php echo $post->title; ?></p>
<p>
	<strong>晒单内容:</strong>
	<textarea><?php echo $post->desc; ?></textarea></p>
<p>
	<strong>是否审核:</strong>
	<?php echo $post->status; ?></p>
<p>
	<strong>商品名:</strong>
	<?php echo $post->item_id; ?></p>
<p>
	<strong>发布人:</strong>
	<?php echo $post->user_id; ?></p>
<p>
	<strong>商品类型:</strong>
	<?php echo $post->type_id; ?></p>
<p>
	<strong>商品期数:</strong>
	<?php echo $post->phase_id; ?></p>

<?php echo Html::anchor('admin/posts/edit/'.$post->id, '预览'); ?> |
<?php echo Html::anchor('admin/posts', '返回晒单审核列表'); ?>
