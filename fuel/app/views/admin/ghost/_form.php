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
            //'admin/ads/form.js', 
            ]
        ); 
?>
<?php echo Form::open(array("class"=>"form-horizontal", 'action' => $url)); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('账号', 'username', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
                <?php if(isset($user)) : ?>
                <p class="form-control-static"><?php echo isset($user) ? $user->username : '';?></p>
                <?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('type' => 'hidden')); ?>
                <?php else: ?>
                <?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'马甲邮箱')); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('密码', 'password', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
            <?php echo Form::password('password', '', array('class' => 'form-control', 'placeholder'=>'登录密码')); ?>
            <?php if(isset($user)) : ?>
            <span class="help-block">不修改请留空</span>
            <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('昵称', 'nickname', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
                <?php echo Form::input('nickname', Input::post('nickname', isset($user) ? $user->email : ''), array('class' => 'form-control', 'placeholder'=>'昵称')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('邮箱', 'email', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
            <?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'form-control', 'placeholder'=>'邮箱')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('头像', 'avatar', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
                <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>选择图片...</span>
                      <input id="fileupload" type="file" name="avatar" multiple>
                </span>
            </div>
            <span class="help-block"></span>
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
            <?php echo Form::label('签名', 'bio', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
            <?php echo Form::textarea('bio', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'form-control', 'placeholder'=>'签名')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('注册时间', 'created_at', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
            <?php echo Form::input('created_at', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'form-control', 'placeholder'=>'注册时间')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class='control-label col-sm-1'>&nbsp;</label>
            <div class="col-sm-2">
            <?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>        </div>
            </div>
    </fieldset>
<?php echo Form::close(); ?>
