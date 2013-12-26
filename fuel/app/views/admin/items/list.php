<?php
echo Asset::js(['admin/items/list.js']);
?>
<?php if($breadcrumb): ?>
<ol class="breadcrumb">
    <?php echo $breadcrumb; ?>
</ol>
<?php endif; ?>
<form class="form-inline" role="form" action="" method="get">
  <div class="form-group">
    <select class="form-control" name="cate_id" id="form_cate_id">
        <option value=''>--请选择分类--</option>
        <?php 
            foreach($cates as $key => $cate):
                echo '<option value="'.$key.'">'.$cate.'</option>';
            endforeach;
        ?>
    </select>
  </div>
  <div class="form-group">
    <select class="form-control" name="brand_id" id="form_brand_id">
        <option value=''>--请选择品牌--</option>
    </select>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="title" placeholder="商品标题">
  </div>
  <button type="submit" class="btn btn-default">搜索</button>
</form>
<?php if ($items): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>标题</th>
            <th>价格</th>
            <th>发布时间</th>
            <th>审核状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
          <tr>
            <td><?php echo '(第'.$item->phase->phase_id.'期)'.$item->title; ?></td>
            <td><?php echo '￥' . sprintf('%.2f', $item->price); ?></td>
            <td><?php echo date('Y-m-d H:i', $item->created_at); ?></td>
            <td><?php echo $getStatus($item->status);  ?></td>
            <td>
            <!--<?php echo Html::anchor('admin/items/edit/'.$item->id, '编辑'); ?> |-->
            <?php echo $getOperate($type, $item->id, $item->phase->phase_id); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
  OPERATE_URL = '<?php echo Uri::base() . 'admin/items/operate'?>';
</script>
<?php else: ?>
<p style='text-align:center; margin: 10px'>还没有商品.</p>
<?php endif; ?><p>
</p>
<?php echo Pagination::instance('mypagination')->render();?>
<script>
    CATE_URL = '<?php echo Uri::create('admin/cates/brands'); ?>';
</script>
