<!--获得的商品结束-->
    <div class="center-main fl">
        <ul class="center-info">
            <li>
                <div class="winner fl"><h1>昵称：<a href="/u"><?php echo $current_user->nickname;?></a></h1></div>
                <!--<button class="edit fl">编辑</button>-->
            </li>
            <li>
                <div class="signature2"> 个性签名：<?php echo $current_user->bio;?></div>
            </li>
            <li>
                <span class="price fl">帐户积分： <b><?php echo $current_user->points;?>点</b> </span>
                <a href="#" class="btn-topUp btn-y">充值</a>
            </li>
        </ul>
        <?php foreach($orders as $item) { ?>
        <ul class="buy-menu">
            <li>在<b><?php echo \Helper\Timer::friendlyDate($item->ordered_at);?></b>乐拍了 </li>
            <li class="right-box">
                <div class="img-box img-md fl">
                    <?php echo Html::anchor('/m/'.$item->phase_id, Html::img($getItemInfo($getPhaseInfo($item->phase_id)->item_id)->image));?>
                </div>
                <div class="buy-record fl">
                    <h4 class="title-lg">(第<?php echo $getPhaseInfo($item->phase_id)->phase_id;?>期)<?php echo Html::anchor('/m/'.$item->phase_id, $getItemInfo($getPhaseInfo($item->phase_id)->item_id)->title, ['class'=>'chance']);?></h4>
                    <div class="price">价值：<b><?php echo $getPhaseInfo($item->phase_id)->amount;?>.00</b></div>
                    <dl class="progress-side">
                        <dd>
                            <div class="progress">
                            <div class="progress-bar" style="width:<?php echo $getProgress($item->phase_id);?>%">
                            </div></div>
                        </dd>
                    </dl>
                    <?php if ($getProgress($item->phase_id) != 100) { ?>
                    <?php echo Html::anchor('/m/'.$item->phase_id, '<button class="btn-topUp btn-red">去乐拍</button>');?>
                    <?php }else{ ?>
                    <?php echo Html::anchor('/m/'.$item->phase_id, '<button class="btn-topUp btn-red">去揭晓</button>');?>
                    <?php } ?>
                </div>
            </li>
        </ul>
        <?php } ?>

    </div>
