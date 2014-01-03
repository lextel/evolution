<h2>Editing <span class='muted'>Member_sm</span></h2>
<br>

<?php echo render('member/sms/_form'); ?>
<p>
	<?php echo Html::anchor('member/sms/view/'.$member_sm->id, 'View'); ?> |
	<?php echo Html::anchor('member/sms', 'Back'); ?></p>
