<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="/lltao.ico" mce_href="ltao.ico" type="image/x-icon">
    <title>乐乐淘-独乐乐,不如众乐乐!! <?php echo $title?></title>
    <meta name="baidu-site-verification" content="SxjotPWKoe" />
    <meta baidu-gxt-verify-token="0034978307b85b0705b55872afbd5cb4">
    <meta name="keywords" content="乐乐淘,乐淘,leletao,购物,网购,网上商城,网上购物,1元购,一元购,1元购物,一元购物网,云购,众筹,购物网站" />
    <meta name="description" content="乐乐淘（www.lltao.com）是一种全新的互动购物体验方式,是时尚、潮流的风向标，能满足个性、年轻消费者的购物需求，由深圳市乐乐淘兄弟科技有限公司注入巨资打造的新型购物网。" />
    <?php echo Asset::css(['common.css', 'header.css','product.css']); ?>
    <?php echo Asset::js(['jquery.min.js', 'common.js']); ?>
    <!--[if lt IE 10]>
    <?php echo Asset::js(['PIE.js']); ?>
    <![endif]-->
        <script type="text/javascript">
            $(function() {
                if (window.PIE) {
                    $(".btn,.progress,.crumbs li s,.product-list li,.list-hover li").each(function() {
                        PIE.attach(this);
                    });
                }
            });
        </script>
