<?php echo Asset::js(['jquery.validate.js','additional-methods.min.js']); ?>
<!--右左边内容结束-->
<div class="verify-wrap">
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

            <?php echo Form::input('mobile', $user->is_mobile == '1' ? '' : $user->mobile, array('class' => 'txt fl', 'placeholder' => '手机号', 'autofocus'));?>
             
            <!--<span class="verification sure fl">手机号码格式为11位数字！</span>-->
        </div>
        <div class="row">
            <!--a href="javascript:void(0)" class="btn btn-red btn-sx mobile-next">下一步</a-->
            <button class="btn btn-red btn-sx mobile-next" type="submit">下一步</button>
        </div>
    <?php echo Form::close();?>
</div>
<script type="text/javascript">
$(function(){

    jQuery.validator.addMethod("call", function(value,element) {
      var call = /^1[3,4,5,7,8][0-9]{9}$/;
      if(call.test(value))
        return true;
      return false;
    },"error call");

    $(".verifyForm").validate({
        submitHandler:function(form){
            var mobile = $("input[name=mobile]").val();
            var url = "<?php echo Uri::create('u/mobile/second');?>";
            url += "/" + mobile;
            window.location.href = url;
            //$(form).ajaxSubmit();
        },
        rules:{
            mobile:{
                required:true,
                call:true
            }
        },
        messages:{
            mobile:{
                required:"请输入11位手机号",
                call:"请输入正确的手机号"
            }
        },
        errorPlacement: function(error, element) {
            error.css({"display":"inline-block","text-align":"left"});
            error.appendTo(element.parent());
        }
    });
});
</script>
