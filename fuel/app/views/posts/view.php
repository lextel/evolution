<h2>Viewing <span class='muted'>#<?php echo $post->id; ?></span></h2>

<p>
	<strong>Title:</strong>
	<?php echo $post->title; ?></p>
<p>
	<strong>Desc:</strong>
	<?php echo $post->desc; ?></p>
<p>
	<strong>Status:</strong>
	<?php echo $post->status; ?></p>
<p>
	<strong>Item id:</strong>
	<?php echo $post->item_id; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $post->user_id; ?></p>
<p>
	<strong>Type id:</strong>
	<?php echo $post->type_id; ?></p>
<p>
	<strong>Phase id:</strong>
	<?php echo $post->phase_id; ?></p>
<p>
	<strong>Topimage:</strong>
	<?php echo $post->topimage; ?></p>
<p>
	<strong>Images:</strong>
	<?php echo $post->images; ?></p>

<?php echo Html::anchor('posts/edit/'.$post->id, 'Edit'); ?> |
<?php echo Html::anchor('posts', 'Back'); ?>