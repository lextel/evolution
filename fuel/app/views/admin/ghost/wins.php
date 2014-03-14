<div class="panel panel-default" style="padding: 10px 0">
    <form class="navbar-form navbar-left" role="search" action="" method="get">
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">ID</span>
              <input type="text" class="form-control" name="member_id" value="<?php echo !empty(Input::get('member_id')) ? Input::get('member_id') : ''; ?>" placeholder="会员ID">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">昵称</span>
              <input type="text" class="form-control" name="nickname" value="<?php echo !empty(Input::get('nickname')) ? Input::get('nickname') : ''; ?>" placeholder="会员昵称">
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">搜索</button>
        <a href="<?php echo Uri::create('admin/members'); ?>" class="btn btn-default">重置</a>
        <?php echo Html::anchor('admin/members/create', '添加会员', array('class' => 'btn btn-success pull-right')); ?>
    </form>
    <div class="clearfix"></div>
</div>
<div class="panel panel-default">
<?php if ($members): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#ID</th>
            <th class="text-center">昵称</th>
            <td class="text-center">积分</td>
            <th class="text-center">邮箱</th>
            <th class="text-center">注册时间</th>
            <th class="text-center">登陆时间</th>
            <th class="text-center">状态</th>
            <th class="text-center">操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($members as $item): ?>
        <tr>
            <td><?php echo $item->id; ?></td>
            <td class="text-center"><?php echo $item->nickname; ?></td>
            <td class="text-center"><?php echo $item->points; ?></td>
            <td class="text-center"><?php echo $item->email; ?></td>
            <td class="text-center"><?php echo !empty($item->created_at) ? date('Y-m-d H:i:s', $item->created_at) : ''; ?></td>
            <td class="text-center"><?php echo !empty($item->last_login) ? date('Y-m-d H:i:s', $item->last_login) : ''; ?></td>
            <th class="text-center"><?php echo $item->is_delete ? '已删除' : ($item->is_disable ? '已冻结' : '正常'); ?></th>
            <td class="text-center">
                <?php echo Html::anchor('admin/members/disable/'.$item->id, '冻结', array('onclick' => "return confirm('亲，您确定要冻结么?')")); ?> |
                <?php echo Html::anchor('admin/members/delete/'.$item->id, '删除', array('onclick' => "return confirm('亲，您确定要删除么?')")); ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
</table>
<?php else: ?>
<p style="padding: 40px; text-align: center">没有任何会员。</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('mypagination')->render();?>
