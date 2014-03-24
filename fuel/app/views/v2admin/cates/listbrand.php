<?php
    echo Asset::js(['jquery.validate.js', 'admin/cates/listCate.js']);
?>
<div class="panel panel-default" style="padding: 10px 0">
    <form class="navbar-form navbar-left" id="addCate" role="search" id="addBrand" method="post" action="<?php echo Uri::create('v2admin/cates/createBrand'); ?>">
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">分类</span>
              <select class="form-control" name="parent_id">
                  <?php 
                  foreach($cates as $key => $cate) :
                      echo '<option value="'.$key.'">'.$cate.'</option>';
                  endforeach; 
                  ?>
              </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">品牌</span>
              <input type="text" class="form-control" name="name" value="" placeholder="品牌名称">
            </div>
        </div>
        <button id="addCateSubmit" class="btn btn-primary">添加</button>
    </form>
    <div class="clearfix"></div>
</div>
<div class="panel panel-default">
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
                    <?php echo Html::anchor('v2admin/cates/delete/'.$item->id, '删除', ['onclick' => "return confirm('亲，你确定要删除吗?')"]); ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p style="text-align:center;padding: 40px">还没有品牌.</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('mypagination')->render();?>
<script>
    EDIT_URL = '<?php echo Uri::create('v2admin/cates/edit');?>';
</script>
