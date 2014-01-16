<form class="form-inline" role="form" action="" method="get">
  <div class="form-group">
    <input type="text" class="form-control" name="member_id" value="<?php echo Input::get('member_id'); ?>" placeholder="用户名">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="email" value="<?php echo Input::get('email'); ?>" placeholder="开始时间">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="nickname" value="<?php echo Input::get('nickname'); ?>" placeholder="结束时间">
  </div>
  <button type="submit" class="btn btn-default">搜索</button>
  <a href="<?php echo Uri::create('admin/members'); ?>" class="btn btn-default">重置</a>
</form>

<?php if ($logs): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>用户ID</th>
            <th>用户邮箱</th>
            <th>充值时间</th>
            <th>充值渠道</th>
            <th>充值额度</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($logs as $item): ?>
        <tr>
            <td><?php echo $item->id; ?></td>
            <td><?php echo $item->member_id; ?></td>
            <td><?php echo $getuser($item->member_id); ?></td>  
            <td class="col-sm-1"><?php echo date('Y-m-d H:i:s', $item->created_at); ?></td>
            <td class="col-sm-1"><?php echo $item->sum; ?></td>
            <td class="col-sm-1"><?php echo $item->source; ?></td>
            <td><?php echo '详情'; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>暂无用户充值日志</p>
<?php endif; ?>
<?php echo Pagination::instance('alogspage')->render();?>
