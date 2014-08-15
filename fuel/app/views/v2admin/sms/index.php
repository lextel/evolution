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
              <span class="input-group-addon">操作人</span>
              <select class="form-control" name="user_id" id="form_user_id">
                  <option value=''>--请选择--</option>
                  <?php
                      foreach($users as $user):
                          $select = '';
                          if(Input::get('user_id') == $user->id):
                              $select = 'selected="selected"';
                          endif;
                          echo '<option value="'.$user->id.'" '.$select.'>'.$user->username.'</option>';
                      endforeach;
                  ?>
              </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">开始时间</span>
              <input type="text" class="form-control" name="start_at" value="<?php echo !empty(Input::get('start_at')) ? Input::get('start_at') : ''; ?>" placeholder="开始时间" id="start_at">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">结束时间</span>
              <input type="text" class="form-control" name="end_at" value="<?php echo !empty(Input::get('end_at')) ? Input::get('end_at') : ''; ?>" placeholder="结束时间" id="end_at">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">搜索</button>
        <a href="<?php echo Uri::create('v2admin/logs'); ?>" class="btn btn-default">重置</a>
    </form>
    <div class="clearfix"></div>
</div>
<div class="panel panel-default table-responsive">
<?php if ($logs): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="text-center">#ID</th>
            <th class="text-center">接收人</th>
            <th class="text-center" width="60%">内容</th>
            <th class="text-center">类型</th>
            <th class="text-center">来源</th>
            <th class="text-center">状态</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($logs as $item): ?>
        <tr>
            <td class="text-center"><?php echo $item->id; ?></td>
            <td class="text-center"><?php echo $getUsername($item->owner_id); ?></td>
            <td style="word-break: break-all;"><?php echo $item->title; ?></td>
            <td class="text-center"><?php echo $item->type; ?></td>
            <td class="text-center"><?php echo $item->user_name ?></td>
            <td class="text-center"><?php echo $item->status ? '已阅': '未读'; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p style="padding: 40px; text-align: center">没有任何日志。</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('mypagination')->render();?>
