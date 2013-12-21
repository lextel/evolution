<h2>Editing <span class='muted'>Comment</span></h2>
<br>

<?php echo render('comment/_form'); ?>
<p>
	<?php echo Html::anchor('comment/view/'.$comment->id, 'View'); ?> |
	<?php echo Html::anchor('comment', 'Back'); ?></p>
