

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
    <div class="login-form fr">
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
                   <span class="Validform_checktip"></span>
                   <s class="icon-user"></s>
                   <?php } ?>
                </li>
                <li><?php echo Form::input('password','',  array('type'=>"password", 'placeholder'=>'输入密码',
                    'name'=>'userpassword','datatype'=>'*6-18','errormsg'=>'密码范围在6~18位之间！' )); ?>
                   <span class="Validform_checktip"></span>
                   <s class="icon-password"></s>
                </li>
                <li>
                    <?php echo Html::anchor('forgot', '忘记密码?', array('class' => 'fr'));?>
                </li>
            </ul>
            <div class="btn-group">
                <button class="login btn-l" type="submit">登录</button>
            </div>
        </form>
        <div class="register-box">
            <p>还不是乐拍用户？马上注册吧</p>
            <div class="btn-group">
                 <?php echo Html::anchor('signup', '快速注册', array('class'=>'btn-r signup'));?>
            </div>
        </div>
    </div>
    </div>
</div>
<!--中间内容结束-->
<!--底部开始-->
<div class="footer-wrapper">
    <div class="help-bg">
        <div class="footer-help w">
            <dl>
                <dt><a href="">帮助中心</a></dt>
                <dd><a href="">新手指南</a></dd>
                <dd><a href="">乐拍保障</a></dd>
                <dd><a href="">商品配送</a></dd>
            </dl>
            <dl>
                <dt><a href="">关注我们</a></dt>
                <dd><a href="">新浪微博</a></dd>
                <dd><a href="">官方微信</a></dd>
                <dd><a href="">官方QQ群：10000000</a></dd>
                <dd><a href="">官方QQ群:100000000</a></dd>
            </dl>
            <dl>
                <dt>联系我们</dt>
                <dd><h2 class="red"><span class="icon icon-phone"></span>4008123123</h2></dd>
                <dd>仅收市话费，周一至周日8.00-18.00</dd>
                <dd><button class="kf">24小时在线客服</button></dd>
            </dl>
            <dl>
                <dt><a href="">二维码</a></dt>
            </dl>
        </div>
    </div>
    <div class="footer w">
        <ul class="bottom-nav">
            <li><a href="">首页</a></li>
            <li><a href="">关于乐拍</a></li>
            <li><a href="">隐私声明</a></li>
            <li><a href="">合作专区</a></li>
            <li><a href="">联系我们</a></li>
        </ul>
        <P>版权所有</P>
        <span>乐拍，快乐抢拍你的人生！</span>
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
