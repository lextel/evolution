<?php
    echo Asset::js(['jquery.validate.js', 'admin/cates/listCate.js']);
?>
<?php if($breadcrumb): ?>
<ol class="breadcrumb">
    <?php echo $breadcrumb; ?>
</ol>
<?php endif; ?>
<form class="form-horizontal" role="form" id="addBrand" method="post" action="<?php echo Uri::create('admin/cates/createBrand'); ?>">
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">添加商品品牌</label>
    <div class="col-sm-2">
        <select class="form-control" name="parent_id">
            <?php 
            foreach($cates as $key => $cate) :
                echo '<option value="'.$key.'">'.$cate.'</option>';
            endforeach; 
            ?>
        </select>
    </div>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="name" id="name" placeholder="品牌名称">
    </div>
    <div class="col-sm-2">
      <button id="addCateSubmit" class="btn btn-default">添加</button>
    </div>
  </div>
</form>
<?php if ($brands): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#ID</th>
            <th>分类</th>
            <th>品牌</th>
            <th>最后更新时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($brands as $item): ?>
        <tr>
            <td><?php echo $item->id; ?></td>
            <td><?php echo $cates[$item->parent_id]; ?></td>
            <td class="editItem"><?php echo $item->name; ?></td>
            <td><?php echo date('Y-m-d', $item->updated_at); ?></td>
            <td>
                <div class="editing">
                    <?php echo Html::anchor('javascript:void(0);', '保存', ['action' => 'save', 'data-id'=>$item->id]); ?> |
                    <?php echo Html::anchor('javascript:void(0);', '取消', ['action' => 'cancel']); ?>
                </div>
                <div class="edit">
                    <?php echo Html::anchor('javascript:void(0);', '编辑', ['action' => 'edit', 'data-id'=>$item->id]); ?> |
                    <?php echo Html::anchor('admin/cates/delete/'.$item->id, '删除', ['onclick' => "return confirm('亲，你确定要删除吗?')"]); ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p style="text-align:center">还没有品牌.</p>
<?php endif; ?>
<?php echo Pagination::instance('mypagination')->render();?>
<script>
    EDIT_URL = '<?php echo Uri::create('/admin/cates/edit');?>';
</script>
