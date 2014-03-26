        <div class="home-navbar">
            <ul>
                <li><?php echo Html::anchor('u/'.$member->id, '主页');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/orders', '乐淘记录');?></li>
                <li class="active"><?php echo Html::anchor('u/'.$member->id.'/wins', '获得的商品');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/posts', '晒单');?></li>
            </ul>
        </div>
 <!--获得的商品-->
            <div class="home-c">
                <?php if($wins) { ?>
                <dl>
                    <?php foreach($wins as $item) { ?>
                    <dd>
                        <div class="img-box">
                            <a href="<?php echo Uri::create('m/'.$item->id); ?>" rel="nofollow">
                                <img src="<?php echo \Helper\Image::showImage($item->image, '200x200');?>"/>
                            </a>
                        </div>
                        <div class="title-box">
                            <h3 class="title-sm"><?php echo Html::anchor('m/'.$item->id, '第('.$item->phase_id.')期 '.$item->title);?></h3>
                            <span class="price">价值：￥<b><?php echo $item->amount;?>.00</b></span>
                            <div class="number">幸运乐淘码：<b class="y"><?php echo $item->code;?></b></div>
                            <div class="datetime">揭晓时间：<?php echo \Helper\Timer::friendlyDate($item->opentime);?></div>
                        </div>
                    </dd>
                    <?php } ?>
                </dl>
                 <?php echo Pagination::instance('hwins')->render();?>
                 <?php } else { ?>
                 <p> 该用户暂时没任何的中奖记录</p>
                 <?php } ?>
            </div>
