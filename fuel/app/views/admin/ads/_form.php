<?php
echo Asset::css(
    [
        'jquery.fileupload.css', 
        'admin/items/form.css', 
        'member/jquery-ui.css',
        ]
    );
echo Asset::js(
        [
            'jquery.validate.js', 
            'additional-methods.min.js',
            'jquery.ui.widget.js',
            'jquery.iframe-transport.js',
            'jquery.fileupload.js',
            'jquery-ui.js',
            'admin/ads/form.js', 
            ]
        ); 
?>
<?php echo Form::open(array("class"=>"form-horizontal", 'action' => $url)); ?>
    <fieldset>
        <div class="form-group">
          <?php echo Form::label('标题:', 'title', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-6">
          <?php echo Form::input('title', Input::post('title', isset($ad) ? $ad->title : ''), array('class' => 'form-control', 'placeholder'=>'广告标题')); ?>
          </div>
          <span class="help-block">不超过255个字</span>
        </div>
        <div class="form-group">
            <?php echo Form::label('区域:', 'zone', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-3">
            <?php echo Form::select('zone', Input::post('zone', isset($ad) ? $ad->zone : ''), [1=>'首页幻灯片 980x350', 2=>'所有商品页 450x350'], ['class' => 'form-control']); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('排序:', 'sort', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-3">
            <?php echo Form::input('sort', Input::post('sort', isset($ad) ? $ad->sort : ''), array('class' => 'form-control', 'placeholder'=>'广告排序')); ?>
            </div>
            <span class="help-block">整数，数字越大越靠前最大为999</span>
        </div>
        <div class="form-group">
            <?php echo Form::label('有效时间:', 'time', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-3">
            <?php echo Form::input('start_at', Input::post('sort', isset($ad) ? date('Y-m-d', $ad->start_at) : ''), array('class' => 'form-control', 'placeholder'=>'开始时间', 'id' => 'start')); ?>
            </div>
            <div class="col-sm-3">
            <?php echo Form::input('end_at', Input::post('sort', isset($ad) ? date('Y-m-d', $ad->end_at) : ''), array('class' => 'form-control', 'placeholder'=>'结束时间', 'id' => 'end')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('图片:', 'image', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
                <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>选择图片...</span>
                      <input id="fileupload" type="file" name="files[]" multiple>
                </span>
            </div>
            <span class="help-block">支持格式：jpg 大小为：幻灯片980px*350px,所有商品450px*350px</span>
            <div class="control-label col-sm-1"></div>
            <div class="col-sm-5">
                <div id="files" class="files">
                  <?php 
                    if(isset($ad)) {
                        echo '<p><img style="margin:5px; float: left" src="'.Uri::create($ad->image).'"><d class="close"></d><input type="hidden" name="image" value="'.$ad->image.'"></p>';
                    }
                  ?>
               </div>
           </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('链接:', 'link', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-6">
            <?php echo Form::input('link', Input::post('link', isset($ad) ? $ad->link: ''), array('class' => 'form-control', 'placeholder'=>'广告超链接')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('是否启用:', 'status', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
            <?php echo Form::select('status', Input::post('status', isset($ad) ? $ad->status : ''), [1=>'启用', 0=>'不启用'], ['class' => 'form-control']); ?>
            </div>
        </div>
        <div class="form-group">
            <label class='control-label col-sm-1'>&nbsp;</label>
            <div class="col-sm-2">
            <input type="hidden" name="type" value="1">
            <?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
    </fieldset>
    <?php echo Form::close(); ?>
    <script type="text/javascript">
        UPLOAD_URL = '<?php echo Uri::create('admin/ads/upload'); ?>';
        IMAGE_URL  = '<?php echo Uri::create('/'); ?>';
    </script>
