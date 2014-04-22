<?php echo Form::open(["class"=>"form-horizontal", 'action' => $url]); ?>
    <fieldset>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">#ID:</label>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $suggest->id; ?></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">标题:</label>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $suggest->title; ?></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">内容:</label>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $suggest->text;?></p>
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">发布时间:</label>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo date('Y-m-d H:i:s', $suggest->created_at); ?></p>
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">审核状态:</label>
          <div class="col-sm-8">
                <div class="row">
                    <?php echo Form::select('status', $suggest->status, ['2'=>'不处理', '1'=>'已阅'], ['class'=>'form-control col-sm-5']);?>
                    
                </div>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-1">&nbsp;</label>
            <div class="col-sm-8">
                <button type="submit" class="btn btn-info">提交</button>
                <a href="<?php echo Uri::create('/v2admin/suggests');?>" class="btn">返回</a>
            </div>
        </div>
    </fieldset>
<?php echo Form::close(); ?>
