<?php if($breadcrumb): ?>
<ol class="breadcrumb">
    <?php echo $breadcrumb; ?>
</ol>
<?php endif; ?>
<?php echo Form::open(["class"=>"form-horizontal"]); ?>
    <fieldset>
        <div class="form-group">
          <?php echo Form::label('#ID:', 'id', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $notice->id; ?></p>
          </div>
        </div>
        <div class="form-group">
          <?php echo Form::label('标题:', 'title', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $notice->title; ?></p>
          </div>
        </div>
        <div class="form-group">
          <?php echo Form::label('发布人:', 'created_at', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $getUsername($notice->user_id); ?></p>
          </div>
        </div>
        <div class="form-group">
          <?php echo Form::label('概要:', 'summary', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $notice->summary; ?></p>
          </div>
        </div>
        <div class="form-group">
          <?php echo Form::label('内容:', 'desc', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $notice->desc; ?></p>
          </div>
        </div>
        <div class="form-group">
          <?php echo Form::label('置顶:', 'is_top', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $notice->is_top ? '是' : '否'; ?></p>
          </div>
        </div>
        <div class="form-group">
          <?php echo Form::label('发布时间:', 'created_at', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo date('Y-m-d H:i:s', $notice->created_at); ?></p>
          </div>
        </div>
    </fieldset>
<?php echo Form::close(); ?>
<?php echo Html::anchor('admin/notices', '返回'); ?>
