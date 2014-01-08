
<div class="navbar-inner">
        <ul>
            <li><?php echo Html::anchor('u/'.$member->id, '主页');?></li>
            <li class="active"><?php echo Html::anchor('u/'.$member->id.'/orders', '乐拍记录');?></li>
            <li><?php echo Html::anchor('u/'.$member->id.'/wins', '获得的商品');?></li>
            <li><?php echo Html::anchor('u/'.$member->id.'/posts', '晒单');?></li>
        </ul>
        <!--乐拍记录-->
        <br />
        <div class="home-c">
            <?php if($orders) { ?>
            <dl>
                <?php foreach($orders as $item) { ?>
                <dd>
                    <div class="img-box">
                        <?php echo Html::anchor('m/'.$item->phase_id, Html::img($getItemInfo($getPhaseInfo($item->phase_id)->item_id)->image));?>
                    </div>
                    <div class="title-box">
                        <h4><?php echo Html::anchor('m/'.$item->phase_id, '(第'.$getPhaseInfo($item->phase_id)->phase_id.'期) '.$getPhaseInfo($item->phase_id)->title);?></h4>
                        <span class="price">价值 <b><?php echo $getItemInfo($getPhaseInfo($item->phase_id)->item_id)->price;?>.00</b></span>
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
</div>
