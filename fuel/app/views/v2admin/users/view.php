<h2>查看用户信息</h2>

<p>
	<strong>用户名:</strong>
	<?php echo $user->username; ?></p>
<p>
	<strong>用户密码:</strong>
	<?php echo $user->password; ?></p>
<p>
	<strong>Email:</strong>
	<?php echo $user->email; ?></p>
<p>
	<strong>用户组:</strong>
	<?php echo Auth::group('Simplegroup')->get_name($user->group); ?></p>

<?php echo Html::anchor('v2admin/users/edit/'.$user->id, '修改权限'); ?> |
<?php echo Html::anchor('v2admin/users', '返回用户管理列表'); ?>
