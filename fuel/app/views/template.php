<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title?></title>
    <?php echo Asset::css(['common.css', 'header.css']); ?>
    <?php echo Asset::js(['jquery.min.js', 'common.js']); ?>
</head>
<body>
    <!--头部开始-->
    <div class="top-nav">
        <div class="top-menu">
            <span class="online">
                <a href="">在线客服<span class="icon icon-qq"></span></a>
            </span>
            <span class="login-bar">
            <?php if (!isset($current_user)):?>
                 <a href="<?php echo Uri::create('/signin'); ?>">登录</a>
                 <i>/</i>
                 <a href="<?php echo Uri::create('/signup'); ?>">注册</a>
            <?php else:?>
                 <a href="<?php echo Uri::create('/u'); ?>" class="top-portrait"><?php echo Html::img($current_user->avatar, ['width'=>'15px']);?><?php echo $current_user->username;?></a>
                 <?php echo Html::anchor('signout', '[退出]', ['class'=>'navbar-link'])?>
            <?php endif;?>
            </span>
        </div>
    </div>
    <div class="logo-box">
        <div class="logo"><a href="<?php echo Uri::base(); ?>">logo</a></div>
         <div class="right-box">
                <div class="search">
                    <input type="text" value="" name="title" placeholder="输入“苹果手机”试试"/>
                    <a href="javascript:void(0);" class="search-btn" id="doSearch">
                        <span class="icon icon-search"></span>
                    </a>
                </div>
                <div class="shopping-box">
                    <div class="shopping-cart"><a href="<?php echo Uri::create('cart/list'); ?>">购物车</a></div>
                    <div class="all">
                        <a href="<?php echo Uri::create('l'); ?>">当前乐拍人数<b>100000</b></a>
                    </div>
                </div>
         </div>
    </div>
    <div class="navbar">
        <ul>
            <li><a href="<?php echo Uri::base(); ?>">首页</a></li>
            <li><a href="<?php echo Uri::create('/m'); ?>">所有商品</a></li>
            <li><a href="<?php echo Uri::create('/w'); ?>">最新揭晓</a></li>
            <li><?php echo Html::anchor('p', '晒单分享'); ?></li>
            <li><a href="<?php echo Uri::create('/h/new'); ?>">新手指南</a></li>
        </ul>
    </div>
    <!--头部结束-->
    <div class="w">
    <?php echo $layout; ?>
    </div>
    <!--底部开始-->
    <div class="footer-wrapper">
        <div class="help-bg">
            <div class="footer-help w">
                <dl>
                    <dt><a href="<?php echo Uri::create('/h/center'); ?>">帮助中心</a></dt>
                    <dd><a href="<?php echo Uri::create('/h/new'); ?>">新手指南</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/safeguard'); ?>">乐拍保障</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/shipping'); ?>">商品配送</a></dd>
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
                <li><a href="<?php echo Uri::base(); ?>">首页</a></li>
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
</body>
</html>
