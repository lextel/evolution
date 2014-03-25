<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>邮件发送成功</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <?php echo Asset::css('/member/bootstrap.min.css');?>
    <?php echo Asset::css('member/comme.css');?>
    <?php echo Asset::css('member/font-awesome.min.css');?>
    <?php echo Asset::js(array('jquery.min.js', 'bootstrap.min.js', 'common.js', 'holder.js'));?>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
    <script type="text/javascript">

    </script>
</head>
<body>
<!--导航开始-->
<!--导航结束-->
<!--中间内容开始-->
<div class="register-warp">
        <div class="title">
            <h3 class="fl">忘记密码？不用急，您可以通过一下方式找回密码。</h3>
        </div>
        <form class="demoform" action="http://www.llt.com/signup" accept-charset="utf-8" method="post">            <ul class="registerForm">
                <li>
                   <label>乐乐淘易向你的邮箱发送了一封找回密码的邮件,请尽快完成验证</label>
                </li>
                <li>
                   <a class="btn btn-red btn-mx" href="<?php echo \Classes\Email::toemail($email) ? 'http://'.\Classes\Email::toemail($email) : '';?>">登录邮箱完成验证</a>
                </li>
            </ul>
        </form>
        <div class="help-tool">
             <p style="font-weight: bold">没有收到验证邮件？</p>
             <p>1.查看邮箱的垃圾邮箱或广告箱，邮件有可能被误认为垃圾邮件。</p>
             <p>2.如果在10分钟后仍未收到验证邮件，请点击<a class="btn btn-mx btn-gy" href="http://www.llt.com/signup">重新发送</a></p>
         </div>
    </div>
<!--中间内容结束-->
</body>
</html>
