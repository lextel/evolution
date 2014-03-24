<h2>Viewing #<?php echo $member->id; ?></h2>


<?php echo Html::anchor('v2admin/members/edit/'.$member->id, 'Edit'); ?> |
<?php echo Html::anchor('v2admin/members', 'Back'); ?>
