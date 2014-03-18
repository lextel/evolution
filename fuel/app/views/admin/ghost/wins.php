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
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">是否晒单</span>
              <select class="form-control" name="status" id="form_cate_id">
                  <?php
                      $status = ['2'=>'全部', '0'=>'未晒单', '1'=>'已晒单'];
                      $current_status = Input::get('status', '2');
                      foreach($status as $key => $val):
                          $select = '';
                          if(intval($current_status) === $key):
                              $select = 'selected="selected"';
                          endif;
                          echo '<option value="'.$key.'" ' .$select . '>'.$val.'</option>';
                      endforeach;
                  ?>
              </select>
           </div>
        </div>
        <button type="submit" class="btn btn-primary">搜索</button>
        <a href="<?php echo Uri::create('admin/ghost/win'); ?>" class="btn btn-default">重置</a>
        <?php echo Html::anchor('admin/ghost/create', '添加特殊会员', array('class' => 'btn btn-success pull-right')); ?>
    </form>
    <div class="clearfix"></div>
</div>
<div class="panel panel-default">
<?php if ($phases): ?>
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
            <td class="text-center"><?php echo $members[$item->member_id]->nickname; ?></td>
            <td class="text-center"><?php echo Html::anchor('w/'.$item->id, '第('.$item->phase_id.')期'.$item->title, ['target'=>'blank']); ?></td>
            <td class="text-center">
                <?php if ($item->post_id==0){ ?>
                <?php echo Html::anchor('admin/ghost/gopost/'.$item->member_id, '去晒单', ['onclick' => "return confirm('亲，你确定要去晒单吗?')", 'target'=>'blank', 'class'=>'btn btn-success']); ?>
                <?php }else{?>
                <?php echo '已晒单'; ?>
                <?php } ?>
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
