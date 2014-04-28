<div class="w">
    <?php echo Asset::css(['style.css']);?>
    <?php echo Asset::js(['jquery.validate.js','additional-methods.min.js']); ?>
    <div class="register-warp">
        <div class="title">
            忘记密码？不用急，您可以通过以下方式找回密码。
        </div>
         
         <?php echo Form::open(['action'=>'forgotemail','class'=> 'forgotemailform']);?>
            <ul class="registerForm" style="width:700px">
                <li>
                    <label style="text-align:right">邮箱:</label>
                    <input class="txt" name="email" id="form_password">
                    <?php if (Session::get_flash('erroremail')) { ?>
                    <label for="form_password" class="error"><?php echo '<font >'.Session::get_flash('erroremail').'</font>';?></label>
                    <?php } ?>
                </li>
                <li>
                    <input class="btn btn-red btn-md" style="margin-left:200px;" name="submit" value="提交" type="submit" id="form_submit">
                </li>
            </ul>
        <?php echo Form::close();?>
        <div class="help-tool">
            <p style="font-weight: bold">没有收到验证邮件？</p>
            <p>1.您若忘记注册时所用的手机号或邮箱建议您重新注册账号， <?php echo Html::anchor('signup', '立即注册', ['class'=>'b']);?></p>
            <p>2.若有任何疑问或需要帮助请您进入帮助中心,也可以点击在线客服进行咨询或拨打服务热线 <span class="r">400 685 9800</span></p>
        </div>
    </div>
</div>
<script>
$(function (){
    $(".forgotemailform").validate({
        rules:{
            email:{
                required:true,
                email:true
            }
        },
        messages:{
            email:{
                required:"请输入邮箱",
                email:"请输入正确的邮箱"
            }
        }
    });
})
</script>
