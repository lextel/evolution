        <div class="main fr">
            <ul class="subNav">
                <li><?php echo Html::anchor('u/'.$member->id, '主页');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/orders', '乐拍记录');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/wins', '获得的商品');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/posts', '晒单');?></li>
            </ul>
            <!--获得的商品-->
            <div class="home-c">
                <?php if($wins) { ?>
                <ul>
                    <?php foreach($wins as $item) { ?>
                    <li>
                        <div class="img-box">
                            <?php echo Html::anchor('m/'.$item->phase_id, Html::img($getItemInfo($item->item_id)->image));?>
                        </div>
                        <div class="title-box">
                            <h4><?php echo Html::anchor('m/'.$item->phase_id, $getItemInfo($item->item_id)->title);?></h4>
                            <span class="price">价值 <b>￥<?php echo $getItemInfo($item->item_id)->price;?></b></span>
                            <div class="number">幸运乐拍码：<b class="y"><?php echo $item->code;?></b></div>
                            <div class="datetime">揭晓时间：<?php echo \Helper\Timer::friendlyDate($getPhaseInfo($item->phase_id)->opentime);?></div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                 <?php echo Pagination::instance('hwins')->render();?>  
                 <?php } else { ?>
                 <p> 该用户暂时没任何的晒单记录</p>
                 <?php } ?>
            </div>
        </div>
