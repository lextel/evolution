<h2>Viewing <span class='muted'>#<?php echo $notice->id; ?></span></h2>

<p>
	<strong>Title:</strong>
	<?php echo $notice->title; ?></p>
<p>
	<strong>Summary:</strong>
	<?php echo $notice->summary; ?></p>
<p>
	<strong>Desc:</strong>
	<?php echo $notice->desc; ?></p>
<p>
	<strong>User name:</strong>
	<?php echo $notice->user_name; ?></p>

<?php echo Html::anchor('notice/edit/'.$notice->id, 'Edit'); ?> |
<?php echo Html::anchor('notice', 'Back'); ?>