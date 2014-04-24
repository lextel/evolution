<?php echo Asset::js(['jquery.validate.js','additional-methods.min.js']); ?>
<!--右左边内容结束-->
<div class="verify-wrap">
    <div class="tit-bar">
        <h4>手机验证</h4>
         <?php echo Html::anchor('u/mobile/first', '<< 返回', ['class'=>'more fr']);?>
    </div>
    <div class="prompt-bar">
        <s class="icon-plaint"></s>
        请完成手机验证，验证手机不仅能加强账户安全，快速找回密码，还会在您成功乐淘到商品后及时通知您！
    </div>
    <?php echo Form::open(['action'=>'u/mobile/check', 'class'=>"verifyForm"]);?>
        
        <div class="row" style="margin-bottom:5px;">
            <label for="" class="fl" style="width:110px">您的手机号码：</label>
            <span class="phone_num"><?php echo $mobile?><input type="hidden" name="mobile" value="<?php echo $mobile;?>"></span>
        </div>
        <div class="row">
            <input class="btn btn-code get_code fl" type="button" style="margin-left:110px" value="获取验证码" />
            <span id="errorinfo" class="fl"></span>
        </div>
        <div class="row">
            <label for="" class="fl" style="width:110px">输入验证码：</label><input name="code" class="txt fl"/>
        </div>
        <div class="row">
            <button class="btn btn-red btn-sx btn-submit" id="submitID" style="margin-left:110px">提交</button>
            <button class="btn btn-sx btn-gr btn-chance" id="chance" style="margin-left:10px;">返回</button>
        </div>
        <div class="row">
            <label></label>
            <span class="r"><?php echo Session::get_flash('login_error') ? Session::get_flash('login_error'): '';?></span>
        </div>
    <?php echo Form::close();?>
</div>
<script type="text/javascript">
$(function(){

    var tt = 100;
    var curCount = tt;
    var url = "<?php echo Uri::create('/u/mobile/getcode');?>";
    var img = '<img src="<?php echo Uri::create('assets/images/bx_loader.gif')?>" style="width:30px;margin-bottom: -10px;" >';
    function countingDown(){
        if (curCount == 0) {                
            window.clearInterval(InterValObj);//停止计时器
            $(".get_code").removeAttr("disabled");//启用按钮
            $(".get_code").val("重新获取密码");
            $("#errorinfo").html('');
        }
        else {
            curCount--;
            $("#errorinfo").html("请在" + curCount + "秒内输入密码");
        }
    }
    //$(".btn-submit").click(function(){
        //$(".verifyForm").submit();
    //});
    
    //$(".Validform_checktip").css('overflow', 'visible');
    
    $(".get_code").click(function(){
        $.ajax({
            url:url,
            type:"post",
            data:{mobile:'<?php echo $mobile;?>'},
		    dataType:"json",
		    beforeSend: function(){
			    //ShowLoading();			    
			    $('#errorinfo').html(img);
		    },
		    success: function(data){		        
			    if (data.code == 0){
			        $('.get_code').attr('disabled', 'disabled');
			        //$(".get_pwd").html('重新获取密码');
			        $("#errorinfo").html(data.msg);
                    InterValObj = window.setInterval(countingDown, 1000);
                }else{
                    if (data.code == 2){
                       $('.get_code').attr('disabled', 'disabled');
                       //$(".get_pwd").html("重新获取密码");
                       $("#errorinfo").html(data.msg);
                       curCount = 100;
                       InterValObj = window.setInterval(countingDown, 1000);
                    }else{
                       $("#errorinfo").html(data.msg);
                       $(".get_code").val("重新获取密码");
                    }
                }
		    },
		    complete: function(data){
			    //HideLoading();
		    },
		    error: function(data){
			    //请求出错处理
			    $(".server_error").html('服务器或者网络异常');
		    }
        });
    });

    $(".verifyForm").validate({
        submitHandler:function(form){
            $(form).ajaxSubmit();
        },
        rules:{
            code:{
                required:true,
                rangelength:[6,6]
            }
        },
        messages:{
            code:{
                required:"请输入验证码",  
                rangelength:"请输入6位验证码"
            }
        },
        errorPlacement: function(error, element) {
            error.css({"display":"inline-block","text-align":"left"});
            error.appendTo(element.parent());
        }
    });
    
    $(".btn-chance").click(function(){
        window.history.back();
    });
});
</script>
