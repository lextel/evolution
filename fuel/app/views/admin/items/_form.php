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
            <?php echo Form::label('排序:', 'sort', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
                <?php echo Form::input('sort', Input::post('sort', isset($item) ? $item->sort : '0'), array('class' => 'form-control', 'placeholder'=>'排序')); ?>
            </div>
            <span class="help-block">数字，值越大排越前</span>
        </div>
        <div class="form-group">
            <?php echo Form::label('期数:', 'phase', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
                <?php echo Form::input('phase', Input::post('phase', isset($item) ? $item->phase : '0'), array('class' => 'form-control', 'placeholder'=>'开放期数')); ?>
            </div>
            <span class="help-block">数字，本商品运行多少期，为0时不限制期数</span>
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
          <div class="col-sm-11">
              <span class="btn btn-success fileinput-button">
                  <i class="glyphicon glyphicon-plus"></i>
                  <span>选择图片...</span>
                  <input id="fileupload" type="file" name="files[]" multiple>
              </span>
              <span class="help-block">正方形，不超过5张图片，点击图片可设置首图(默认第一张为首图)</span>
              <div class="row">
              <div id="top" class="col-sm-1">
                <?php 
                    if(isset($item)):
                        echo "<div><img src='".Uri::create('image/80x80/' .$item->image)."'>";
                        echo "<p style='font-size: 10px; text-align: center; width:80px'>当前首图</p></div>";
                    endif;
                ?>
              </div>
              <div id="files" class="col-sm-5">
                    <?php 
                      $index = 0;
                      if(isset($item)) {
                          $images = unserialize($item->images);
                          foreach($images as $idx => $image) {
                              $top = '';
                              if($item->image == $image) {
                                  $index = $idx;
                                  $top = ' top';
                              }
                              echo '<div class="item-img-list'.$top.'">';
                              echo '<a style="display:block;" href="javascript:void(0);" index="'.$idx.'">';
                              echo '<img src="'.Uri::create('image/80x80/'.$image).'">';
                              echo '</a>';
                              echo '<input type="hidden" name="images[]" value="'.$image.'">';
                              echo '<d class="close">&times;</d></div>';
                          }
                      }
                    ?>
              </div>
              <input type="hidden" value="<?php echo $index;?>" id="index" name="index">
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
