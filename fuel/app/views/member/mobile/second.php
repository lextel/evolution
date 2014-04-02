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
    <form action="" class="verifyForm">
        <div class="row">
            <label for="" class="fl">您的手机号码：</label>
            <span class="phone_num"><?php echo $mobile?></span>
        </div>
        <div class="row">
            <input class="btn btn-code" type="button" value="获取验证码" />
            <span class="verification sure">验证码已发送请查收！</span>
        </div>
        <div class="row">
            <label for="" class="fl">输入验证码：</label><input type="text" class="txt fl"/>
            <span class="verification sure fl">手机号码格式为11位数字！</span>
        </div>
        <div class="row">
            <a href="" class="btn btn-red btn-sx">提交</a>
        </div>
    </form>
</div>
<script type="text/javascript">
$(function(){
    var tt = 50;
    var curCount = tt;
    var url = "<?php echo Uri::create('/u/mobile/getcode');?>";
    var img = '<img src="/assets/images/bx_loader.gif" style="width:30px" >';
    function countingDown(){
        if (curCount == 0) {                
            window.clearInterval(InterValObj);//停止计时器
            $('input[name=mobile]').removeAttr('readonly');
            $(".get_pwd").removeAttr("disabled");//启用按钮
            $(".get_pwd").html("重新获取密码");
        }
        else {
            curCount--;
            $(".get_pwd").html("请在" + curCount + "秒内输入密码");
        }
    }
    
    $(".get_pwd").click(function(){
        var mobile = $("input[name=mobile]").val();
        if (mobile == '' || mobile.length != 11){
            return;
        }
        $.ajax({
            url:url,
            type:"post",
		    dataType:"json",
		    data:{mobile:mobile},
		    beforeSend: function(){
			    //ShowLoading();			    
			    $('.get_pwd').html(img);
		    },
		    success: function(data){		        
			    if (data.code == 0){
			        $('.get_pwd').attr('disabled', 'disabled');
			        //$(".get_pwd").html('重新获取密码');
			        $('input[name=mobile]').attr('readonly', 'readonly');
			        $(".check_mobile").html(data.msg);
                    InterValObj = window.setInterval(countingDown, 1000);
                }else{
                    if (data.code == 2){
                       $('.get_pwd').attr('disabled', 'disabled');
                       $('input[name=mobile]').attr('readonly', 'readonly');
                       //$(".get_pwd").html("重新获取密码");
                       $(".check_mobile").html(data.msg);
                       InterValObj = window.setInterval(countingDown, 1000);
                    }else{
                       $(".check_mobile").html(data.msg);
                       $(".get_pwd").html("重新获取密码");
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
    $("form").submit(function(e){
        var mobile = $("input[name=mobile]").val();
        var code = $("input[name=password]").val();
        
        if (mobile == undefined || mobile == '' || mobile.length != 11){
            e.preventDefault();
            $(".check_mobile").html("手机号应该11位");
        }
        if (code == undefined || code == '' || code.length != 6){
            e.preventDefault();
            $(".check_pwd").html("密码应该6位");

        }
        
    });
});
</script>
