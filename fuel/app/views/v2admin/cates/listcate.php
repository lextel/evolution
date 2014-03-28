<?php
    echo Asset::js([
            'jquery.validate.js', 
            'jquery.ui.widget.js',
            'jquery.iframe-transport.js',
            'jquery.fileupload.js',
            'admin/cates/listCate.js',
            ]);
    echo Asset::css(['jquery.fileupload.css']);
?>
<script>
    UPLOAD_URL = '<?php echo Uri::create('v2admin/cates/upload'); ?>';
    IMAGE_URL  = '<?php echo Uri::create('/'); ?>';
</script>
<div class="panel panel-default" style="padding: 10px 0">
    <form class="navbar-form navbar-left" id="addCate" role="search" method="post" action="<?php echo Uri::create('v2admin/cates/createCate'); ?>">
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">分类</span>
              <input type="text" class="form-control" name="name" value="" placeholder="分类名称">
            </div>
        </div>
        <div class="col-sm-2">
          <span class="btn btn-success fileinput-button">
              <i class="glyphicon glyphicon-plus"></i>
              <span>添加图标</span>
              <input class="uploadField" type="file" name="file">
          </span>
        </div>
        <button id="addCateSubmit" class="btn btn-primary">添加</button>
    </form>
    <div class="clearfix"></div>
</div>
<div class="panel panel-default">
<?php if ($cates): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th style="width: 5%">#ID</th>
            <th style="width: 40%">名称</th>
            <th style="width: 20%">图标</th>
            <th style="width: 20%">最后更新时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cates as $cate): ?>
        <tr>
            <td><?php echo $cate->id; ?></td>
            <td class='editItem'><?php echo $cate->name; ?></td>
            <td class='editIcon'><?php echo !empty($cate->thumb) ? '<img data="'.$cate->thumb.'" src="' . Uri::create($cate->thumb) .'" style="width: 34px;height: 34px"/>' : '无'; ?></td>
            <td><?php echo date('Y-m-d', $cate->updated_at); ?></td>
            <td>
                <div class="editing">
                    <?php echo Html::anchor('javascript:void(0);', '保存', ['action' => 'save', 'data-id'=>$cate->id]); ?> |
                    <?php echo Html::anchor('javascript:location.reload()', '取消', ['action' => 'cancel']); ?>
                </div>
                <div class="edit">
                    <?php echo Html::anchor('javascript:void(0);', '编辑', ['action' => 'edit', 'data-id'=>$cate->id]); ?> |
                    <?php echo Html::anchor('v2admin/cates/delete/'.$cate->id, '删除', ['onclick' => "return confirm('亲，你确定要删除吗?')"]); ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p style="text-align:center; padding: 40px">还没有分类。</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('mypagination')->render();?>
<script>
    EDIT_URL = '<?php echo Uri::create('v2admin/cates/edit');?>';
</script>
