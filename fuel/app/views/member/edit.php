<h2>Editing <span class='muted'>Member</span></h2>
<br>

<?php echo render('member/_form'); ?>
<p>
	<?php echo Html::anchor('member/view/'.$member->id, 'View'); ?> |
	<?php echo Html::anchor('member', 'Back'); ?></p>
