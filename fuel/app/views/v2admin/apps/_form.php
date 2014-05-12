<script type="text/javascript">
    SIZES = <?php echo json_encode($sizes);?>;
</script>
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
            'admin/apps/form.js', 
            ]
        ); 
?>
<?php echo Form::open(array("class"=>"form-horizontal", 'action' => '')); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('包名', 'package', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">                
                <?php echo Form::input('package', Input::post('package', isset($app) ? $app->package : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'包名')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('名称', 'title', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
                <?php echo Form::input('title', Input::post('title', isset($app) ? $app->title : ''), array('class' => 'form-control', 'placeholder'=>'名称')); ?>
                
            </div>
        </div>
        
        <div class="form-group">
            <?php echo Form::label('ICON图标', 'icon', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
                <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>选择图标...</span>
                      <input id="iconUpload" type="file" name="appimg">
                </span>
                <p class="form-control-static">
                    <?php echo Html::img(isset($app) ? $app->icon : '', ['style'=>"margin: 10px; border: 1px #ccc solid; padding:3px;width:80px;height:80px", 'id'=>'icon']);?>
                     <input type="hidden" name="icon" value="<?php echo isset($app) ? $app->icon : '' ;?>">                              
                </p>
            </div>       
        </div>
        
        <div class="form-group">
          <?php echo Form::label('图片', 'images', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-8">
                <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>选择图片...</span>
                      <input id="imgUpload" type="file" name="img" multiple>                     
                </span>
                <span>正方形，3张图片</span>
                <p class="form-control-static" id="imgfiles"> 
                    <?php 
                        $images = isset($app) ? unserialize($app->images) : [];
                        foreach($images as $image) {
                              echo '<div class="item-img-list withclose">';
                              echo Html::img($image, ['style'=>"border: 1px #ccc solid; padding:3px;width:80px;height:80px"]);
                              echo '<input type="hidden" name="images[]" value="'.$image.'">';
                              echo '<d class="close">&times;</d></div>';
                          }?>                 
                </p>
          </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('内容', 'summary', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
            <?php echo Form::textarea('summary', Input::post('summary', isset($app) ? $app->summary : ''), ['class' => 'form-control', 'placeholder'=>'签名', 'rows'=>8]); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('奖励', 'award', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2 input-group">
                <?php echo Form::input('award', Input::post('award', isset($app) ? $app->award : ''), ['class' => 'form-control', 'placeholder'=>'奖励']); ?>   
                <span class="input-group-addon"><img src="/assets/img/yinbi.png" /></span>           
            </div>
            
        </div>
        <div class="form-group">
            <?php echo Form::label('文件选择', 'link', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-7">
                <?php  $tmp = [''=>'请选需要的文件'];
                        foreach($appfile as $file ) {
                            $tmp[$file] = $file;      
                        }
                ?>
                <?php echo Form::select('link', Input::post('link', isset($app) ? $app->link : ''), $tmp, ['class' => 'form-control apkfile']); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('文件大小', 'size', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2 input-group">
                <?php echo Form::input('size', Input::post('size', isset($app) ? $app->size : ''), ['class' => 'form-control', 'placeholder'=>'文件大小']); ?>
                <span class="input-group-addon"></span>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('系统', 'os', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
                <?php echo Form::select('os', Input::post('os', isset($app) ? $app->os : '1'), ['1'=>'安卓', '2'=>'苹果'],['class' => 'form-control']); ?>
            </div>
        </div>
        <div class="form-group">
            <label class='control-label col-sm-1'>&nbsp;</label>
            <div class="col-sm-2">
            <?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>        
            <?php echo Html::anchor('/v2admin/apps', '返回', array('class' => 'btn btn-default')); ?></div>
            </div>
    </fieldset>
<?php echo Form::close(); ?>
