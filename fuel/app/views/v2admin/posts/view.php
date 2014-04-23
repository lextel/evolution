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
                        <?php echo Html::img($image, ['style'=>"margin: 10px; border: 1px #ccc solid; padding:3px;width:80px"]);?>
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
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">爆照奖:</label>
          <div class="col-sm-8">
              <div class="checkbox">
                <label>
                  <?php Config::load('post');?>
                  <?php echo Form::checkbox('award', '1', $post->award ? true : false);?>
                  奖励商品总价值<?php echo Config::get('percent');?>%
                </label>
              </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">晒单奖励:</label>
          <div class="col-sm-8">
              <?php echo Form::input('post_point');?>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="form_title">审核状态:</label>
          <div class="col-sm-8">
                <div class="row">
                    <select class="form-control col-sm-5" name="status"/>
                        <option value="1">通过</option>
                        <option value="2">驳回</option>
                    </select>
                </div>
                <div class="row">
                    <textarea class="form-control" placeholder='不通过理由' name="reason"></textarea>
                </div>
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
