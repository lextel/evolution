<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Title', 'title', array('class'=>'control-label')); ?>

				<?php echo Form::input('title', Input::post('title', isset($notice) ? $notice->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Title')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Summary', 'summary', array('class'=>'control-label')); ?>

				<?php echo Form::input('summary', Input::post('summary', isset($notice) ? $notice->summary : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Summary')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Desc', 'desc', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('desc', Input::post('desc', isset($notice) ? $notice->desc : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Desc')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>