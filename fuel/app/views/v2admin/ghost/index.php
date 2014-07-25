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
        <a href="<?php echo Uri::create('v2admin/ghost'); ?>" class="btn btn-default">重置</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo Html::anchor('v2admin/ghost/create', '添加特殊用户', array('class' => 'btn btn-success pull-right')); ?>
        <?php echo Html::anchor('v2admin/ghost/multi', '批量添加', array('class' => 'btn btn-info pull-right')); ?>

    </form>
    <div class="clearfix"></div>
</div>
<div class="panel panel-default">
<?php if ($members): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#ID</th>
            <th class="text-center">头像</th>
            <th class="text-center">昵称</th>
            <th class="text-center">所用IP</th>
            <th class="text-center">所在地区</th>
            <th class="text-center">状态</th>
            <th class="text-center">操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($members as $item): ?>
        <tr>

            <td><?php echo $item->id; ?></td>
            <td class="text-center"><?php echo Html::img(\Helper\Image::showImage($item->avatar, '30x30'), ['style'=>'width:30px;height: 30px;']); ?></td>
            <td class="text-center"><?php echo Html::anchor('v2admin/ghost/forcelogin/'.$item->id, $item->nickname, ['target'=>'blank']); ?></td>
            <td class="text-center"><?php echo $item->ip; ?></td>
            <td class="text-center"><?php echo \Helper\Ip2area::toarea($item->ip); ?></td>
            <th class="text-center"><?php echo $item->is_delete ? '已删除' : ($item->is_disable ? '已冻结' : '正常'); ?></th>
            <td class="text-center">
                <?php echo Html::anchor('v2admin/ghost/getedit/'.$item->id, '编辑', ['class'=>'btn btn-success']); ?> |
                <?php echo Html::anchor('v2admin/ghost/delete/'.$item->id, '删除', ['onclick' => "return confirm('亲，您确定要删除么?')", ]); ?>
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
