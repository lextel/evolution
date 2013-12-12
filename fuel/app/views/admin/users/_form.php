<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('用户名', 'username', array('class'=>'control-label')); ?>

				<?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'用户名')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('用户密码', 'password', array('class'=>'control-label')); ?>

				<?php echo Form::input('password', Input::post('password', isset($user) ? $user->password : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'用户密码')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('用户邮箱', 'email', array('class'=>'control-label')); ?>

				<?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'用户邮箱')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('用户组', 'group', array('class'=>'control-label')); ?>

				<?php echo Form::select('group', isset($user) ? $user->group : 'none', array(100=>'管理员', 50=>'组长', 1=>'编辑'), array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>
