<h2>Editing Member</h2>
<br>

<?php echo render('v2admin/members/_form'); ?>
<p>
	<?php echo Html::anchor('v2admin/members/view/'.$member->id, 'View'); ?> |
	<?php echo Html::anchor('v2admin/members', 'Back'); ?></p>
