<h2>Viewing #<?php echo $notice->id; ?></h2>

<p>
	<strong>Title:</strong>
	<?php echo $notice->title; ?></p>
<p>
	<strong>Summary:</strong>
	<?php echo $notice->summary; ?></p>
<p>
	<strong>Desc:</strong>
	<?php echo $notice->desc; ?></p>

<?php echo Html::anchor('admin/notices/edit/'.$notice->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/notices', 'Back'); ?>