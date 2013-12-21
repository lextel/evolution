<h2>Viewing <span class='muted'>#<?php echo $comment->id; ?></span></h2>

<p>
	<strong>User id:</strong>
	<?php echo $comment->user_id; ?></p>
<p>
	<strong>Text:</strong>
	<?php echo $comment->text; ?></p>
<p>
	<strong>Status:</strong>
	<?php echo $comment->status; ?></p>
<p>
	<strong>Pid:</strong>
	<?php echo $comment->pid; ?></p>
<p>
	<strong>Is deleted:</strong>
	<?php echo $comment->is_deleted; ?></p>

<?php echo Html::anchor('comment/edit/'.$comment->id, 'Edit'); ?> |
<?php echo Html::anchor('comment', 'Back'); ?>