
        <div class="navbar-inner">
            <ul>
                <li><?php echo Html::anchor('u/'.$member->id, '主页');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/orders', '乐拍记录');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/wins', '获得的商品');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/posts', '晒单');?></li>
            </ul>
            <div class="home">
                <dl class="buy-menu">
                    <?php foreach($orders as $oitem) { ?>
                    <dd><b><?php echo \Helper\Timer::friendlyDate($oitem->created_at);?></b>乐拍了 </dd>
                    <dd class="right-box">
                        <div class="img-box fl">
                            <?php echo Html::anchor('m/'.$oitem->phase_id, Html::img($getItemInfo($getPhaseInfo($oitem->phase_id)->item_id)->image));?>
                        </div>
                        <div class="buy-record fl">
                            <h4>(第<?php echo $getPhaseInfo($oitem->phase_id)->phase_id; ?>期)<?php Html::anchor('m/'.$oitem->phase_id, 
                                                                      $getItemInfo($getPhaseInfo($oitem->phase_id)->item_id)->title);?></h4>
                            <div class="price">价值：<b><?php echo $getItemInfo($getPhaseInfo($oitem->phase_id)->item_id)->price;?>.00</b></div>
                            <dl class="progress-side">
                                <dd>
                                    <div class="progress">
                                    <div class="progress-bar" style="width:<?php echo $getPhaseInfo($oitem->phase_id)->joined/$getPhaseInfo($oitem->phase_id)->amount * 100;?>%">
                                    </div>
                                    </div>
                                </dd>
                            </dl>
                            <?php echo Html::anchor('m/'.$oitem->phase_id, '<button class="buy">去乐拍</button>');?>
                        </div>
                    </dd>
                    <?php } ?>
                </dl>
                
                <dl class="buy-menu">
                    <?php foreach($wins as $witem) { ?>
                    <dd>在<?php echo \Helper\Timer::friendlyDate($witem->created_at);?>获得了 </dd>
                    <dd class="right-box">
                        <div class="img-box fl">
                            <?php echo Html::anchor('m/'.$witem->phase_id, Html::img($getItemInfo($witem->item_id)->image));?>
                            <div class="icon-jx">
                                已揭晓
                            </div>
                        </div>
                        <div class="buy-record fl">
                            <h4>(第<?php echo $getPhaseInfo($witem->phase_id)->phase_id; ?>期)<?php Html::anchor('m/'.$witem->phase_id, $getItemInfo($witem->item_id)->title);?></h4>
                            <div class="price">价值：<b><?php echo $getItemInfo($witem->item_id)->price; ?>.00</b></div>
                            <div class="number">幸运乐拍码：<s><?php echo $witem->code;?></s></div>
                            <div class="datetime">揭晓时间：<s><?php echo \Helper\Timer::friendlyDate($getPhaseInfo($witem->phase_id)->opentime);?></s></div>
                            <?php echo Html::anchor('m/'.$witem->phase_id, '<button class="buy">查看详情</button>') ;?>
                        </div>
                    </dd>
                    <?php } ?>
                </dl>
                <dl class="buy-menu">
                    <?php foreach($posts as $pitem) { ?>
                    <dd>在<?php echo \Helper\Timer::friendlyDate($pitem->created_at);?>晒单了 </dd>
                    <dd class="right-box">
                        <div class="img-box fl">
                            <?php echo Html::anchor('/p/'.$pitem->id, $pitem->title);?>
                        </div>
                             <?php echo Html::anchor('/p/'.$pitem->id, "详情>>");?>
                    </dd>
                    <?php } ?>
                </dl>
            </div>
            <div class="record">
            </div>
            <div class="obtain"></div>
            <div class="single"></div>
        </div>
