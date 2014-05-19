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
    <form class="navbar-form navbar-left" role="search" action="" method="get">
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">用户名</span>
              <input type="text" class="form-control" name="member" 
                    value="<?php echo !empty(Input::get('member')) ? Input::get('member') : ''; ?>" placeholder="用户名" id="member">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">开始时间</span>
              <input type="text" class="form-control" name="start_at"
                  value="<?php echo !empty(Input::get('start_at')) ? Input::get('start_at') : ''; ?>" placeholder="开始时间" id="start_at">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">结束时间</span>
              <input type="text" class="form-control" name="end_at"
                 value="<?php echo !empty(Input::get('end_at')) ? Input::get('end_at') : ''; ?>" placeholder="结束时间" id="end_at">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">搜索</button>
        <a href="<?php echo Uri::create('v2admin/applogs'); ?>" class="btn btn-default">重置</a>
    </form>
    <div class="clearfix"></div>
</div>
<div class="panel panel-default table-responsive">
<?php if ($logs): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">用户名</th>
            <th class="text-center">包名</th>
            <th class="text-center">奖励</th>
            <th class="text-center">获得时间</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($logs as $item): ?>
        <tr>
            <td class="text-center"><?php echo '#'.$item->id; ?></td>
            <td class="text-center"><?php echo $item->username; ?></td>
            <td class="text-center"><?php echo $item->title; ?></td>
            <td class="text-center"><?php echo $item->award; ?><img src="/assets/img/yinbi.png" /></td>
            <td class="text-center"><?php echo Date("Y-m-d H:i:s", $item->created_at); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p style="padding: 40px; text-align: center">没有任何日志。</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('applogspage')->render();?>
