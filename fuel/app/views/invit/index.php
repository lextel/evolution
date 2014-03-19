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
</style>
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
            <?php elseif(!$current_user->is_mobile): ?>
            <div class="login_reg">
                您当前未通过手机验证，邀请功能需要您登录并通过手机验证后才能正常使用并获得佣金奖励!
            </div>
            <div class="login_button">
                <a class="btn btn-red btn-atc" style="margin-bottom: 137px; padding: 5px 20px" href="<?php echo Uri::create('/signin');?>">立即验证>邀请好友</a>
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
