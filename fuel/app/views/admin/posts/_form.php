<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Title', 'title', array('class'=>'control-label')); ?>

				<?php echo Form::input('title', Input::post('title', isset($post) ? $post->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Title')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Desc', 'desc', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('desc', Input::post('desc', isset($post) ? $post->desc : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Desc')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Status', 'status', array('class'=>'control-label')); ?>

				<?php echo Form::input('status', Input::post('status', isset($post) ? $post->status : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Status')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Item id', 'item_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('item_id', Input::post('item_id', isset($post) ? $post->item_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Item id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('user_id', Input::post('user_id', isset($post) ? $post->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Type id', 'type_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('type_id', Input::post('type_id', isset($post) ? $post->type_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Type id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Phase id', 'phase_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('phase_id', Input::post('phase_id', isset($post) ? $post->phase_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Phase id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Topimage', 'topimage', array('class'=>'control-label')); ?>

				<?php echo Form::input('topimage', Input::post('topimage', isset($post) ? $post->topimage : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Topimage')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Images', 'images', array('class'=>'control-label')); ?>

				<?php echo Form::input('images', Input::post('images', isset($post) ? $post->images : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Images')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>