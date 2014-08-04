<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户登录</title>
    <?php echo Asset::css('common.css');?>
    <?php echo Asset::css('style.css');?>
    <?php echo Asset::js('jquery.min.js');?>
    <?php echo Asset::js(['jquery.validate.js','additional-methods.min.js']); ?>
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
        <!--<a href=""><img src="../assets/images/loginbanner01.jpg" alt=""/></a>-->
        <?php echo Html::anchor('/invit', Html::img('/assets/images/loginbanner01.jpg'));?>
    </div>
    <div class="loginForm fr">
        <form action="/signin" method="post" class="signinform">
            <div class="title">
                <h3>乐淘用户登录</h3>
            </div>
            <ul class="loginBar">
                <li>
                    <div class="item">
                        <?php echo Form::input('username', Session::get_flash('username', '') ? Session::get_flash('username', '') : Input::get('username'), array('type'=>"text",'name'=>'username','placeholder'=>'请输入手机/邮箱')); ?>
                         <s class="icon-user"></s>
                        <?php if (Session::get_flash('signError', null)) { ?>
                        <label for="form_username" class="error" style="display:inline-block;line-height:29px"><?php echo Session::get_flash('signError');?></label>
                        <?php }else{?>
                        <?php } ?>
                   </div>
                </li>
                <li>
                <div class="item">
                <?php echo Form::input('password','',  array('type'=>"password", 'placeholder'=>'请输入账号密码',
                    'name'=>'userpassword')); ?>
                   <s class="icon-password"></s>
                   <!--<span class="Validform_checktip"></span>-->
                </li>
                <li>
                <div style="margin-left:26%;clear:both;zoom:1;">
                    <button class="login btn-l" style="float: left;" type="submit">登录</button><?php echo Html::anchor('forgot', '忘记密码?', array('class' => '' ,'style'=>'margin:2px 0px 0px 10px'));?>
                </div>
                </li>
            </ul>
        </form>
        <div class="register-box" style="text-align:center">
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
            <div class="slogan"><img src="assets/images/slogan.png"></div>
        </div>
    </div>
<!--底部结束-->
<script type="text/javascript">
$(function(){

    jQuery.validator.addMethod("codemobile", function(value,element) {
      var code = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
      var mobile = /^1[3,4,5,8][0-9]{9}$/
      if(code.test(value) || mobile.test(value))
        return true;
      return false;
    },"error zhanghao");

    $(".signinform").validate({
        rules:{
            username:{
                required:true,
                codemobile:true
            },
            password:{
                required:true
            }
        },
        messages:{
            username:{
                required:"请输入注册手机/邮箱",
                codemobile:"手机/邮箱格式不正确"
            },
            password:{
                required:"请输入密码"
            }
        },
        errorPlacement: function(error, element) {
            error.css({"display":"inline-block","line-height":"29px"});
            error.appendTo(element.parent());
        }
    });
});
</script>
</body>
</html>
