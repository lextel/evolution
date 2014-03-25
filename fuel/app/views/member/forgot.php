<div class="w">

    <?php echo Asset::css(['style.css', 'member/validfrom_style.css']);?>
    <?php echo Asset::js('Validform_v5.3.2_min.js');?>
    <div class="register w">
        <div class="title">
            忘记密码？不用急，您可以通过以下方式找回密码。
        </div>
         <?php echo Session::get_flash('error');?>
         <?php echo Form::open(['action'=>'forgotemail','class'=>'register-form demoform']);?>
            <ul>
                <li>
                    <label>邮箱:</label>
                    <input type="text" class="inputxt Validform_error" name="email" datatype="e" errorms="请输入6-18位密码" nullmsg="请输入6-18位密码" value="" id="form_password">
                    <span class="Validform_checktip Validform_wrong">请输入6-18位密码</span>
                </li>
                <li>
                    <input class="btn btn-red" name="submit" value="提交" type="submit" id="form_submit">
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
