<!--右左边内容结束-->
<div class="varify-wrap">
    <div class="tit-bar">
        <h4>手机验证</h4>
        <?php echo Html::anchor('u/profile', '<< 返回', ['class'=>'more fr']);?>
    </div>
    <div class="prompt-bar">
        <s class="icon-plaint"></s>
        请完成手机验证，验证手机不仅能加强账户安全，快速找回密码，还会在您成功云购到商品后及时通知您！
    </div>
    <?php echo Form::open(['action'=>'', 'class'=>'verifyForm']); ?>
        <div class="row">
            <label for="" class="fl">输入手机号码：</label>
            <?php echo Form::input('mobile', '', array('class' => 'txt fl', 'placeholder' => '手机号', 'autofocus'));?>
            <span class="verification sure fl">手机号码格式为11位数字！</span>
        </div>
        <div class="row">
            <a href="javascript:void(0)" class="btn btn-red btn-sx mobile-next">下一步</a>
        </div>
    </form>
    <?php echo Form::close();?>
</div>
<script type="text/javascript">
$(function(){
    var url = "<?php echo Uri::create('u/mobile/second');?>";
    $(".mobile-next").click(function(){
        var mobile = $("input[name=mobile]").val();
        if (mobile.length == 11){
            url += "/" + mobile;
            alert(url);
            window.location.href = url;
        }
    });
});
</script>
