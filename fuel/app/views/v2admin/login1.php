<div class="row">
    <div class="col-md-3">
        <?php echo Form::open(array('')); ?>                  
            <div class="form-group <?php echo ! $val->error('email') ?: 'has-error' ?>">
                <span class="control-label server_error"></span>
                <label for="email">手机号:</label>
                <?php echo Form::input('mobile', Input::post('mobile'), array('class' => 'form-control', 'placeholder' => '手机号', 'autofocus')); ?>         
                <span class="control-label check_mobile" style="color:#f00;"><?php echo $val->error('mobile') ? $val->error('mobile')->get_message('请输入手机号'): ''; ?></span>
                <?php if (isset($login_error)): ?>
                <div class="error" style="color:#f00;"><?php echo $login_error; ?></div>
                <?php endif; ?>
                <p></p>
                <span class="btn btn-info get_pwd">获取密码</span>
            </div>

            <div class="form-group <?php echo ! $val->error('password') ?: 'has-error' ?>">
                <label for="password">密码:</label>
                <?php echo Form::password('password', '', array('class' => 'form-control', 'placeholder' => '密码(长度为6位)')); ?>

                    <span class="control-label check_pwd" style="color:#f00;"><?php echo $val->error('password') ? $val->error('password')->get_message('请输入密码'): ''; ?></span>
            </div>
            <div class="actions">
                <?php echo Form::submit(array('value'=>'登陆', 'name'=>'submit', 'class' => 'btn btn-lg btn-primary btn-block')); ?>
            </div>

        <?php echo Form::close(); ?>
    </div>
</div>
<script type="text/javascript">
$(function(){
    var tt = 50;
    var curCount = tt;
    var url = "<?php echo Uri::create('/v2admin/sendpwd');?>";
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
