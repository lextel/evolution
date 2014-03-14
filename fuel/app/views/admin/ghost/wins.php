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
            <td class="text-center">中奖商品</td>
            <th class="text-center">操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($phases as $item): ?>
        <tr>
            <td><?php echo $item->id; ?></td>
            <td class="text-center"><?php echo $item->nickname; ?></td>
            <td class="text-center"><?php echo $item->title ?></td>
            <td class="text-center">
                <?php echo Html::anchor('admin/ghost/disable/'.$item->id, '去晒单', array('onclick' => "return confirm('亲，你确定要去晒单吗?')")); ?> |
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
