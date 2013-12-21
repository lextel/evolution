<?php
    echo Asset::js(['jquery.validate.js', 'admin/cates/listCate.js']);
?>
<?php if($breadcrumb): ?>
<ol class="breadcrumb">
    <?php echo $breadcrumb; ?>
</ol>
<?php endif; ?>
<form class="form-horizontal" role="form" id="addCate" method="post" action="<?php echo Uri::create('admin/cates/createCate'); ?>">
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">添加商品分类</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="name" id="name" placeholder="分类名称">
    </div>
    <div class="col-sm-2">
      <button id="addCateSubmit" class="btn btn-default">添加</button>
    </div>
  </div>
</form>
<?php if ($cates): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th style="width: 5%">#ID</th>
            <th style="width: 60%">名称</th>
            <th style="width: 20%">最后更新时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cates as $cate): ?>
        <tr>
            <td><?php echo $cate->id; ?></td>
            <td class='editItem'><?php echo $cate->name; ?></td>
            <td><?php echo date('Y-m-d', $cate->updated_at); ?></td>
            <td>
                <div class="editing">
                    <?php echo Html::anchor('javascript:void(0);', '保存', ['action' => 'save', 'data-id'=>$cate->id]); ?> |
                    <?php echo Html::anchor('javascript:void(0);', '取消', ['action' => 'cancel']); ?>
                </div>
                <div class="edit">
                    <?php echo Html::anchor('javascript:void(0);', '编辑', ['action' => 'edit', 'data-id'=>$cate->id]); ?> |
                    <?php echo Html::anchor('admin/cates/delete/'.$cate->id, '删除', ['onclick' => "return confirm('亲，你确定要删除吗?')"]); ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p style="text-align:center">还没有分类.</p>
<?php endif; ?>
<?php echo Pagination::instance('mypagination')->render();?>
<script>
    EDIT_URL = '<?php echo Uri::create('/admin/cates/edit');?>';
</script>
