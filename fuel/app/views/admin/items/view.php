<ul class="nav nav-tabs">
  <li class="active"><a href="#info" data-toggle="tab">简要信息</a></li>
  <li><a href="#desc" data-toggle="tab">图文详情</a></li>
  <li><a href="#plan" data-toggle="tab">运行进度</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="info">
    <?php echo Form::open(["class"=>"form-horizontal", 'action' => $url]); ?>
        <fieldset>
            <div class="form-group">
              <?php echo Form::label('#ID:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo $item->id; ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('标题:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo $item->title; ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('价值:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo '￥'. sprintf('%.2f', $item->price); ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('图片:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static">
                    <?php 
                        $images = unserialize($item->images);
                        foreach($images as $image) {
                            echo '<img src="'.Uri::create('/image/80x80/' . $image).'" style="margin: 10px; border: 1px #ccc solid; padding:3px">';
                        }
                    ?>
                </p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('发布时间:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo date('Y-m-d H:i:s', $item->created_at); ?></p>
              </div>
            </div>
            <?php var_dump($current_user->group); ?>
            <div class="form-group">
              <?php echo Form::label('审核状态:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-2">
                  <select class="form-control" name="status"/>
                      <option value="1">通过</option>
                      <option value="2">不通过</option>
                  </select>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-1">&nbsp;</label>
                <div class="col-sm-5">
                    <textarea class="form-control" placeholder='不通过理由' name="reason"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-1">&nbsp;</label>
                <div class="col-sm-8">
                    <button type="submit" class="btn">提交</button>
                </div>
                
            </div>
        </fieldset>
    <?php echo Form::close(); ?>
</div>
<div class="tab-pane" id="desc">
    <div style="padding:10px">
        <?php echo $item->desc; ?>
    </div>
</div>
<div class="tab-pane" id="plan">
    <?php if($item->status == \Helper\Item::IS_CHECK) :?>
        <p style="text-align: center">没有数据</p>
    <?php else: ?>
        <p style="text-align: center">没有数据</p>
    <?php endif; ?>
</div>
</div>
