<!--右左边内容结束-->
<div class="verify-wrap">
    <div class="tit-bar">
        <h4>手机验证</h4>
         <?php echo Html::anchor('u/mobile/first', '<< 返回', ['class'=>'more fr']);?>
    </div>
    <div class="prompt-bar">
        <s class="icon-plaint"></s>
        请完成手机验证，验证手机不仅能加强账户安全，快速找回密码，还会在您成功云购到商品后及时通知您！
    </div>
    <?php echo Form::open(['action'=>'u/mobile/check', 'class'=>"verifyForm"]);?>
        <div class="row">
            <label for="" class="fl">您的手机号码：</label>
            <span class="phone_num"><?php echo $mobile?><input type="hidden" name="mobile" value="<?php echo $mobile;?>"></span>
        </div>
        <div class="row">
            <input class="btn btn-code get_code" type="button" value="获取验证码" />
            <span class="verification"></span>
        </div>
        <div class="row">
            <label for="" class="fl">输入验证码：</label><input name="code" class="txt fl" datatype="s6-6" nullmsg="请输入6位验证码" errormsg="请输入正确的验证码" sucmsg=" "/>
            <span class="Validform_checktip"></span>
        </div>
        <div class="row">
            <a href="javascript:;" class="btn btn-red btn-sx" id="submitID">提交</a>
        </div>
    <?php echo Form::close();?>
</div>
<script type="text/javascript">
$(function(){

    var tt = 100;
    var curCount = tt;
    var url = "<?php echo Uri::create('/u/mobile/getcode');?>";
    var img = '<img src="<?php echo Uri::create('assets/images/bx_loader.gif')?>" style="width:30px" >';
    function countingDown(){
        if (curCount == 0) {                
            window.clearInterval(InterValObj);//停止计时器
            $(".get_code").removeAttr("disabled");//启用按钮
            $(".get_code").val("重新获取密码");
            $(".verification").html('');
        }
        else {
            curCount--;
            $(".verification").html("请在" + curCount + "秒内输入密码");
        }
    }
    $(".btn-sx").click(function(){
        $(".verifyForm").submit();
    });
    
    
    $(".get_code").click(function(){
        $.ajax({
            url:url,
            type:"post",
            data:{mobile:'<?php echo $mobile;?>'},
		    dataType:"json",
		    beforeSend: function(){
			    //ShowLoading();			    
			    $('.verification').html(img);
		    },
		    success: function(data){		        
			    if (data.code == 0){
			        $('.get_code').attr('disabled', 'disabled');
			        //$(".get_pwd").html('重新获取密码');
			        $(".verification").html(data.msg);
                    InterValObj = window.setInterval(countingDown, 1000);
                }else{
                    if (data.code == 2){
                       $('.get_code').attr('disabled', 'disabled');
                       //$(".get_pwd").html("重新获取密码");
                       $(".verification").html(data.msg);
                       InterValObj = window.setInterval(countingDown, 1000);
                    }else{
                       $(".verification").html(data.msg);
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

    $(".verifyForm").Validform({
        btnSubmit:"#submitID", 
        tiptype:4
    });
});
</script>
