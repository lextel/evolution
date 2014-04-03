<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户登录</title>
    <?php echo Asset::css('common.css');?>
    <?php echo Asset::css('style.css');?>
    <?php echo Asset::js('jquery.min.js');?>
    <?php echo Asset::css('member/validfrom_style.css'); ?>
    <?php echo Asset::js('Validform_v5.3.2_min.js'); ?>
</head>
<body>
<div class="logo-wrapper">
    <div class="logo w">
        <a href="/"><img src="/assets/images/logo.png" alt="乐乐淘首页"></a>
    </div>
</div>
<!--中间内容开始-->
<div class="w">
    <div class="login-hd">
        <a href="/" class="b fr">返回首页</a>
        <span class="fr">|</span>
        <a href="/h" class="b fr">帮助中心</a>
    </div>
    <div class="login-bd">
    <div class="left-side fl">
        <a href=""><img src="../assets/images/loginbanner01.jpg" alt=""/></a>
    </div>
    <div class="loginForm fr">
        <form action="/signin" method="post" class="demoform">
            <div class="title">
                <h3>乐淘用户登录</h3>
            </div>
            <ul class="loginBar">
                <li>
                    <div class="item">
                        <?php echo Form::input('username', Session::get_flash('username', ''), array('type'=>"text",'name'=>'username',
                         'datatype'=>'em','errorms'=>'手机/邮箱格式不正确！','nullmsg'=>'请输入注册手机/邮箱！','placeholder'=>'请输入手机/邮箱','sucmsg'=>' ' )); ?>

                        <?php if (Session::get_flash('signError', null)) { ?>
                        <span class="Validform_checktip"><?php echo Session::get_flash('signError');?></span>
                        <?php }else{?>
                        <?php } ?>
                        <s class="icon-user"></s>
                        <!--<span class="Validform_checktip"></span>-->
                   </div>
                </li>
                <li>
                <div class="item">
                <?php echo Form::input('password','',  array('type'=>"password", 'placeholder'=>'账号密码',
                    'name'=>'userpassword','datatype'=>'*6-18','errormsg'=>'密码为6~18位数！','nullmsg'=>'请输入密码!','sucmsg'=>' ')); ?>
                   <s class="icon-password"></s>
                   <!--<span class="Validform_checktip"></span>-->
                </li>
                <li><?php echo Html::anchor('forgot', '忘记密码?', array('class' => 'fr'));?></li>
                <li><button class="login btn-l" type="submit">登录</button></li>
            </ul>
        </form>
        <div class="register-box">
            <p>还不是乐淘用户？马上注册吧</p>
            <?php echo Html::anchor('signup', '快速注册', array('class'=>'btn-r signup'));?>
        </div>
    </div>
    </div>
</div>
<!--中间内容结束-->
<!--底部开始-->
<div class="footerWrap">
        <div class="footer w">
            <ul class="bottom-nav">
                <li><a href="<?php echo Uri::create('/');?>">首页</a></li>
                <li>|</li>
                <li><a href="<?php echo Uri::create('h/about');?>">关于乐淘</a></li>
                <li>|</li>
                <li><a href="<?php echo Uri::create('/h/privacy');?>">隐私声明</a></li>
                <li>|</li>
                <li><a href="javascript:void(0);">合作专区</a></li>
                <li>|</li>
                <li class="lastest"><a href="javascript:void(0);">联系我们</a></li>
            </ul>
            <p style="color:#5b5b5b">Copyright © 2014 粤ICP备14017463号-1 <a href="www.lltao.com">www.lltao.com</a> 版权所有</p>
            <div class="log">乐淘，快乐抢拍你的人生！</div>
        </div>
    </div>
<!--底部结束-->
<script type="text/javascript">
$(function(){
        $(".demoform").Validform({
        tiptype:4,
        datatype:{
              'em': function (gets,obj,curform,regxp){
                var m = /^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/;
                var e = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
                if(m.test(gets) || e.test(gets)){
                   return true;
                }
                return "手机/邮箱格式不正确";
              }
            }
        });
});
</script>
</body>
</html>
