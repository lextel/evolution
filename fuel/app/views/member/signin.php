

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
        广告图
    </div>
    <div class="loginForm fr">
        <form action="/signin" method="post" class="demoform">
            <div class="title">
                <h3>乐拍用户登录</h3>
            </div>
            <ul class="loginBar">
                <li>
                   <?php echo Form::input('username', Session::get_flash('username', ''), array('type'=>"text",'name'=>'username',
                      'datatype'=>'e','errorms'=>'请输入邮箱帐号','placeholder'=>'输入邮箱帐号')); ?>
                   <?php if (Session::get_flash('signError', null)) { ?>
                   <span class="Validform_checktip Validform_wrong"><?php echo Session::get_flash('signError');?></span>
                   <?php }else{?>
                   <?php } ?>
                   <s class="icon-user"></s>
                   <span class="Validform_checktip"></span>
                </li>
                <li><?php echo Form::input('password','',  array('type'=>"password", 'placeholder'=>'输入密码',
                    'name'=>'userpassword','datatype'=>'*6-18','errormsg'=>'密码范围在6~18位之间！' )); ?>
                   <s class="icon-password"></s>
                   <span class="Validform_checktip"></span>
                </li>
                <li><?php echo Html::anchor('forgot', '忘记密码?', array('class' => 'fr'));?></li>
                <li><button class="login btn-l" type="submit">登录</button></li>
            </ul>
        </form>
        <div class="register-box">
            <p>还不是乐拍用户？马上注册吧</p>
            <?php echo Html::anchor('signup', '快速注册', array('class'=>'btn-r signup'));?>
        </div>
    </div>
    </div>
</div>
<!--中间内容结束-->
<!--底部开始-->
<div class="footer-wrapper">
        <div class="footer w">
            <ul class="bottom-nav">
                <li><a href="http://www.llt.com/">首页</a></li>
                <li><a href="http://www.llt.com/h/about">关于乐拍</a></li>
                <li><a href="http://www.llt.com/h/privacy">隐私声明</a></li>
                <li><a href="javascript:void(0);">合作专区</a></li>
                <li class="lastest"><a href="javascript:void(0);">联系我们</a></li>
            </ul>
            <p>版权所有</p>
            <div class="log">乐拍，快乐抢拍你的人生！</div>
             <ul class="safety">
                <li class="safety-01"></li>
                <li class="safety-02"></li>
                <li class="safety-03"></li>
              </ul>
        </div>
    </div>
<!--底部结束-->
<script type="text/javascript">

$(function(){
        $(".demoform").Validform({
        tiptype:4,
        });
});
</script>
</body>
</html>