</head>
<body>
    <!--头部开始-->
    <div class="top-nav">
        <div class="top-menu">
            <span class="<?php echo Classes\Qqonline::qqState() ? 'online' : 'offline';?>">
                <a href="http://wpa.qq.com/msgrd?v=3&uin=2698744419&site=qq&menu=yes" target="_blank">在线客服</a>
            </span>
            <div class="divide-line">
            <?php if (!isset($current_user)) { ?>
                 <a href="<?php echo Uri::create('/signin'); ?>">登录</a>
                 <i>/</i>
                 <a href="<?php echo Uri::create('/signup'); ?>">注册</a>
            <?php }else {?>
                 <div class="info-wide">
                     <div style="float: left;padding: 0px 14px 0px 0px;"><img src="<?php echo \Helper\Image::showImage($current_user->avatar, '60x60');?>"/>
                     <s class="top-name"><?php echo Html::anchor('/u', $current_user->nickname);?></s>
                     </div>
                     <div class="info-user" style="float: left;"><a class="x open">我的乐乐淘<i></i></a>
                        <ul class="head-set">
                              <li><a href="<?php echo Uri::create('/u/orders'); ?>">乐淘记录</a></li>
                              <li><a href="<?php echo Uri::create('/u/wins'); ?>">获得的商品</a></li>
                              <li><a href="<?php echo Uri::create('/u/getrecharge'); ?>">账户管理</a></li>
                              <li><a href="<?php echo Uri::create('/u/getprofile'); ?>">个人设置</a></li>
                              <li><?php echo Html::anchor('/signout', '退出', ['class'=>'logout'])?></li>
                        </ul>
                     </div>

                 </div>

                 <span style="color:#C10101;margin:0px 4px 0px 0px"><?php echo \Helper\Coins::showIconCoins($current_user->points);?></span>

            <?php }?>
            </div>
        </div>
    </div>
    <div class="logo-box">
        <div class="logo"><a href="<?php echo Uri::base(); ?>"><img src="<?php echo Uri::create('assets/images/logo.png');?>" alt="乐乐淘首页"/></a></div>
         <div class="right-box">
                <div class="search">
                    <input id="txtSearch" type="text" value="" name="title" placeholder="输入“iPhone”试试" onfocus="this.placeholder = ''" onblur="this.placeholder = '输入“iPhone”试试'"/>
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
                        <a href="/l">当前乐淘人数<b id="totalbuy"><?php echo $count;?></b></a>
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
                    <dt>新手指南</a></dt>
                    <dd><a href="<?php echo Uri::create('/h'); ?>">新手指南</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/question'); ?>">常见问题</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/serve'); ?>">服务协议</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/privacy'); ?>">隐私声明</a></dd>
                </dl>
                <dl class="dl02">
                    <dt>乐淘保障</dt>
                    <dd><a href="<?php echo Uri::create('/h/safeguard'); ?>">保障体系</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/promise'); ?>">正品承诺</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/pay'); ?>">安全支付</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/suggest'); ?>">投诉建议</a></dd>
                </dl>
                <dl class="dl02">
                    <dt>商品配送</dt>
                    <dd><a href="<?php echo Uri::create('/h/expressinfo');?>">商品配送</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/shipping');?>">配送费用</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/examine');?>">验货签收</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/longTime');?>">长时间未收到商品</a></dd>
                </dl>
                <dl class="dl02">
                    <dt>关于乐淘</dt>
                    <dd><a href="<?php echo Uri::create('/h/about');?>">关于我们</a></dd>
                    <dd><a href="javascript:;">新浪微博</a></dd>
                    <dd><a href="javascript:;">官方微信</a></dd>
                    <dd><a href="<?php echo Uri::create('/h/contact');?>">联系我们</a></dd>
                </dl>
                <dl class="dl02">
                    <dt>乐淘商务</dt>
                    <dd><a href="javascript:;">商务合作</a></dd>
                    <dd><a href="<?php echo Uri::create('links');?>">友情链接</a></dd>
                    <dd>官方QQ群：<br />157425899</dd>
                </dl>
                <dl class="dl06">
                    <dt>关注微信</dt>
                    <dd><img src="<?php echo Uri::create("/assets/images/wxin1.jpg");?>"></dd>
                </dl>
            </div>
        </div>
        <div class="footer w">
            <ul class="bottom-nav">
                <li><a href="<?php echo Uri::create('/');?>">首页</a></li>
                <li>|</li>
                <li><a href="<?php echo Uri::create('h/about');?>">关于乐淘</a></li>
                <li>|</li>
                <li><a href="<?php echo Uri::create('links');?>">友情链接</a></li>
                <li>|</li>
                <li><a href="<?php echo Uri::create('h/privacy');?>">隐私声明</a></li>
                <li>|</li>
                <?php if (0) { ?>
                <li><a href="<?php echo Uri::create('h/cooperation');?>">合作专区</a></li>
                 <li>|</li>
                <?php } ?>
                <li class="lastest"><a href="<?php echo Uri::create('h/contact');?>">联系我们</a></li>
            </ul>
            <P style="color:#5b5b5b">Copyright © 2014<?php echo date('Y') != 2014 ? '-'.date('Y') : '';?> <a href="http://www.lltao.com">www.lltao.com</a> 版权所有 <a href="http://www.miitbeian.gov.cn/" target="_blank" ref="nofollow">粤ICP备14017463号-1<!--服务器商要求加链接--></a></P>
            <div class="slogan"><img src=<?php echo Uri::create("/assets/images/slogan.png");?>></div>
            <div>
                <script type="text/javascript">
                    var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5959034'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s19.cnzz.com/stat.php%3Fid%3D5959034' type='text/javascript'%3E%3C/script%3E"));
                </script>

                <script id="ebsgovicon" src="https://cert.ebs.gov.cn/govicon.js?id=ddc62feb-c968-4272-b63e-6a94ec87682f&width=128&height=52&type=2" type="text/javascript" charset="utf-8"></script>
                <!--可信网站图片LOGO安装开始-->
                <script src="http://kxlogo.knet.cn/seallogo.dll?sn=e14080644030052139ynxi000000&size=0"></script>
                <!--可信网站图片LOGO安装结束-->
            </div>
            <!--
            <div style="clear:both"></div>
             <ul class="safety">
                <li class="safety-01"></li>
                <li class="safety-02"></li>
                <li class="safety-03"></li>
              </ul>
             -->
        </div>
    </div>

    <script>
    //传入不显示右侧购物车块的地址
    function hideSpecial(specialName){
        var lolUrl = window.location.pathname;
        //var url = "/special/lol";
        for(var i = 0; i < specialName.length; i++){
            if(lolUrl.indexOf(specialName[i]) > 0){
                $(".weiXin").css("display","none");
                $(".short-cut").css("display","none");
            }
        }
    }
    $(function (){
        hideSpecial(["special"]);
    });
    </script>
    <!--底部结束-->
    <!--二维码开始
    <div class="weiXin">
        <div class="weiXin-img">
             <img src="../assets/images/wxin1.jpg">
            <button class="icon-close"></button>
        </div>
        <p>关注微信更多惊喜<p/>
    </div>
    -->
    <div class="short-cut">
        <a  href="<?php echo Uri::create('cart/list'); ?>" class="item-cart"><s style=" <?php echo ($cartCount == 0) ? 'display: none' :'' ?>"><?php echo $cartCount; ?></s></a>
        <a  href="http://wpa.qq.com/msgrd?v=3&uin=2698744419&site=qq&menu=yes" target="_blank" class="item-qq"></a>
        <a  href="javascript:void(null)" onclick="addFavorite(window.location,document.title)"  class="item-love"></a>
        <a  href="javascript:void(null)" class="item-gotTop"></a>
    </div>
    <script>
        <?php
            Config::load('common');
            $point = Config::get('point');
            $unit  = Config::get('unit2');
            $unit2 = Config::get('unit4');
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
    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?1e1a26c753085ede05629ae3b73ed2df";
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>
