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
            'admin/ghost/form.js', 
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
                <?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'邮箱')); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('密码', 'password', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
            <?php echo Form::input('password', Input::post('password', isset($user) ? $user->password : ''), array('class' => 'form-control', 'placeholder'=>'登录密码')); ?>
            <?php if(isset($user)) : ?>
            <span class="help-block">不修改请留空</span>
            <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('昵称', 'nickname', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
                <?php echo Form::input('nickname', Input::post('nickname', isset($user) ? $user->nickname : ''), array('class' => 'form-control', 'placeholder'=>'昵称')); ?>
            </div>
        </div>
       
        <div class="form-group">
            <?php echo Form::label('头像', 'avatar', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
                <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>选择图片...</span>
                      <input id="avatarUpload" type="file" name="avatar" multiple>
                </span>
            </div>
            <!--<span class="help-block"></span>
            <div class="control-label col-sm-1"></div>-->
        </div>
        <div class="form-group">
            <?php echo Form::label('', 'avatar', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-1">
                <div id="files" class="files">
                  <?php 
                    if(isset($user)) {
                        echo '<p><img style="margin:5px; float: left" src="'.Uri::create($user->avatar).'"><d class="close"></d><input type="hidden" name="avatar" value="'.$user->avatar.'"></p>';
                    }else{
                        if(Input::post('avatar', '')!=''){
                        echo '<p><img style="margin:5px; float: left" src="'.Uri::create(Input::post('avatar', '')).'"><d class="close"></d><input type="hidden" name="avatar" value="'.Input::post('avatar', '').'"></p>';
                    }
                    }
                  ?>
               </div>
           </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('签名', 'bio', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
            <?php echo Form::textarea('bio', Input::post('bio', isset($user) ? $user->bio : ''), array('class' => 'form-control', 'placeholder'=>'签名')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('注册时间', 'created_at', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
            <?php echo Form::input('created_at', Input::post('created_at', isset($user) ? $user->created_at : ''), array('class' => 'form-control', 'placeholder'=>'注册时间')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('注册IP', 'ip', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
            <?php echo Form::input('ip', Input::post('ip', isset($user) ? $user->ip : ''), array('class' => 'form-control', 'placeholder'=>'注册IP')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class='control-label col-sm-1'>&nbsp;</label>
            <div class="col-sm-2">
            <?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>        </div>
            </div>
    </fieldset>
<?php echo Form::close(); ?>
