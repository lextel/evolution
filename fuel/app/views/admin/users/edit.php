<h2>修改用户权限</h2>
<br>

<?php echo render('admin/users/_form'); ?>
<p>
	<?php echo Html::anchor('admin/users/view/'.$user->id, '浏览'); ?> |
	<?php echo Html::anchor('admin/users', '返回用户管理列表'); ?></p>
