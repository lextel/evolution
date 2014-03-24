<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title?></title>
    <?php echo Asset::css(['common.css', 'header.css']); ?>
    <?php echo Asset::js(['jquery.min.js', 'common.js']); ?>
    <!--[if lt IE 10]>
    <?php echo Asset::js(['PIE.js']); ?>
    <![endif]-->
        <script type="text/javascript">
            $(function() {
                if (window.PIE) {
                    $(".btn,.progress,.crumbs li s").each(function() {
                        PIE.attach(this);
                    });
                }
            });
        </script>
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
            <div class="collection fl" style="CURSOR: hand" onClick="window.external.addFavorite('http://www.lltao.com')" title="乐乐淘">
                 <a href="javascript:;">收藏乐乐淘</a>
            </div>
            <span class="online">
                <a href="javascript:void(0);">在线客服</a>
            </span>
            <div class="divide-line">
            <?php if (!isset($current_user)) { ?>
                 <a href="<?php echo Uri::create('/signin'); ?>">登录</a>
                 <i>/</i>
                 <a href="<?php echo Uri::create('/signup'); ?>">注册</a>
            <?php }else {?>
                 <div class="info-wide" href="<?php echo Uri::create('/u'); ?>">
                     <?php echo Html::img($current_user->avatar);?>
                     <s class="top-name"><?php echo $current_user->nickname;?></s>
                     <ul class="head-set">
                          <li><a href="<?php echo Uri::create('/u/orders'); ?>">乐拍记录</a></li>
                          <li><a href="<?php echo Uri::create('/u/wins'); ?>">获得的商品</a></li>
                          <li><a href="<?php echo Uri::create('/u/getrecharge'); ?>">账户管理</a></li>
                          <li><a href="<?php echo Uri::create('/u/profile'); ?>">个人设置</a></li>
                      </ul>
                 </div>

                 <span>财富(<s class="r"><?php echo \Helper\Coins::showCoins($current_user->points);?></s>)</span>
                 <span>消息(<s class="r"><?php echo $isnew? $isnew : 0;?></s>)</span>
                 <?php echo Html::anchor('signout', '[退出]', ['class'=>'logout'])?>
            <?php }?>
            </div>
        </div>
    </div>
    <div class="logo-box">
        <div class="logo"><a href="<?php echo Uri::base(); ?>"><img src="<?php echo Uri::create('assets/images/logo.png');?>" alt="乐乐淘首页"/></a></div>
         <div class="right-box">
                <div class="search">
                    <input id="txtSearch" type="text" value="" name="title" placeholder="输入“LOL”试试" onfocus="this.placeholder = ''" onblur="this.placeholder = '输入“LOL”试试'"/>
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
                        <a href="/l">当前乐拍人数<b id="totalbuy"><?php echo $count;?></b></a>
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
            <li><a href="<?php echo Uri::create('/invit'); ?>">邀请</a></li>
            <li><a href="<?php echo Uri::create('/h'); ?>">新手指南</a></li>
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
                <dl class="dl01">
                    <dt><a href="<?php echo Uri::create('/h'); ?>">帮助中心</a></dt>
                    <dd><a href="<?php echo Uri::create('/h/new'); ?>">新手指南</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/safeguard'); ?>">乐拍保障</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/shipping'); ?>">商品配送</a></dd>
                </dl>
                <dl class="dl02">
                    <dt>关注我们</dt>
                    <dd><a href="javascript:;">新浪微博</a></dd>
                    <dd><a href="javascript:;">官方微信</a></dd>
                    <dd>官方QQ群：10000000</dd>
                </dl>
                <dl class="three">
                    <dt>联系我们</dt>
                    <dd><p class="r" style="font-size:22px;"><span class="icon icon-phone"></span>4008123123</p></dd>
                    <dd><p class="pl-01">仅收市话费，周一至周日8.00-18.00</p></dd>
                    <dd><span class="kf"><i class="icon icon-online"></i>24小时在线客服</span></dd>
                </dl>
                <dl class="dl04">
                    <dt><a href="javascript:;">二维码</a></dt>
                </dl>
            </div>
        </div>
        <div class="footer w">
            <ul class="bottom-nav">
                <li><a href="<?php echo Uri::base(); ?>">首页</a></li>
                <li><?php echo Html::anchor('h/about', '关于乐拍'); ?></li>
                <li><?php echo Html::anchor('h/privacy', '隐私声明'); ?></li>
                <li><a href="javascript:void(0);">合作专区</a></li>
                <li class="lastest"><a href="javascript:void(0);">联系我们</a></li>
            </ul>
            <P style="color:#5b5b5b">Copyright © 2014 粤ICP备14017463号-1 <a href="www.lltao.com">www.lltao.com</a> 版权所有</P>
            <div class="log">乐拍，快乐抢拍你的人生！</div>
            <div class="flink" style="text-align:center">
                <span>友情链接:</span>
                    <a href="http://www.xda.cn" target="_blank">XDA</a>
                    <a href="http://www.wanggouchao.com" target="_blank">网购潮</a>
                    <a href="http://www.kd100.com" target="_blank">快递查询</a>
            </div>
            <div style="clear:both"></div>
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
        <a  href="<?php echo Uri::create('cart/list'); ?>" class="item-cart"><s><?php echo $cartCount; ?></s></a>
        <a  href="javascript:void(null)" class="item-qq"></a>
        <a  href="javascript:void(null)" onclick="addFavorite(window.location,document.title)"  class="item-love"></a>
        <a  href="javascript:void(null)" class="item-gotTop"></a>
    </div>
    <script>
        <?php
            Config::load('common');
            $point = Config::get('point');
            $unit  = Config::get('unit');
            $unit2 = Config::get('unit2');
        ?>
        BASE_URL = '<?php echo Uri::base(); ?>';
        POINT    = '<?php echo $point; ?>';
        UNIT     = '<?php echo $unit; ?>';
        UNIT2    = '<?php echo $unit2?>';

        function showCoins(point) {
            var gold = parseInt(point/POINT);
            var silver = point%POINT;

            var unit = gold + UNIT;
            if(silver > 0) {
                unit += silver + UNIT2;
            }

            return unit;
        }
    </script>
    <script type="text/javascript">
    // var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    // document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F3bcae7d806a59ae00c9c89ef8dbdad49' type='text/javascript'%3E%3C/script%3E"));
    </script>
</body>
</html>
