<?php
echo Asset::css(
    [
        'admin/items/form.css', 
        ]
    );
?>

<?php echo Form::open(array("class"=>"form-horizontal", 'action' => '')); ?>
    <fieldset>
        
        <div class="form-group">
            <?php echo Form::label('游戏名称', 'name', ['class'=>'control-label col-sm-2']); ?>
            <div class="col-sm-4">
                <?php echo Form::input('name', '', ['class' => 'form-control', 'placeholder'=>'游戏名称']); ?>
                
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">&nbsp;</label>
            <div class="col-sm-2">
            <?php echo Form::submit('submit', '保存', ['class' => 'btn btn-primary']); ?>        
            <?php echo Html::anchor('/v2admin/giftgame', '返回', ['class' => 'btn btn-default']); ?>
            </div>
        </div>
    </fieldset>
<?php echo Form::close(); ?>
<script>

$(function() {

    // 开始结束时间
    var dates = $("#end");
    dates.datepicker({
        dateFormat: "yy-mm-dd",
        minDate: new Date(),
        onSelect: function(selectedDate){
           var option = this.id == "start" ? "minDate" : "maxDate";
           dates.not(this).datepicker("option", option, selectedDate);
        }
    });
});
</script>
