<div class="w">
<?php echo Asset::css(['style.css']);?>
<!--中间内容开始-->
    
    <div class="register-warp">
        <div class="title">
            设置新密码
        </div>
        <?php echo Form::open(['action'=>'newpwd','class'=>'demoform']);?>
        <ul class="registerForm">
            <li>
                <label></label>
                <span class="r"><?php echo Session::get_flash('newpwderror');?></span>
            </li>
            <li>
                <label>输入密码:</label>
                <input type="password" class="txt" name="newpassword" datatype="*6-18" errorms="请输入6-18位密码" nullmsg="请输入6-18位密码" value="" id="form_password">
            </li>
            <li>
                <label>确认密码:</label>
                <input type="password" value="" name="newpassword1" class="txt" datatype="*6-18" recheck="password" nullmsg="请填写信息！">
            </li>
            <li>
                <input class="btn btn-red btn-md" name="submit" value="确认" type="submit" id="form_submit">
            </li>
        </ul>
        <?php echo Form::close();?>
    </div>
<!--中间内容结束-->
</div>
