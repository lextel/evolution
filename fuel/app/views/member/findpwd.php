<div class="w">
<?php echo Asset::css(['style.css']);?>
<?php echo Asset::js(['jquery.validate.js','additional-methods.min.js']); ?>
<!--中间内容开始-->
    
    <div class="register-warp">
        <div class="title">
            设置新密码
        </div>
        <?php echo Form::open(['action'=>'newpwd','class'=>'newpasswordform']);?>
        <ul class="registerForm">
            <li>
                <label></label>
                <span class="r"><?php echo Session::get_flash('newpwderror');?></span>
            </li>
            <li>
                <label>输入密码:</label>
                <input type="password" class="txt" name="newpassword" id="form_password">
            </li>
            <li>
                <label>确认密码:</label>
                <input type="password" value="" name="newpassword1" class="txt"/>
            </li>
            <li>
                <input class="btn btn-red btn-md" name="submit" value="确认" type="submit" id="form_submit">
            </li>
        </ul>
        <?php echo Form::close();?>
    </div>
<!--中间内容结束-->
</div>
<script type="text/javascript">
$(function (){
    $(".newpasswordform").validate({
        rules:{
            newpassword:{
                required:true,
                rangelength:[6,18]
            },
            newpassword1:{
                required:true,
                equalTo:"#form_password"
            }
        },
        messages:{
            newpassword:{
                required:"请输入密码",
                rangelength:"请输入6-18位密码"
            },
            newpassword1:{
                required:"请输入确认密码",
                equalTo:"两次密码输入不一致"
            }
        }
    });
})
</script>