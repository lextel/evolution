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
        <?php $phases = $getPhaseInfos($orders);?>
        <?php foreach($orders as $item) { ?>
        <?php $phase = $phases[$item->phase_id];?>
        <ul class="buy-menu">
            <li>在<?php echo \Helper\Timer::friendlyDate($item->ordered_at);?>乐淘了 </li>
            <li class="right-box">
                <div class="img-box img-md fl">
                    <a href="<?php echo Uri::create('m/'.$item->phase_id); ?>" rel="nofollow">
                        <img src="<?php echo \Helper\Image::showImage($getItemInfo($phase->item_id)->image, '200x200', 'items');?>"/>
                    </a>
                    <?php if ($phase->code != '') { ?>
                             <span class="icon-jx">已揭晓</span>
                            <?php } ?>
                </div>
                <div class="buy-record fl">
                    <h4 class="title-lg">(第<?php echo $phase->phase_id;?>期)<?php echo Html::anchor('/m/'.$item->phase_id, $getItemInfo($phase->item_id)->title, ['class'=>'chance']);?></h4>
                    <div class="price">价值：￥<b><?php echo sprintf( '%.2f',$phase->amount);?></b></div>
                    <?php if ($getProgress($phase) != 100) { ?>
                    <dl class="progress-side">
                        <dd>
                            <div class="progress">
                                <div class="progress-bar" style="width:<?php echo $getProgress($phase);?>%">
                                </div>
                            </div>
                        </dd>
                        <dd>
                            <span class="fl r"><?php echo $phase->joined;?></span>
                            <span class="fr b"><?php echo $phase->remain;?></span>
                        <dd>
                            <span class="fl">已攒元宝</span>
                            <span class="fr">还需元宝</span>
                        </dd>
                    </dl>
                    <?php echo Html::anchor('m/'.$item->phase_id, '<button class="btn-topUp btn-red">去乐淘</button>');?>
                    <?php }else{ ?>
                    <div class="number">幸运乐淘码：<b class="y"><?php echo $phase->code;?></b></div>
                    <div class="datetime">揭晓时间：<?php echo date("Y-m-d H:i:s", $phase->opentime);?></div>
                    <?php echo Html::anchor('m/'.$item->phase_id, '<button class="btn-topUp btn-red">去揭晓</button>');?>
                    <?php } ?>
                </div>
            </li>
        </ul>
        <?php } ?>
        <?php } ?>
    </div>
