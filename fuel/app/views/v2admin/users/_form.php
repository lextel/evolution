<?php echo Form::open(array("class"=>"form-horizontal", 'action' => $url)); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('账号', 'username', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
                <?php if(isset($user)) : ?>
                <p class="form-control-static"><?php echo isset($user) ? $user->username : '';?></p>
                <?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('type' => 'hidden')); ?>
                <?php else: ?>
                <?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'后台登陆账号')); ?>
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
            <?php echo Form::label('邮箱', 'email', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
            <?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'form-control', 'placeholder'=>'邮箱')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('权限', 'group', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
                <?php echo Form::select('group', isset($user) ? $user->group : 'none',  $keys, array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class='control-label col-sm-1'>&nbsp;</label>
            <div class="col-sm-2">
            <?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>        </div>
            </div>
    </fieldset>
<?php echo Form::close(); ?>
