<form class="form-inline" role="form" action="" method="get">
  <div class="form-group">
    <select class="form-control" name="user_id" id="form_user_id">
        <option value=''>发布人</option>
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
    <input type="text" class="form-control" name="title" value="<?php echo Input::get('title'); ?>" placeholder="公告标题">
  </div>
  <button type="submit" class="btn btn-default">搜索</button>
  <a href="<?php echo Uri::create('admin/notices'); ?>" class="btn btn-default">重置</a>
  <?php echo Html::anchor('admin/notices/create', '发布公告', array('class' => 'btn btn-success  col-md-offset-6')); ?>
</form>
<?php if ($notices): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>标题</th>
            <th>概要</th>
            <td>发布时间</th>
            <td>操作人</th>
            <th>置顶</th>
            <td>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($notices as $item): ?>
        <tr>
            <td><?php echo $item->title; ?></td>
            <td><?php echo $item->summary; ?></td>
            <td><?php echo date('Y-m-d H:i:s', $item->created_at); ?></td>
            <td><?php echo $getUsername($item->user_id); ?></td>
            <td><?php echo $item->is_top ? '是' : '否';?></td>
            <td>
                <?php echo Html::anchor('admin/notices/view/'.$item->id, '查看'); ?> |
                <?php echo Html::anchor('admin/notices/edit/'.$item->id, '编辑'); ?> |
                <?php echo Html::anchor('admin/notices/delete/'.$item->id, '删除', array('onclick' => "return confirm('亲，真的要删除么?')")); ?>

            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
</table>

<?php else: ?>
<p style="text-align:center">没有任何公告.</p>

<?php endif; ?>
<?php echo Pagination::instance('mypagination')->render();?>
