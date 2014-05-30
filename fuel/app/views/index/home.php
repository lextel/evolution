<div class="home-navbar">
     <ul>
         <li class="active"><?php echo Html::anchor('u/'.$member->id, '主页');?></li>
         <li><?php echo Html::anchor('u/'.$member->id.'/orders', '乐淘记录');?></li>
         <li><?php echo Html::anchor('u/'.$member->id.'/wins', '获得的商品');?></li>
         <li><?php echo Html::anchor('u/'.$member->id.'/posts', '晒单');?></li>
     </ul>
</div>
 <div class="home">
                <dl class="buy-menu">
                    <?php if($orders) { ?>
                    <?php $phases = $getPhaseInfos($orders); ?>
                    <?php foreach($orders as $oitem) { ?>
                    <?php $phase = $phases[$oitem->phase_id];?>
                    <dt><b><?php echo \Helper\Timer::friendlyDate($oitem->created_at);?></b>乐淘了 </dt>
                    <dd class="right-box">
                        <div class="img-box img-md fl">
                            <a href="<?php echo Uri::create('m/'.$oitem->phase_id); ?>" rel="nofollow">
                                <img src="<?php echo \Helper\Image::showImage($phase->image, '200x200');?>"/>
                            </a>
                            <?php if ($getProgress($phase) == 100) { ?>
                             <span class="icon-jx">已揭晓</span>
                            <?php } ?>
                        </div>
                        <div class="buy-record fl">
                            <h4>(第<?php echo $phase->phase_id; ?>期) <?php echo Html::anchor('m/'.$oitem->phase_id,$phase->title, ['class'=>'b']);?></h4>
                            <div class="price">价值：￥<b><?php echo $phase->amount;?>.00</b></div>                            
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
                                    <span class="fl">已攒元</span>
                                    <span class="fr">还需元</span>
                                </dd>
                                </dl>
                                <?php echo Html::anchor('m/'.$oitem->phase_id, '<button class="btn-red btn-topUp">去乐淘</button>');?>
                            <?php }else{ ?>
                                <div class="number">幸运乐淘码：<b class="y"><?php echo $phase->code;?></b></div>
                                <div class="datetime">揭晓时间：<?php echo date("Y-m-d H:i:s", $phase->opentime);?></div>
                                <?php echo Html::anchor('w/'.$oitem->phase_id, '<button class="btn-topUp btn-y">查看详情</button>');?>
                            <?php } ?>
                            
                        </div>
                    </dd>
                    <?php } ?>
                    <?php } ?>
                </dl
            </div>
            <div class="record"></div>
            <div class="obtain"></div>
            <div class="single"></div>
