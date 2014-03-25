<ul class="nav nav-tabs">
  <li class="active"><a href="#info" data-toggle="tab">发货信息</a></li>
  <li><a href="#desc" data-toggle="tab">中奖信息</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="info">
    <?php echo Form::open(["class"=>"form-horizontal"]); ?>
        <fieldset>
            <div class="form-group">
              <?php echo Form::label('姓名:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo $ship->name ? $ship->name : '无'; ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('地址:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo $ship->address ? $ship->address : '无'; ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('手机:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo $ship->mobile ? $ship->mobile : '无'; ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('邮编:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo $ship->postcode ? $ship->postcode : '无'; ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('快递公司:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo $ship->exname ? $ship->exname : '无'; ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('快递单号:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo $ship->excode ? $ship->excode : '无'; ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('货物详情:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <ul class="form-control-static">
                    <?php 
                        if($ship->exdesc){
                            $desc = json_decode(html_entity_decode($ship->exdesc),true);
                            foreach($desc as $data) {
                                echo '<li>'.$data['context']. '<span style="margin-left: 10px">'.$data['time']. '</span></li>';
                            }
                        }else{
                            echo '<li>还没有物流信息</li>';
                        }
                    ?>
                 </ul>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('状态:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <?php 
                    Config::load('shipping');
                    $status = Config::get('status');
                ?>
                <p class="form-control-static"><?php echo $status[$ship->status]; ?></p>
              </div>
            </div>
        </fieldset>
    <?php echo Form::close(); ?>
    </div>
    <div class="tab-pane" id="desc">
    <?php echo Form::open(["class"=>"form-horizontal"]); ?>
        <fieldset>
            <div class="form-group">
              <?php echo Form::label('会员:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo $member->nickname; ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('商品:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><a href="<?php echo Uri::create('w/'.$item->phase_id); ?>" target="_blank"><?php echo sprintf('(第%d期)%s', $item->phase_id, $item->title); ?></a></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('幸运码:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo $item->code ? $item->code : '无'; ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('购买人次:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo $item->code_count.'次'; ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('下单时间:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo date('Y-m-d H:i:s', $item->order_created_at); ?></p>
              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('揭晓时间:', 'title', array('class'=>'control-label col-sm-1')); ?>
              <div class="col-sm-8">
                <p class="form-control-static"><?php echo date('Y-m-d H:i:s', $item->opentime); ?></p>
              </div>
            </div>
        </fieldset>
    <?php echo Form::close(); ?>
    </div>
</div>
