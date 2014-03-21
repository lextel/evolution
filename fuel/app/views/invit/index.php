<style>
.referrals_box {
    width: 980px;
    margin: 0 auto 0;
    clear: both;
}
.W-left {
    width: 700px;
    padding: 19px;
    border: 2px solid #af2812;
}
.W-left h4 {
    height: 40px;
    border-bottom: 1px solid #EDEDED;
}

.W-left h4 i {
    background-position: 0 0;
    width: 116px;
    height: 32px;
    display: block;
}
.wqyl {
    width: 700px;
    margin: 20px auto;
    display: inline-block;
}
.wqylL {
    float: left;
}
.wqylR {
    float: right;
}
.wqylL, .wqylR {
    padding: 10px 0;
    border: 2px solid #ededed;
    background: #f7f7f7;
    width: 340px;
    height: 115px;
}
.wqyl dl {
    float: left;
    margin-left: 10px;
    font-size: 14px;
    color: #666;
    line-height: 25px;
}
.W-right {
    width: 227px;
    border: 1px solid #E3E3E3;
    color: #666;
}
.W-right h4 {
    background-position: 0 -138px;
    font-size: 14px;
    font-weight: bold;
    text-indent: 10px;
    margin-top: 8px;
    line-height: 30px;
}
.rig_con {
    padding: 7px 7px 0;
}
.rig_con li {
    border-top: 1px solid #f0f0f0;
    padding: 15px 0;
    line-height: 22px;
}
.login_reg {
    height: 45px;
    padding-top: 25px;
    text-align: center;
    font-size: 14px;
    color: #666;
}
.login_reg a{
    color:#0093D0;
}
.login_button {
    text-align: center;
}
.fs14 {
    font-size: 14px;
    color: #666;
}
.Invitation-t {
    border-bottom: 1px solid #ccc;
    font-size: 14px;
    height: 25px;
    font-weight: bold;
    text-indent: 0.5em;
}
.Invitation-C1 .textarea {
    width: 678px;
    height: 50px;
    padding: 5px 10px;
    line-height: 22px;
    font-size: 14px;
    border: 1px solid #ddd;
    color: #333;
    background: #f7f7f7;
    -moz-box-shadow: 1px 1px 1px #ddd inset;
    -webkit-box-shadow: 1px 1px 1px #ddd inset;
    box-shadow: 1px 1px 1px #ddd inset;
}
.Invitation-C1 {
    height: 160px;
    border-bottom: 1px dashed #ccc;
    padding-top: 25px;
}
.Invitation-C2 {
    height: 90px;
    border-bottom: 1px dashed #ccc;
    padding-top: 30px;
}
.Invitation-C2 p {
    padding-bottom: 15px;
}
.Invitation-C3 {
    height: 88px;
    padding-top: 20px;
}
.Invitation-C3 p {
    padding-bottom: 15px;
}
.Invitation-C3 li {
    width: 88px;
    float: left;
    margin-right: 10px;
}
a.M126:hover, a.M163:hover, a.Mmsn:hover, a.Msohu:hover, a.Mgmail:hover, a.Msina:hover, a.Myahoo:hover {
border: 1px solid #f60;
}
a.M126 {
width: 84px;
height: 32px;
display: block;
border: 1px solid #D9D9D9;
background-position: -10px -90px;
}
a.M163 {
width: 84px;
height: 32px;
display: block;
border: 1px solid #D9D9D9;
background-position: -106px -90px;
}
a.Mmsn {
width: 84px;
height: 32px;
display: block;
border: 1px solid #D9D9D9;
background-position: -202px -90px;
}
a.Msohu {
width: 84px;
height: 32px;
display: block;
border: 1px solid #D9D9D9;
background-position: -297px -90px;
}
a.Mgmail {
width: 84px;
height: 32px;
display: block;
border: 1px solid #D9D9D9;
background-position: -394px -90px;
}
a.Msina {
width: 84px;
height: 32px;
display: block;
border: 1px solid #D9D9D9;
background-position: -488px -90px;
}
a.Myahoo {
width: 84px;
height: 32px;
display: block;
border: 1px solid #D9D9D9;
background-position: -584px -90px;
}
.M126, .M163, .Mmsn, .Msohu, .Mgmail, .Msina, .Myahoo {
background: url(../images/referrals_bg.png) no-repeat;
}
</style>
<?php echo Asset::js(['jquery.zclip.min.js']); ?>
<div class="referrals_box">
        <div class="W-left fl">
            <h4 style="line-height: 40px; font-size: 24px; color:#af2812">邀请有礼</h4>
            <div class="wqyl">
                <div class="wqylL">
                    <dl><img src="pic_03.gif"></dl>
                    <dl>
                        <h3>一重礼 60银币</h3>
                        您邀请的每一位好友成功参与云购，<br>即可获得60银币(100银币等于1元宝<br>哦！)
                    </dl>
                </div>
                <div class="wqylR">
                    <dl><img src="pic_05.gif"></dl>
                    <dl>
                        <h3>二重礼 7%的元宝提成</h3>
                        经您邀请的所有好友，成功参与乐拍<br>后，您都可以获得7%的元宝奖<br>赏，并且永久有效。
                    </dl>
                </div>
            </div>
            <?php if(!isset($current_user)):?>
            <div class="login_reg">
                请先<a href="<?php echo Uri::create('/signin');?>">登录</a>或者<a href="<?php echo Uri::create('/signup'); ?>">注册</a>，获取您的专属邀请链接。
            </div>
            <div class="login_button">
                <a class="btn btn-red btn-atc" style="margin-bottom: 137px; padding: 5px 20px" href="<?php echo Uri::create('/signin');?>">立即登录邀请好友</a>
            </div>
            <?php elseif($current_user->is_mobile): ?>
            <div class="login_reg">
                您当前未通过手机验证，邀请功能需要您登录并通过手机验证后才能正常使用并获得佣金奖励!
            </div>
            <div class="login_button">
                <a class="btn btn-red btn-atc" style="margin-bottom: 137px; padding: 5px 20px" href="<?php echo Uri::create('/signin');?>">立即验证>邀请好友</a>
            </div>
            <?php else:?>
                <div class="Invitation-t">专用邀请链接</div>
                <div class="Invitation-C1">
                    <p class="fs14">这是您的专属邀请链接，请通过 MSN 或 QQ 发送给您的好友</p>
                    <div class="">
                    <textarea name="copyShareText" id="copyShareText" class="textarea">我刚发现一个很好很好玩的网站，1元就能买LOL英雄哦，快去看看吧！
