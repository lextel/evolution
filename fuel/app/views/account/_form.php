<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Username', 'username', array('class'=>'control-label')); ?>

				<?php echo Form::input('username', Input::post('username', isset($account) ? $account->username : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Username')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Password', 'password', array('class'=>'control-label')); ?>

				<?php echo Form::input('password', Input::post('password', isset($account) ? $account->password : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Password')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Nickname', 'nickname', array('class'=>'control-label')); ?>

				<?php echo Form::input('nickname', Input::post('nickname', isset($account) ? $account->nickname : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nickname')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Avatar', 'avatar', array('class'=>'control-label')); ?>

				<?php echo Form::input('avatar', Input::post('avatar', isset($account) ? $account->avatar : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Avatar')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Bio', 'bio', array('class'=>'control-label')); ?>

				<?php echo Form::input('bio', Input::post('bio', isset($account) ? $account->bio : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Bio')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Mobile', 'mobile', array('class'=>'control-label')); ?>

				<?php echo Form::input('mobile', Input::post('mobile', isset($account) ? $account->mobile : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Mobile')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Points', 'points', array('class'=>'control-label')); ?>

				<?php echo Form::input('points', Input::post('points', isset($account) ? $account->points : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Points')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Last login', 'last_login', array('class'=>'control-label')); ?>

				<?php echo Form::input('last_login', Input::post('last_login', isset($account) ? $account->last_login : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Last login')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>