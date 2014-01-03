<!--获得的商品结束-->
    <div class="center-main fl">
        <ul class="center-info">
            <li>
                <div class="winner fl"><a href="/u"><?php echo $current_user->username;?></a></div>
                <button class="edit fl">编辑</button>
            </li>
            <li>
                <div class="signature"> 个性签名:<?php echo $current_user->bio;?></div>
            </li>
            <li>
                <div class="price fl">帐户余额： <b>￥<?php echo $current_user->points;?></b> </div>
                <?php echo Html::anchor('/u/getrecharge', '<button class="edit fl">充值</button>');?>
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
                    <h4>(第<?php echo 1;?>期)<?php echo Html::anchor('/m/'.$item->phase_id, $getItemInfo($getPhaseInfo($item->phase_id)->item_id)->title);?></h4>
                    <div class="price">价值：<b><?php echo $getPhaseInfo($item->phase_id)->amount;?>.00</b></div>
                    <dl class="progress-side">
                        <dd>
                            <div class="progress">
                            <div class="progress-bar" style="width:<?php echo $getPhaseInfo($item->phase_id)->joined/$getPhaseInfo($item->phase_id)->amount * 100;?>%">
                            </div></div>
                        </dd>
                    </dl>

                    <?php echo Html::anchor('/m/'.$item->phase_id, '<button class="buy">去乐拍</button>');?>
                </div>
            </li>
        </ul>
        <?php } ?>

    </div>
    <div class="notice fr f2">
        <div class="title"><h4>乐拍公告 <span class="icon icon-horn"></span></h4></div>
        <ul>
            <?php foreach($getNotices() as $notice) { ?>
            <li><?php echo Html::anchor('/notice/'.$notice->id, $notice->title);?></li>
            <?php } ?>
        </ul>
    </div>
