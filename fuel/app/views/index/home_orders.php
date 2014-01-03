
<div class="navbar-inner">
        <ul>
            <li><?php echo Html::anchor('u/'.$member->id, '主页');?></li>
            <li><?php echo Html::anchor('u/'.$member->id.'/orders', '乐拍记录', ['class'=>'active']);?></li>
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
                        <h4><?php echo Html::anchor('m/'.$item->phase_id, $getPhaseInfo($item->phase_id)->title);?></h4>
                        <span class="price">价值 <b><?php echo $getItemInfo($getPhaseInfo($item->phase_id)->item_id)->price;?>.00</b></span>
                    </div>

                </dd>
                <!--<li>
                    <div class="img-box">
                        <a href=""><img src="img/54359.jpg" alt=""/></a>
                        <div class="icon-jx">已揭晓</div>
                    </div>
                    <!--<div class="title-box">
                        <h4><a href="">小米3智能手机(16G)</a></h4>
                        <span class="price">价值 <b>￥1999.00</b></span>
                        <div class="number">幸运乐拍码：<b class="y">10132132</b></div>
                        <div class="datetime">揭晓时间：2013-12-12 10:00:00</div>
                    </div>
                </li>  --> 
                <?php } ?>
               
            </dl>
            <br />
            <?php echo Pagination::instance('horders')->render();?>     
            <?php } else { ?>
            <p> 该用户暂时没任何的订单记录</p>
            <?php } ?>
        </div>
</div>
