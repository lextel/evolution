<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title?></title>
    <?php echo Asset::css(['common.css', 'header.css']); ?>
    <?php echo Asset::js(['jquery.min.js', 'common.js']); ?>
    <script type="text/javascript">
         $(function(){
            function getTotalBuy(){
                $.get("/totalbuycount?callback="+ new Date().getTime(), function(data){
                    if (data.code==0){
                        $("#totalbuy").html(data.num);
                    }
                });
            }
            function timer(){
                getTotalBuy();
            }
            setInterval(timer,3000);
            getTotalBuy();
         });
    </script>
</head>
<body>
    <!--头部开始-->
    <div class="top-nav">
        <div class="top-menu">
            <span class="online">
                <a href="javascript:void(0);">在线客服<span class="icon icon-qq"></span></a>
            </span>
            <span class="login-bar">
            <?php if (!isset($current_user)):?>
                 <a href="<?php echo Uri::create('/signin'); ?>">登录</a>
                 <i>/</i>
                 <a href="<?php echo Uri::create('/signup'); ?>">注册</a>
            <?php else:?>
                 <a href="<?php echo Uri::create('/u'); ?>" class="top-portrait"><?php echo Html::img($current_user->avatar, ['width'=>'15px']);?><?php echo $current_user->nickname;?></a>
                 <?php echo Html::anchor('signout', '[退出]', ['class'=>'navbar-link'])?>
            <?php endif;?>
            </span>
        </div>
    </div>
    <div class="logo-box">
        <div class="logo"><a href="<?php echo Uri::base(); ?>"><img src="<?php echo Uri::create('assets/images/logo.png');?>" alt="乐乐淘首页"/></a></div>
         <div class="right-box">
                <div class="search">
                    <input id="txtSearch" type="text" value="" name="title" placeholder="输入“苹果手机”试试"/>
                    <a href="javascript:void(0);" class="search-btn" id="doSearch">
                        <span class="icon icon-search"></span>
                    </a>
                </div>
                <div class="shopping-box">
                    <div class="shopping-cart">
                        <a href="javascript:void(0);" class="car-t"><i class="icon icon-car"></i>购物车</a>
                          <ul class="dropdown-list" style="display:none"></ul>
                    </div>
                    <div class="all">
                        <!--a href="<?php echo Uri::create('l'); ?>">当前乐拍人数<b id="totalbuy">100000</b></a-->
                        当前乐拍人数<b id="totalbuy"><?php echo $count;?></b>
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
                    <dt>关注我们</dt>
                    <dd><a href="">新浪微博</a></dd>
                    <dd><a href="">官方微信</a></dd>
                    <dd>官方QQ群：10000000</dd>
                </dl>
                <dl>
                    <dt>联系我们</dt>
                    <dd><h2 class="red"><span class="icon icon-phone"></span>4008123123</h2></dd>
                    <dd>仅收市话费，周一至周日8.00-18.00</dd>
                    <dd><span class="kf"><i class="icon icon-online"></i>24小时在线客服</span></dd>
                </dl>
                <dl>
                    <dt><a href="">二维码</a></dt>
                </dl>
            </div>
        </div>
        <div class="footer w">
            <ul class="bottom-nav">
                <li><a href="<?php echo Uri::base(); ?>">首页</a></li>
                <li><a href="javascript:void(0);">关于乐拍</a></li>
                <li><a href="javascript:void(0);">隐私声明</a></li>
                <li><a href="javascript:void(0);">合作专区</a></li>
                <li><a href="javascript:void(0);">联系我们</a></li>
            </ul>
            <P>版权所有</P>
            <span>乐拍，快乐抢拍你的人生！</span>
             <ul class="safety">
                <li class="safety-01"></li>
                <li class="safety-02"></li>
                <li class="safety-03"></li>
              </ul>
        </div>
    </div>
    <!--底部结束-->
    <!--二维码开始-->
    <div class="weiXin">
        <div class="weiXin-img">
            <button class="icon-close"></button>
        </div>
        <p>关注微信更多惊喜<p/>
    </div>
    <!--二维码结束-->
    <div class="short-cut">
        <a  href="javascript:void(null);" class="item-cart"><s>0</s></a>
        <a  href="javascript:void(null)" class="item-qq"></a>
        <a  href="javascript:void(null)" class="item-love"></a>
        <a  href="javascript:void(null)" class="item-gotTop"></a>
    </div>
    <script>
        <?php
            Config::load('common');
            $point = Config::get('point');
            $unit  = Config::get('unit');
        ?>
        BASE_URL = '<?php echo Uri::base(); ?>';
        POINT    = '<?php echo $point; ?>';
        UNIT     = '<?php echo $unit; ?>';
    </script>
</body>
</html>
