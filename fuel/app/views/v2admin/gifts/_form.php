<?php
echo Asset::css(
    [
        'jquery.fileupload.css', 
        'admin/items/form.css', 
        'member/jquery-ui.css',
        ]
    );
echo Asset::js(
        [
            'jquery.validate.js', 
            'additional-methods.min.js',
            'jquery.ui.widget.js',
            'jquery.iframe-transport.js',
            'jquery.fileupload.js',
            'jquery-ui.js',
            'admin/ads/form.js', 
            ]
        ); 
?>

<?php echo Form::open(array("class"=>"form-horizontal", 'action' => '')); ?>
    <fieldset>
        
        <div class="form-group">
            <?php echo Form::label('游戏名称', 'game_ID', array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-4">
                <?php echo Form::select('game_ID', '', $games , array('class' => 'form-control', 'placeholder'=>'游戏名称')); ?>
                
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('游戏码', 'codes', array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-4">
            <?php echo Form::textarea('codes', '', ['class' => 'form-control', 'placeholder'=>'游戏码', 'rows'=>10]); ?>
            </div>
        </div>
        <!--div class="form-group">
            <?php echo Form::label('游戏码过期日期', 'end_time', array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-2 input-group">

                <?php echo Form::input('end_time', '', ['class' => 'form-control', 'placeholder'=>'游戏码过期日期', 'id' => 'end']); ?>
            </div>
            
        </div-->
        <div class="form-group">
            <label class="control-label col-sm-2">&nbsp;</label>
            <div class="col-sm-2">
            <?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>        
            <?php echo Html::anchor('/v2admin/gift', '返回', array('class' => 'btn btn-default')); ?></div>
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
