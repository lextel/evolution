<script type="text/javascript">
    UPLOAD_URL = '<?php echo Uri::create('admin/items/upload'); ?>';
    EDITOR_URL = '<?php echo Uri::create('admin/items/editorUpload'); ?>';
    CATE_URL = '<?php echo Uri::create('admin/cates/brands'); ?>';
    IMAGE_URL  = '<?php echo Uri::create('/'); ?>';
</script>
<?php
echo Asset::css(
    [
        'jquery.fileupload.css', 
        'admin/items/form.css', 
        ]
    );
echo Asset::js(
        [
            'jquery.validate.js', 
            'additional-methods.min.js',
            'jquery.ui.widget.js',
            'jquery.iframe-transport.js',
            'jquery.fileupload.js',
            'ueditor/ueditor.config.js',
            'ueditor/ueditor.all.min.js',
            'ueditor/lang/zh-cn/zh-cn.js',
            'admin/items/form.js', 
            ]
        ); 
?>
<?php if($breadcrumb): ?>
<ol class="breadcrumb">
    <?php echo $breadcrumb; ?>
</ol>
<?php endif; ?>
<?php echo Form::open(["class"=>"form-horizontal", 'action' => $url]); ?>
    <fieldset>
        <div class="form-group">
          <?php echo Form::label('标题:', 'title', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-8">
          <?php echo Form::input('title', Input::post('title', isset($item) ? $item->title : ''), array('class' => 'form-control', 'placeholder'=>'商品标题')); ?>
          </div>
          <span class="help-block">不超过255个字</span>
        </div>
        <div class="form-group">
            <?php echo Form::label('分类:', 'cate_id', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
            <?php echo Form::select('cate_id', Input::post('cate_id', isset($item) ? $item->cate_id : ''), $cates, ['class' => 'form-control']); ?>
            </div>
            <?php echo Form::label('品牌:', 'brand_id', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
            <?php echo Form::select('brand_id', Input::post('brand_id', isset($item) ? $item->brand_id : ''), $brands, ['class' => 'form-control']); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('价值:', 'price', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
            <?php echo Form::input('price', Input::post('price', isset($item) ? $item->price : ''), array('class' => 'form-control', 'placeholder'=>'商品价值')); ?>
            </div>
            <span class="help-block">请输入整数</span>
        </div>
        <div class="form-group">
          <?php 
            echo Form::label('图片:', 'title', array('class'=>'control-label col-sm-1')); 
          ?>
          <div class="col-sm-5">
              <span class="btn btn-success fileinput-button">
                  <i class="glyphicon glyphicon-plus"></i>
                  <span>选择图片...</span>
                  <input id="fileupload" type="file" name="files[]" multiple>
              </span>
              <span class="help-block">不超过5张图片</span>
            <div id="files" class="files">
              <?php 
                if(isset($item)) {
                    $images = unserialize($item->images);
                    foreach($images as $image) {
                        echo '<p><img style="width: 60px; height: 60px; margin:5px; float: left" src="/'.$image.'"><d class="close"></d><input type="hidden" name="images[]" value="'.$image.'"></p>';
                    }
                }
              ?>
            </div>
          </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('描述:', 'desc', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-10">
            <?php echo Form::textarea('desc', Input::post('desc', isset($item) ? $item->desc : ''), array('style' => 'height:400px', 'placeholder'=>'商品描述', 'id' => 'desc')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class='control-label col-sm-1'>&nbsp;</label>
            <div class="col-sm-5">
            <?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary', 'id'=>'submitBtn')); ?>
            </div>
        </div>
    </fieldset>
<?php echo Form::close(); ?>
