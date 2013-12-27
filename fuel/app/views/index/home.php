
        <div class="main fr">
            <ul class="subNav">
                <li><?php echo Html::anchor('u/'.$member->id, '主页');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/orders', '乐拍记录');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/wins', '获得的商品');?></li>
                <li><?php echo Html::anchor('u/'.$member->id.'/posts', '晒单');?></li>
            </ul>
            <div class="home">
                <ul class="buy-menu">
                    <?php foreach($orders as $oitem) { ?>
                    <li><b><?php echo date('Y-m-d H:i:s', $oitem->created_at);?></b>乐拍了 </li>
                    <li class="right-box">
                        <div class="img-box fl">
                            <?php echo Html::anchor('m/'.$oitem->phase_id, Html::img($oitem->phase_id));?>
                        </div>
                        <div class="buy-record fl">
                            <h4>(第13期)<a href="">微软平板32G10.6英寸电脑</a></h4>
                            <div class="price">价值：<b>2999.00</b></div>
                            <dl class="progress-side">
                                <dd>
                                    <div class="progress"><div class="progress-bar"></div></div>
                                </dd>
                            </dl>
                            <button class="buy">去乐拍</button>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                
                <ul class="buy-menu">
                    <?php foreach($wins as $witem) { ?>
                    <li>在今天<b>12:24</b>获得了 </li>
                    <li class="right-box">
                        <div class="img-box fl">
                            <a href=""><img src="img/54359.jpg" alt=""/></a>
                            <div class="icon-jx">
                                已揭晓
                            </div>
                        </div>
                        <div class="buy-record fl">
                            <h4>(第13期)<a href="">微软平板32G10.6英寸电脑</a></h4>
                            <div class="price">价值：<b>2999.00</b></div>
                            <div class="number">幸运乐拍码：<s>100000</s></div>
                            <div class="datetime">揭晓时间：<s>2999.00</s></div>
                            <button class="buy">查看详情</button>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <ul class="buy-menu">
                    <?php foreach($posts as $pitem) { ?>
                    <li>在今天<b>12:24</b>晒单了 </li>
                    <li class="right-box">
                        <div class="img-box fl">
                            <a href=""><img src="img/54359.jpg" alt=""/></a>
                            <div class="icon-jx">
                                已揭晓
                            </div>
                        </div>
                        <div class="buy-record fl">
                            <h4>(第13期)<a href="">微软平板32G10.6英寸电脑</a></h4>
                            <div class="price">价值：<b>2999.00</b></div>
                            <div class="number">幸运乐拍码：<s>100000</s></div>
                            <div class="datetime">揭晓时间：<s>2999.00</s></div>
                            <button class="buy">查看详情</button>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="record">
            </div>
            <div class="obtain"></div>
            <div class="single"></div>
        </div>
