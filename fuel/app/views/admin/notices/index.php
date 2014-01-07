<div class="panel panel-default" style="padding: 10px 0">
<form class="navbar-form navbar-left" role="search" action="" method="get">
    <div class="col-sm-3">
        <div class="input-group">
          <span class="input-group-addon">发布人</span>
          <select class="form-control" name="user_id" id="form_user_id">
              <option value=''>--请选择--</option>
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
    </div>
    <div class="col-sm-5">
        <div class="input-group">
          <span class="input-group-addon">标题</span>
          <input type="text" class="form-control" name="title" value="<?php echo Input::get('title'); ?>" placeholder="公告标题">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">搜索</button>
    <a href="<?php echo Uri::create('admin/notices'); ?>" class="btn btn-default">重置</a>
    <?php echo Html::anchor('admin/notices/create', '发布新公告', array('class' => 'btn btn-success  col-md-offset-1')); ?>
</form>
<div class="clearfix"></div>
</div>
<div class="panel panel-default">
<?php if ($notices): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="text-center">标题</th>
            <th class="text-center">概要</th>
            <td class="text-center">发布时间</th>
            <td class="text-center">操作人</th>
            <th class="text-center">置顶</th>
            <td class="text-center">操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($notices as $item): ?>
        <tr>
            <td><?php echo $item->title; ?></td>
            <td><?php echo $item->summary; ?></td>
            <td class="text-center"><?php echo date('Y-m-d H:i:s', $item->created_at); ?></td>
            <td class="text-center"><?php echo $getUsername($item->user_id); ?></td>
            <td class="text-center"><?php echo $item->is_top ? '是' : '否';?></td>
            <td class="text-center">
                <?php echo Html::anchor('admin/notices/view/'.$item->id, '查看'); ?> |
                <?php echo Html::anchor('admin/notices/edit/'.$item->id, '编辑'); ?> |
                <?php echo Html::anchor('admin/notices/delete/'.$item->id, '删除', array('onclick' => "return confirm('亲，真的要删除么?')")); ?>

            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
</table>
<?php else: ?>
<p style="text-align:center; padding: 40px;">没有任何公告.</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('mypagination')->render();?>
