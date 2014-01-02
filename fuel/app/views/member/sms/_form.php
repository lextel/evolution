<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Ower id', 'ower_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('ower_id', Input::post('ower_id', isset($member_sm) ? $member_sm->ower_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Ower id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Title', 'title', array('class'=>'control-label')); ?>

				<?php echo Form::input('title', Input::post('title', isset($member_sm) ? $member_sm->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Title')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Type', 'type', array('class'=>'control-label')); ?>

				<?php echo Form::input('type', Input::post('type', isset($member_sm) ? $member_sm->type : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Type')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('user_id', Input::post('user_id', isset($member_sm) ? $member_sm->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('User name', 'user_name', array('class'=>'control-label')); ?>

				<?php echo Form::input('user_name', Input::post('user_name', isset($member_sm) ? $member_sm->user_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User name')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>