<div class="w">
<?php echo Asset::css(['style.css']);?>
<!--中间内容开始-->
    <div class="register-warp">
            <div class="title">
                <h3 class="fl">验证邮件已经发送。</h3>
            </div>
            <form class="demoform">            
                <ul class="registerForm">
                    <li>
                       <p>乐乐淘已向你的邮箱发送了一封验证邮箱的邮件,请尽快完成验证</p>
                    </li>
                    <li>
                       <a class="btn btn-red btn-mx" href="<?php echo \Classes\Email::toemail($email) ? 'http://'.\Classes\Email::toemail($email) : '';?>">登录邮箱完成验证</a>
                    </li>
                </ul>
            </form>
            <div class="help-tool">
                 <p style="font-weight: bold">没有收到验证邮件？</p>
                 <p>1.查看邮箱的垃圾邮箱或广告箱，邮件有可能被误认为垃圾邮件。</p>
                 <p>2.如果在10分钟后仍未收到验证邮件，请点击<a class="btn btn-mx btn-gy" href="<?php echo Uri::create('/u/getprofile');?>">重新发送</a></p>
             </div>
    </div>
<!--中间内容结束-->
</div>
