<form class="form-inline" role="form" action="" method="get">
  <div class="form-group">
    <input type="text" class="form-control" name="member_id" value="<?php echo Input::get('member_id'); ?>" placeholder="会员ID">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="email" value="<?php echo Input::get('email'); ?>" placeholder="会员邮箱">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="nickname" value="<?php echo Input::get('nickname'); ?>" placeholder="会员昵称">
  </div>
  <button type="submit" class="btn btn-default">搜索</button>
  <a href="<?php echo Uri::create('admin/members'); ?>" class="btn btn-default">重置</a>
  <?php echo Html::anchor('admin/members/create', '添加会员', array('class' => 'btn btn-success col-md-offset-3')); ?>
</form>

<?php if ($members): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#ID</th>
            <th>昵称</th>
            <td>积分</td>
            <th>邮箱</th>
            <th>注册时间</th>
            <th>登陆时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($members as $item): ?>
        <tr>
            <td><?php echo $item->id; ?></td>
            <td><?php echo $item->nickname; ?></td>
            <td><?php echo $item->points; ?></td>
            <td><?php echo $item->email; ?></td>
            <td><?php echo !empty($item->created_at) ? date('Y-m-d H:i:s', $item->created_at) : ''; ?></td>
            <td><?php echo !empty($item->last_login) ? date('Y-m-d H:i:s', $item->last_login) : ''; ?></td>
            <td>
                <?php echo Html::anchor('admin/members/view/'.$item->id, '查看'); ?> |
                <?php echo Html::anchor('admin/members/edit/'.$item->id, '编辑'); ?> |
                <?php echo Html::anchor('admin/members/delete/'.$item->id, '删除', array('onclick' => "return confirm('Are you sure?')")); ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
</table>
<?php else: ?>
<p>没有会员</p>
<?php endif; ?>
<?php echo Pagination::instance('mypagination')->render();?>
