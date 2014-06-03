<!--获得的商品结束-->
    <div class="center-main fl">
        <ul class="center-info">
            <li>
                <div class="winner fl"><h1>昵称：<a href="<?php echo Uri::create('u');?>"><?php echo $current_user->nickname;?></a></h1></div>
                <a href="<?php echo Uri::create('u/getprofile'); ?>" class="btn-topUp btn-state fl" style="margin-left:20px;">编辑</a>
            </li>
            <li>
                <div class="signature2 fl"> 个性签名：<?php echo $current_user->bio;?></div>
            </li>
            <li>
                <span class="wealth fl">余额：<?php echo \Helper\Coins::showCoins($current_user->points, true);?></span>
                <?php echo Html::anchor('u/getrecharge', '充值', ['class'=>'btn-topUp btn-y']);?>
            </li>
        </ul>
        <?php if ($orders) { ?>
        <?php foreach($orders as $item) { ?>
        <?php $itemInfo = $getItemInfo($item->phase_id);?>
        <ul class="buy-menu">
            <li>在<?php echo \Helper\Timer::friendlyDate($item->ordered_at);?>购买了 </li>
            <li class="right-box">
                <div class="img-box img-md fl">
                    <a href="<?php echo Uri::create('m/'.$item->phase_id); ?>" rel="nofollow">
                        <img src="<?php echo \Helper\Image::showImage('', '200x200');?>"/>
                    </a>
                </div>
                <div class="buy-record fl">
                    <h4 class="title-lg" style="overflow: visible;"><?php echo Html::anchor('/m/'.$itemInfo->id, $itemInfo->title, ['class'=>'chance']);?></h4>
                    <div class="price">价值：￥<b><?php echo sprintf( '%.2f', $itemInfo->price);?></b></div>
                    <?php echo Html::anchor('m/'.$item->phase_id, '<button class="btn-topUp btn-red">继续购买</button>');?>
                </div>
            </li>
        </ul>
        <?php } ?>
        <?php } ?>
    </div>
