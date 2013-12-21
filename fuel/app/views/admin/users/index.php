<h2>用户管理列表</h2>
<br>
<?php if ($users): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>用户名</th>
            <th>用户密码</th>
            <th>用户邮箱</th>
            <th>用户组</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($users as $item): ?>     <tr>

            <td><?php echo $item->username; ?></td>
            <td><?php echo $item->password; ?></td>
            <td><?php echo $item->email; ?></td>
            <td><?php echo Auth::group('Simplegroup')->get_name($item->group); ?></td>
            <td>
                <?php echo Html::anchor('admin/users/view/'.$item->id, '浏览'); ?> |
                <?php echo Html::anchor('admin/users/edit/'.$item->id, '修改权限'); ?> |
                <?php echo Html::anchor('admin/users/delete/'.$item->id, '删除用户', array('onclick' => "return confirm('确定要删除?')")); ?>

            </td>
        </tr>
<?php endforeach; ?>    </tbody>
</table>

<?php else: ?>
<p>No Users.</p>

<?php endif; ?><p>
    <?php echo Html::anchor('admin/users/create', '添加用户', array('class' => 'btn btn-success')); ?>

</p>
