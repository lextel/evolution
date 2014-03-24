<?php echo Form::open(["class"=>"form-horizontal", 'action' => Uri::create('v2admin/shipping/save/'.$ship->id)]); ?>
    <fieldset>
        <div class="form-group">
          <?php echo Form::label('姓名:', 'name', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-2">
            <?php echo Form::input('name', Input::post('name', isset($address) ? $address->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'收货人姓名')); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo Form::label('地址:', 'address', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-6">
            <?php echo Form::input('address', Input::post('address', isset($address) ? implode(' ', unserialize($address->address)) : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'收货人地址')); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo Form::label('手机:', 'mobile', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-3">
            <?php echo Form::input('mobile', Input::post('mobile', isset($address) ? $address->mobile : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'收货人手机')); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo Form::label('邮编:', 'postcode', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-2">
            <?php echo Form::input('postcode', Input::post('postcode', isset($address) ? $address->postcode : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'收货人手机')); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo Form::label('快递公司:', 'exname', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-2">
            <?php Config::load('shipping');?>
            <?php echo Form::select('exname', Input::post('exname', isset($ship) ? $ship->exname : ''), Config::get('company'), ['class' => 'form-control']); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo Form::label('快递单号:', 'excode', array('class'=>'control-label col-sm-1')); ?>
          <div class="col-sm-2">
            <?php echo Form::input('excode', Input::post('excode', isset($ship) ? $ship->excode : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'快递单号')); ?>
          </div>
        </div>
        <div class="form-group">
            <label class='control-label col-sm-1'>&nbsp;</label>
            <div class="col-sm-4">
            <?php echo Form::submit('submit', '发货', array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
    </fieldset>
<?php echo Form::close(); ?>
