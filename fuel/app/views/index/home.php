
        <div class="navbar-inner">
            <ul>
                <li class="active"><?php echo Html::anchor('u/'.$member->id, '主页');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/orders', '乐拍记录');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/wins', '获得的商品');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/posts', '晒单');?></li>
            </ul>
            <div class="home">
                <dl class="buy-menu">
                    <?php if($orders) { ?>
                    <?php $phases = $getPhaseInfos($orders); ?>
                    <?php foreach($orders as $oitem) { ?>
                    <?php $phase = $phases[$oitem->phase_id];?>
                    <dd><b><?php echo \Helper\Timer::friendlyDate($oitem->created_at);?></b>乐拍了 </dd>
                    <dd class="right-box">
                        <div class="img-box img-md fl">
                            <?php echo Html::anchor('m/'.$oitem->phase_id, Html::img($phase->image));?>
                        </div>
                        <div class="buy-record fl">
                            <h4>(第<?php echo $phase->phase_id; ?>期) <?php echo Html::anchor('m/'.$oitem->phase_id,
                                                                      $phase->title);?></h4>
                            <div class="price">价值：<b><?php echo $phase->amount;?>.00</b></div>
                            <dl class="progress-side">
                                <dd>
                                    <div class="progress">
                                    <div class="progress-bar" style="width:<?php echo $getProgress($oitem->phase_id);?>%">
                                    </div>
                                    </div>
                                </dd>
                            </dl>
                            <?php if ($getProgress($oitem->phase_id) != 100) { ?>
                                <?php echo Html::anchor('m/'.$oitem->phase_id, '<button class="btn btn-red">去乐拍</button>');?>
                            <?php }else{ ?>
                                <?php echo Html::anchor('w/'.$oitem->phase_id, '<button class="btn btn-red">去揭晓</button>');?>
                            <?php } ?>
                        </div>
                    </dd>
                    <?php } ?>
                    <?php } ?>
                </dl>

                <dl class="buy-menu">
                    <?php foreach($wins as $witem) { ?>
                    <dd>在<?php echo \Helper\Timer::friendlyDate($witem->created_at);?>获得了 </dd>
                    <dd class="right-box">
                        <div class="img-box img-md fl">
                            <?php echo Html::anchor('m/'.$witem->id, Html::img($witem->image));?>
                            <div class="icon-jx">
                                已揭晓
                            </div>
                        </div>
                        <div class="buy-record fl">
                            <h4>(第<?php echo $witem->phase_id; ?>期)<?php Html::anchor('m/'.$witem->id, $witem->title);?></h4>
                            <div class="price">价值：<b><?php echo $witem->amount; ?>.00</b></div>
                            <div class="number">幸运乐拍码：<s><?php echo $witem->code;?></s></div>
                            <div class="datetime">揭晓时间：<s><?php echo \Helper\Timer::friendlyDate($witem->opentime);?></s></div>
                            <?php echo Html::anchor('m/'.$witem->id, '<button class="btn btn-sm btn-red">查看详情</button>') ;?>
                        </div>
                    </dd>
                    <?php } ?>
                </dl>
            </div>
            <div class="record"></div>
            <div class="obtain"></div>
            <div class="single"></div>
        </div>
