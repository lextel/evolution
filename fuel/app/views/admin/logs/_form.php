<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('user_id', Input::post('user_id', isset($log) ? $log->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Desc', 'desc', array('class'=>'control-label')); ?>

				<?php echo Form::input('desc', Input::post('desc', isset($log) ? $log->desc : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Desc')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Ip', 'ip', array('class'=>'control-label')); ?>

				<?php echo Form::input('ip', Input::post('ip', isset($log) ? $log->ip : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Ip')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>