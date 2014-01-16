<div class="panel panel-default" style="padding: 10px 0">
    <form class="navbar-form navbar-left" role="search" action="" method="get">
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">状态</span>
              <select class="form-control" name="status" id="form_cate_id">
                  <?php
                      Config::load('shipping');
                      $status = Config::get('status');
                      $current_status = Input::get('status');
                      foreach($status as $key => $val):
                          $select = '';
                          if($current_status === $key):
                              $select = 'selected="selected"';
                          endif;
                          echo '<option value="'.$key.'" ' .$select . '>'.$val.'</option>';
                      endforeach;
                  ?>
              </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">搜索</button>
        <a type="submit" class="btn btn-default" href="<?php echo Uri::create('admin/shipping'); ?>">重置</a>
        </form>
    <div class="clearfix"></div>
</div>

<div class="panel panel-default">
<?php if ($ships): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#ID</th>
            <th>商品</th>
            <th>会员名称</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($ships as $item):
            $userInfo = $getUser($item->member_id);
            $phaseInfo = $getItem($item->phase_id);
        ?>

        <tr>
            <td><?php echo $item->id; ?></td>
            <td><a href="<?php echo Uri::create('w/'.$phaseInfo->id); ?>" target="_blank"><?php echo sprintf('(第%d期)%s', $phaseInfo->phase_id, $phaseInfo->title); ?></a></td>
            <td><?php echo $userInfo->nickname; ?></td>
            <td><?php echo $getStatus($item->status); ?></td>
            <td>
                <?php echo Html::anchor(Uri::create('admin/shipping/view/'.$item->id), '查看'); ?>
                <?php
                    if($item->status == 100):
                        echo ' | ' . Html::anchor(Uri::create('admin/shipping/ship/'.$item->id), '发货');
                    endif;
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p style="text-align:center;padding: 40px">没有物流信息。</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('mypagination')->render();?>
