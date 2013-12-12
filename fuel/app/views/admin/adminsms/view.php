<h2></h2>
<p>
	<strong>发布人:</strong>
	<?php echo $adminsm->user_id; ?></p>
<p>
	<strong>操作:</strong>
	<?php echo $adminsm->action; ?></p>

<p>
	<strong>类型:</strong>
	<?php echo Config::get('sms.type')[$adminsm->type]; ?></p>
<p>
	<strong>发布对象:</strong>
	<?php echo $adminsm->obj_id; ?></p>


<?php echo Html::anchor('admin/adminsms', '返回任务消息列表'); ?>
