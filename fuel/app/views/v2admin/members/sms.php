<?php
echo Asset::css(
    [
        'admin/items/form.css', 
        ]
    );
?>

<?php echo Form::open(array("class"=>"form-horizontal", 'action' => Uri::create('v2admin/members/sms/'.$member->id))); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('用户ID', 'id', ['class'=>'control-label col-sm-2']); ?>
            <div class="col-sm-4">
                # <?php echo $member->id;?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('用户名', 'name', ['class'=>'control-label col-sm-2']); ?>
            <div class="col-sm-4">
                <?php echo $member->nickname;?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('消息', 'sms', ['class'=>'control-label col-sm-2']); ?>
            <div class="col-sm-4">
                <?php echo Form::textarea('sms', '', ['class' => 'form-control', 'placeholder'=>'站内消息，长度不大于255字', 'rows'=>10]); ?>
                
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">&nbsp;</label>
            <div class="col-sm-2">
            <?php echo Form::submit('submit', '保存', ['class' => 'btn btn-primary']); ?>        
            <?php echo Html::anchor('/v2admin/members', '返回', ['class' => 'btn btn-default']); ?>
            </div>
        </div>
    </fieldset>
<?php echo Form::close(); ?>
