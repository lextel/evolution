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
            'admin/ghost/multi.js', 
            ]
        ); 
?>
<?php echo Form::open(array("class"=>"form-horizontal", 'action' => '')); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('批量头像', 'avatars', array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-2">
                <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>选择图片...</span>
                      <input id="multipleupload" type="file" name="avatars" multiple>
                </span>
            </div>
            <!--<span class="help-block"></span>
            <div class="control-label col-sm-1"></div>-->
        </div>
        <div class="form-group">
            <?php echo Form::label('', 'avatar', array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-6">
                图片名字不要重复，否则会发生图片覆盖
                <table class="table table-striped avatarfiles">
                
                </table>
           </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('批量CSV导入', 'csv', array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-2">
                <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>选择文件...</span>
                      <input id="csvUpload" type="file" name="csv" multiple>
                </span>
            </div>
            <!--<span class="help-block"></span>
            <div class="control-label col-sm-1"></div>-->
        </div>
        <div class="form-group">
            <?php echo Form::label('', 'csv', array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-6">
                需要CSV输入格式：用户邮箱，用户昵称，用户头像，用户签名
                <br />
                文件名不要带符号 数字+字母
                <br />
                CSV 前2行留空
            </div>
        </div>
        <div class="form-group">
            <label class='control-label col-sm-1'>&nbsp;</label>
            <div class="col-sm-3">
                <a class="btn btn-primary" href="/admin/ghost">返回</a>
            </div>
        </div>
    </fieldset>
<?php echo Form::close(); ?>
