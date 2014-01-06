<?php echo Form::open(array("class"=>"form-horizontal", 'action' => $url)); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('标题:', 'title', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-4">
            <?php echo Form::input('title', Input::post('title', isset($notice) ? $notice->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'公告标题')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('概要:', 'summary', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-8">
            <?php echo Form::input('summary', Input::post('summary', isset($notice) ? $notice->summary : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'公告概要')); ?>
            </div>
            <span class="help-block">不超过255个字</span>
        </div>
        <div class="form-group">
            <?php echo Form::label('内容', 'desc', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-8">
            <?php echo Form::textarea('desc', Input::post('desc', isset($notice) ? $notice->desc : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'公告内容')); ?>
            </div>

        </div>
        <div class="form-group">
            <?php echo Form::label('是否置顶', 'is_top', array('class'=>'control-label col-sm-1')); ?>
            <div class="col-sm-2">
                <?php echo Form::select('is_top', Input::post('is_top', isset($notice) ? $notice->is_top : ''), ['否', '是'], ['class' => 'form-control']); ?>
            </div>
        </div>
        <div class="form-group">
            <label class='control-label col-sm-1'>&nbsp;</label>
            <div class="col-sm-4">
            <?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
    </fieldset>
<?php echo Form::close(); ?>
