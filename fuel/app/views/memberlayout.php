<?php echo Asset::css(['common.css', 'style.css']); ?>
<div class="wrapper w">
    <!--获得的商品开始-->
    <div class="left-sidebar fl">
        <div class="img-box">
            <?php echo Html::anchor('u', Html::img($current_user->avatar));?></a>
        </div>
        <ul class="left-nav">
            <li><?php echo Html::anchor('u', '我的主页');?></li>
            <li class="dropdown">
                <a href="javascript:void(null)">我的乐拍</a>
                <ul class="dropdown-menu">
                    <li><?php echo Html::anchor('u/orders', '乐拍记录');?></li>
                    <li><?php echo Html::anchor('u/wins', '获得的商品');?></li>
                    <li><?php echo Html::anchor('u/posts', '晒单');?></li>
                </ul>
                <span class="icon-arrow"></span>
            </li>
            <li class="dropdown">
                <a href="javascript:void(null)">帐户管理</a>
                <ul class="dropdown-menu">
                    <li><?php echo Html::anchor('u/recharge', '充值');?></li>
                    <li><?php echo Html::anchor('u/moneylog', '账户明细');?></li>
                </ul>
                <span class="icon-arrow"></span>
            </li>
            <li><?php echo Html::anchor('javascript:;', '消息管理');?></li>
            <li><?php echo Html::anchor('u/getprofile', '个人设置');?></li>
        </ul>
    </div>
    <!--获得的商品结束-->
    <?php echo $content;?>
</div>
