<?php echo Form::open(["class"=>"form-horizontal", 'action' => $url]); ?>
    <fieldset>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">#ID:</label>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $post->id; ?></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">标题:</label>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $post->title; ?></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">内容:</label>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $post->desc;?></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">图片:</label>
          <div class="col-sm-8">
            <p class="form-control-static">
                <?php
                    $images = unserialize($post->images);
                    foreach($images as $image) { ?>
                        <?php echo Html::img(\Helper\Image::showImage($image, '80x80', 'shares'), ['style'=>"margin: 10px; border: 1px #ccc solid; padding:3px;width:80px"]);?>
                <?php } ?>
            </p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">发布时间:</label>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo date('Y-m-d H:i:s', $post->created_at); ?></p>
          </div>
        </div>
        <?php  $phase = Model_Phase::find($post->phase_id);?>
        <?php if ($phase) { ?>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">产品标题:</label>
          <div class="col-sm-8">
            <p class="form-control-static">
            <?php echo Html::anchor('/m/'.$post->phase_id, '(第'.$phase->phase_id.'期)'.$phase->title, ['target'=>'_blank']); ?>
            </p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">产品图片:</label>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo Html::img(\Helper\Image::showImage($phase->image, '80x80', 'items'), ['style'=>"margin: 10px; border: 1px #ccc solid; padding:3px;width:80px"]); ?></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">产品价格:</label>
          <div class="col-sm-8">
            <p class="form-control-static"><?php echo $phase->cost / 100; ?> <img src="/assets/img/jinbi.png" /> = <?php echo $phase->cost; ?> <img src="/assets/img/yinbi.png" /></p>            
            
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">爆照奖励:</label>
          <div class="col-sm-3">
              <p class="form-control-static">
                      <?php Config::load('post');?>
                      <?php if ($post->award == '0') { ?>
                        <?php echo Form::checkbox('award', '1', $post->award ? true : false);?>
                      <?php }else{ ?>
                        <?php echo Form::checkbox('award', '1', $post->award ? true : false, ['disabled'=>true]);?>
                      <?php } ?>
                    奖励商品总价值<?php echo Config::get('percent');?>% = <?php echo $phase->cost * Config::get('percent') / 100; ?>
                    <img src="/assets/img/yinbi.png" />
              </p>
          </div>
        </div>
        <?php } ?>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">晒单奖励:</label>
          <div class="col-sm-1">
              <p class="form-control-static">
              <?php echo $post->post_point ? $post->post_point : Config::get('always'); ?>
              <img src="/assets/img/yinbi.png" />
              </p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">审核状态:</label>
          <div class="col-sm-8">
                <div class="row">
                    <select class="form-control" name="status"/>
                        <option value="1">通过</option>
                        <option value="2">驳回</option>
                    </select>
                </div>
                <div class="row">
                    <?php echo Form::textarea("reason", $post->reason, ['class'=>'form-control', 'placeholder'=>'不通过理由']);?>
                </div>
          </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-1">&nbsp;</label>
            <div class="col-sm-8">
                <button type="submit" class="btn btn-success">提交</button>
                <a href="<?php echo Uri::create('v2admin/posts');?>" class="btn btn-info return">返回</a>
            </div>
        </div>
    </fieldset>
<?php echo Form::close(); ?>