<?php echo Uri::create('invit/'.base64_encode($current_user->id));?></textarea>
                    </div>
                    <input class="btn btn-red btn-atc" type="button" id="btnCopy" value="复 制" title="复制">
                    <span style="color:green"></span>
                    <script>
                        $(document).ready(function(){
                            $("#btnCopy").zclip({
                                path:'<?php echo Uri::create('/assets/js/ZeroClipboard.swf');?>',
                                copy:$('#copyShareText').text(),
                                beforeCopy:function(){
                                    $(this).next('span').html();
                                },
                                afterCopy:function(){
                                    $(this).next('span').html('复制成功!');
                                }
                            });
                        });
                    </script>
                </div>
                <div class="Invitation-C2">
                    <p class="fs14">通过分享方式邀请好友，立即分享到您的QQ、微信、微博、人人、开心上的朋友吧！</p>
                    <div class="bdsharebuttonbox" data-tag="share_1">
                        <a class="bds_mshare" data-cmd="mshare">一键分享</a>
                        <a class="bds_sqq" data-cmd="sqq">QQ好友</a>
                        <a class="bds_qzone" data-cmd="qzone">QQ空间</a>
                        <a class="bds_weixin" data-cmd="weixin">微信</a>
                        <a class="bds_tsina" data-cmd="tsina">新浪微博</a>
                        <a class="bds_renren" data-cmd="renren">人人网</a>
                        <a class="bds_kaixin001" data-cmd="kaixin001">开心网</a>
                        <a class="bds_tqq" data-cmd="tqq">腾讯微博</a>
                        <a class="bds_douban" data-cmd="douban">豆瓣</a>
                        <a class="bds_taobao" data-cmd="taobao">淘宝</a>
                        <a class="bds_meilishuo" data-cmd="meilishuo">美丽说</a>
                        <a class="bds_more" data-cmd="more">更多</a>
                    </div>
                    <script>
                        window._bd_share_config = {
                            common : {
                                bdText : '我刚发现一个很好很好玩的网站，1元就能买LOL英雄哦，快去看看吧！',	
                                bdDesc : '我刚发现一个很好很好玩的网站，1元就能买LOL英雄哦，快去看看吧！',	
                                bdUrl : '<?php echo Uri::create('invit/'.base64_encode($current_user->id));?>', 	
                                bdPic : '<?php Uri::create('upload/ad/3/a/3a5ba1e800a5aefc5173fb4c52b14ae8.jpg');?>'
                            },
                            share : [{
                                "bdSize" : 16
                            }],
                            image : [{
                                viewType : 'list',
                                viewPos : 'top',
                                viewColor : 'black',
                                viewSize : '16',
                                viewList : ['qzone','tsina','huaban','tqq','renren']
                            }],
                        }
                        with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
                    </script>
                </div>
                <div class="Invitation-C3">
                    <p class="fs14">您可以直接通过发送邮件邀请好友：</p>
                    <ul>
                        <li><a href="http://mail.126.com" target="_blank" class="M126"></a></li>
                        <li><a href="http://mail.163.com" target="_blank" class="M163"></a></li>
                        <li><a href="http://login.live.com" target="_blank" class="Mmsn"></a></li>
                        <li><a href="http://mail.sohu.com" target="_blank" class="Msohu"></a></li>
                        <li><a href="https://mail.google.com" target="_blank" class="Mgmail"></a></li>
                        <li><a href="http://mail.sina.com.cn" target="_blank" class="Msina"></a></li>
                        <li><a href="http://mail.cn.yahoo.com" target="_blank" class="Myahoo"></a></li>
                    </ul>
                </div>
            <?php endif;?>
        </div>
        <div class="W-right fr">
            <h4>温馨提示</h4>
            <div class="rig_con">
                <ul>
                    <li><h5>1、在哪里可以看到我的佣金？</h5><p>在【<a href="<?php echo Uri::create('/u'); ?>" target="_blank">用户中心</a>】的【<a href="<?php echo Uri::create('u/brokerage'); ?>" target="_blank">佣金明细</a>】里可看到您的每次返佣记录。佣金满100即会自动转成元宝，立即可以参与乐拍。</p></li>
                    <li><h5>2、哪些情况会导致佣金失效？</h5><p>借助网站及其他平台，恶意获取佣金，一经查实，扣除一切佣金，清除账户且封号。</p></li>
                    <li><h5>3、自己邀请自己也能获得佣金吗？</h5><p>不可以。我们会人工核查，对于查实的作弊行为，扣除一切佣金，取消邀请佣金的资格并清除您的账户。</p></li>
                    <li class="none"><h5>4、如何知道我有没有邀请成功</h5><p>您可以在【<a href="<?php echo Uri::create('/u'); ?>" target="_blank">用户中心</a>】的【<a href="<?php echo Uri::create('u/invit'); ?>" target="_blank">邀请好友</a>】里面查看。</p></li>
                </ul>
            </div>
        </div>
    </div>
