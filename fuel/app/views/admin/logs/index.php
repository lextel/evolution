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

<form class="form-inline" role="form" action="" method="get">
  <div class="form-group">
    <select class="form-control" name="user_id" id="form_user_id">
        <option value=''>操作人</option>
        <?php 
            foreach($users as $user):
                $select = '';
                if(Input::get('user_id') == $user->id):
                    $select = 'selected="seelcted"';
                endif;
                echo '<option value="'.$user->id.'" '.$select.'>'.$user->username.'</option>';
            endforeach;
        ?>
    </select>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="start_at" value="<?php echo !empty(Input::get('start_at')) ? Input::get('start_at') : ''; ?>" placeholder="启始时间" id="start_at">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="end_at" value="<?php echo !empty(Input::get('end_at')) ? Input::get('end_at') : ''; ?>" placeholder="结束时间" id="end_at">
  </div>
  <button type="submit" class="btn btn-default">搜索</button>
  <a href="<?php echo Uri::create('admin/logs'); ?>" class="btn btn-default">重置</a>
</form>

<?php if ($logs): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>管理员</th>
            <th>描述</th>
            <th>IP</th>
            <th>操作时间</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($logs as $item): ?>
        <tr>
            <td><?php echo $getUsername($item->user_id); ?></td>
            <td><?php echo $item->desc; ?></td>
            <td><?php echo $item->ip; ?></td>
            <td><?php echo date('Y-m-d H:i:s', $item->created_at); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>没有日志</p>
<?php endif; ?>
<?php echo Pagination::instance('mypagination')->render();?>
