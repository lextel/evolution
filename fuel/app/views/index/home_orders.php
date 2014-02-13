
<div class="home-navbar">
        <ul>
            <li><?php echo Html::anchor('u/'.$member->id, '主页');?></li>
            <li class="active"><?php echo Html::anchor('u/'.$member->id.'/orders', '乐拍记录');?></li>
            <li><?php echo Html::anchor('u/'.$member->id.'/wins', '获得的商品');?></li>
            <li><?php echo Html::anchor('u/'.$member->id.'/posts', '晒单');?></li>
        </ul>
</div>
<!--乐拍记录-->
        <div class="home-c">
            <?php if($orders) { ?>
            <?php $phases = $getPhaseInfos($orders);?>
            <dl>
                <?php foreach($orders as $item) { ?>
                <?php $phase = $phases[$item->phase_id]; ?>
                <dd>
                    <div class="img-box">
                        <?php echo Html::anchor('m/'.$item->phase_id, Html::img($phase->image));?>
                        <?php if ($phase->code != '') { ?>
                             <span class="icon-jx">已揭晓</span>
                            <?php } ?>
                    </div>
                    <div class="title-box">
                        <h3 class="title-sm"><?php echo Html::anchor('m/'.$item->phase_id, '(第'.$phase->phase_id.'期) '.$phase->title);?></h3>
                        <span class="price">价值：<b><?php echo $phase->amount;?>.00</b></span>
                        <?php if ($phase->code == '') { ?>
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
                                    <span class="fl">已参与人次</span>
                                    <span class="fr">剩余人次</span>
                                </dd>
                            </dl>
                        <?php }else{ ?>
                            <div class="number">幸运乐拍码：<b class="y"><?php echo $phase->code;?></b></div>
                            <div class="datetime">揭晓时间：<?php echo date("Y-m-d H:i:s", $phase->opentime);?></div>
                        <?php } ?>
                    </div>
                </dd>
                <?php } ?>

            </dl>
            <br />
            <?php echo Pagination::instance('horders')->render();?>
            <?php } else { ?>
            <p> 该用户暂时没任何的订单记录</p>
            <?php } ?>
        </div>
