<?php echo Asset::css(['style.css']); ?>
<?php echo Asset::css('member/validfrom_style.css'); ?>
<?php echo Asset::js('Validform_v5.3.2_min.js'); ?>
<div class="wrapper w">
    <!--获得的商品开始-->
    <div class="left-sidebar fl">
        <div class="img-box">
            <?php echo Html::anchor('u', Html::img($current_user->avatar));?></a>
        </div>
        <ul class="left-nav">
            <li><?php echo Html::anchor('u', '我的主页');?></li>
            <li class="dropdown">
                <a href="javascript:void(null)" class="active">我的乐拍<span class="icon-arrow"></span><s></s></a>
                <ul class="dropdown-menu">
                    <li><?php echo Html::anchor('u/orders', '乐拍记录');?></li>
                    <li><?php echo Html::anchor('u/wins', '获得的商品');?></li>
                    <li><?php echo Html::anchor('u/posts', '晒单');?></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(null)">帐户管理<span class="icon-arrow"></span></a>
                <ul class="dropdown-menu">
                    <li><?php echo Html::anchor('u/getrecharge', '充值');?></li>
                    <li><?php echo Html::anchor('u/moneylog', '账户明细');?></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(null)">邀请管理<span class="icon-arrow"></span></a>
                <ul class="dropdown-menu">
                    <li><?php echo Html::anchor('u/invit', '邀请好友');?></li>
                    <li><?php echo Html::anchor('u/brokerage', '佣金明细');?></li>
                </ul>
            </li>
            <li><?php echo Html::anchor('u/message', '消息管理');?>
            <?php if ($isnew) { ?>
               <span style="color: red!important;position: absolute;top: 0;right: 30px;">新</span>
            <?php } ?>
            </li>
            <li><?php echo Html::anchor('u/getprofile', '个人设置');?></li>
        </ul>
    </div>
    <!--获得的商品结束-->
    <?php echo $content;?>
</div>
