<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Owner id', 'owner_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('owner_id', Input::post('owner_id', isset($task) ? $task->owner_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Owner id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('user_id', Input::post('user_id', isset($task) ? $task->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Action', 'action', array('class'=>'control-label')); ?>

				<?php echo Form::input('action', Input::post('action', isset($task) ? $task->action : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Action')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Type id', 'type_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('type_id', Input::post('type_id', isset($task) ? $task->type_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Type id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Is read', 'is_read', array('class'=>'control-label')); ?>

				<?php echo Form::input('is_read', Input::post('is_read', isset($task) ? $task->is_read : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Is read')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Obj id', 'obj_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('obj_id', Input::post('obj_id', isset($task) ? $task->obj_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Obj id')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>