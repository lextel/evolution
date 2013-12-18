<script type="text/javascript">
    UPLOAD_URL = '<?php echo Uri::create('admin/items/upload'); ?>';
    EDITOR_URL = '<?php echo Uri::create('admin/items/editorUpload'); ?>';
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
<?php echo Form::open(array("class"=>"form-horizontal")); ?>
    <fieldset>
        <div class="form-group">
          <?php echo Form::label('标题:', 'title', array('class'=>'control-label')); ?>
          <?php echo Form::input('title', Input::post('title', isset($item) ? $item->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'商品标题')); ?>
        </div>
        <div class="form-group">
          <?php 
            echo Form::label('图片:', 'title', array('class'=>'control-label')); 
          ?>
          <div class="row">
              <div class="col-md-5 rigth" id="images"></div>
          </div>
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>选择图片...</span>
                <input id="fileupload" type="file" name="files[]" multiple>
            </span>
            <br>
            <br>
            <div id="files" class="files">
              <?php 
                if(isset($item)) {
                    $images = unserialize($item->images);
                    foreach($images as $image) {
                        echo '<p><img style="width: 60px; height: 60px; margin:5px; float: left" src="/'.$image.'"><input type="hidden" name="images[]" value="'.$image.'"></p>';
                    }
                }
              ?>
            </div>
            <br>
        </div>
        <div class="form-group">
            <?php echo Form::label('描述:', 'desc', array('class'=>'control-label')); ?>
            <script id="editor" type="text/plain" style="width:1024px;height:500px;"></script>
        </div>
        <div class="form-group">
            <?php echo Form::label('价值:', 'price', array('class'=>'control-label')); ?>
            <?php echo Form::input('price', Input::post('price', isset($item) ? $item->price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'商品价值')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('分类:', 'cate_id', array('class'=>'control-label')); ?>
            <?php echo Form::select('cate_id', Input::post('cate_id', isset($item) ? $item->cate_id : ''), $cates, ['class' => 'col-md-4 form-control']); ?>
        </div>
        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary', 'id'=>'submitBtn')); ?>
        </div>
    </fieldset>
<?php echo Form::close(); ?>
