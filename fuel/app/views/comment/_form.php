<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('user_id', Input::post('user_id', isset($comment) ? $comment->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Text', 'text', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('text', Input::post('text', isset($comment) ? $comment->text : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Text')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Status', 'status', array('class'=>'control-label')); ?>

				<?php echo Form::input('status', Input::post('status', isset($comment) ? $comment->status : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Status')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Pid', 'pid', array('class'=>'control-label')); ?>

				<?php echo Form::input('pid', Input::post('pid', isset($comment) ? $comment->pid : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Pid')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Is deleted', 'is_deleted', array('class'=>'control-label')); ?>

				<?php echo Form::input('is_deleted', Input::post('is_deleted', isset($comment) ? $comment->is_deleted : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Is deleted')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>