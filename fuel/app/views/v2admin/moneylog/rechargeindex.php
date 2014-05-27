<?php
echo Asset::css(
    [
        'member/jquery-ui.css',
        ]
    );
echo Asset::js(
        [
            'jquery-ui.js',
            'admin/log/index.js',
            ]
        );
?>
<div class="panel panel-default" style="padding: 10px 0">
    <form class="form-inline" role="form" action="" method="get">
      <div class="form-group">
        <!--<input type="text" class="form-control" name="member" value="<?php echo Input::get('member'); ?>" placeholder="用户名" />-->
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="start_at" value="<?php echo Input::get('start_at'); ?>" placeholder="开始时间" id="start_at" />
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="end_at" value="<?php echo Input::get('end_at'); ?>" placeholder="结束时间" id="end_at" />
      </div>
      <button type="submit" class="btn btn-default">搜索</button>
      <a href="<?php echo Uri::create('v2admin//moneylog/recharge'); ?>" class="btn btn-default">重置</a>
    </form>
     <div class="clearfix"></div>
</div>
<div class="panel panel-default">
<?php if ($logs): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>用户ID</th>
            <th>用户邮箱</th>
            <th>充值时间</th>
            <th width="15%">充值额度</th>
            <th>充值渠道</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($logs as $item): ?>
        <tr>
            <td><?php echo $item->id; ?></td>
            <td><?php echo $item->member_id; ?></td>
            <td><?php echo $getuser($item->member_id); ?></td>  
            <td class="col-sm-1"><?php echo date('Y-m-d H:i:s', $item->created_at); ?></td>
            <td class="col-sm-1"><?php echo \Helper\Coins::showIconCoins($item->sum); ?></td>
            <td class="col-sm-1"><?php echo $item->source; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>暂无用户充值日志</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('alogspage')->render();?>
