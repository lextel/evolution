<?php echo Asset::css(['product.css', 'style.css']);?>
<div class="latest-wrap w">
   <!--左边内容开始-->
    <div class="left-content">
        <div class="title">
            <h4>最新揭晓 <small>(截至目前共揭晓商品 <s class="red"><?php echo $count;?></s>件)</small></h4>
        </div>
        <ul class="item-group">
            <?php
                if($wins):
                foreach($wins as $win):
                    $itemInfo = $getItemInfo($win->item_id);
                    if($win->member_id):
                    $memberInfo = $getMemberInfo($win->member_id);
            ?>
            <li>
                <div class="item-body">
                    <div class="img-box img-md fl">
                        <a href="<?php echo Uri::create('w/'.$win->id); ?>"><img src="<?php echo Uri::create($itemInfo->image);?>"></a>
                    </div>
                    <div class="info-side fr">
                        <div class="head-img fl">
                            <a href="<?php echo Uri::create('u/'.$win->member_id); ?>"><img src="<?php echo Uri::create($memberInfo->avatar); ?>"/></a>
                        </div>
                        <div class="user-info fl">
                            <div class="winner">获奖者：<b><a href="<?php echo Uri::create('u/'.$win->member_id); ?>"><?php echo $memberInfo->nickname; ?></a></b></div>
                            <div class="ip">来自：未知</div>
                            <div class="number">乐拍:<b><?php echo $win->code_count; ?></b>人次</div>
                        </div>
                        <div class="p-info">
                            <h5 class="title-sm">
                                <a href="<?php echo Uri::create('w/'.$win->id); ?>">(第<?php echo $win->phase_id;?>期)<?php echo $itemInfo->title; ?></a>
                            </h5>
                            <div class="price">价值：<b>￥<?php echo sprintf('%.2f', $itemInfo->price); ?></b>元</div>
                            <div class="datetime">揭晓时间：<?php echo $friendlyDate($win->opentime);?></div>
                        </div>
                    </div>
                </div>
                <div class="item-footer">
                    <div class="lucky-code fl">
                        幸运乐拍码:<b><?php echo $win->code?></b>
                    </div>
                    <?php echo Html::anchor('w/'.$win->id, '查看详情', ['class'=>'btn btn-default fr']); ?>
                </div>
            </li>
            <?php
            else:
            ?>
            <li>
                <div class="item-body">
                    <div class="img-box img-md fl">
                        <a href="<?php echo Uri::create('m/'.$win->id); ?>"><img src="<?php echo $itemInfo->image; ?>" alt=""/></a>
                    </div>
                    <div class="info-side fr">
                        <div class="p-info">
                            <h5 class="title-sm">
                                <a href="<?php echo Uri::create('m/'.$win->id); ?>">(第<?php echo $win->phase_id;?>期)<?php echo $itemInfo->title; ?></a>
                            </h5>
                            <div class="price">价值：<b>￥<?php echo sprintf('%.2f', $itemInfo->price); ?></b>元</div>
                        </div>
                        <dl class="countdown">
                            <dt>倒计时</dt>
                            <dd>01</dd>
                            <dt>:</dt>
                            <dd>08</dd>
                            <dt>:</dt>
                            <dd>37</dd>
                        </dl>
                    </div>
                </div>
                <div class="item-footer">
                    <span>即将揭晓，敬请期待...</span>
                </div>
            </li>
            <?php
            endif;
            endforeach;
            else:
                echo '<p>暂时还没有人中奖.</p>';
            endif;
            ?>
        </ul>
        <?php echo Pagination::instance('winspage')->render(); ?>
    </div>
    <!--左边内容右边-->
    <!--右边内容开始-->
    <div class="right-box fr">
        <!--大家正在乐拍内容开始-->
        <div class="buying-box">
            <div class="title"><h4>大家正在乐拍</h4></div>
            <ul>
                <?php foreach($orders() as $order) {?>
                    <li>
                        <div class="head-img fl">
                            <?php echo Html::anchor('m/'.$order->phase_id, '<img src="http://www.llt.com/'.$getItemInfo($getPhaseInfo($order->phase_id)->item_id)->image.'" alt="" />');?>
                        </div>
                        <div class="info-side">
                            <div class="winner"><?php echo Html::anchor('u/'.$order->member_id, $getMemberInfo($order->member_id)->nickname, ['class'=>'bule']);?> 刚刚乐拍了</div>
                            <h4><?php echo Html::anchor('m/'.$order->phase_id, $getPhaseInfo($order->phase_id)->title);?></h4>
                        </div>

                    </li>
               <?php } ?>
            </ul>
        </div>
        <!--大家正在乐拍内容结束-->
        <!--人气排行内容开始-->
        <div class="sort-list">
            <div class="title"><h4>人气排行</h4></div>
            <ul>
                <li>
                    <div class="img-box fl">
                        <a href=""><img src="img/54359.jpg" alt=""></a>
                    </div>
                    <div class="info-side fr">
                        <h4><a href="">苹果智能手机32G苹果智能手机32G苹果智能手机</a></h4>
                        <div class="remain">剩余次数: <b class="red">0</b></div>
                    </div>
                    <div class="top one">1</div>
                </li>
                <li class="active">
                    <div class="title-box">
                        <h4><a href="">小米3智能手机(16G)</a></h4>
                        <span class="price">价值 <b>￥1999.00</b></span>
                    </div>
                    <div class="img-box">
                        <a href=""><img src="img/54359.jpg" alt=""></a>
                    </div>
                    <div class="remain tc">剩余次数: <b class="red">0</b></div>
                    <div class="btn-group">
                        <div class="btn btn-red">立即购买</div>
                    </div>
                    <div class="top one">1</div>
                </li>
                <li>
                    <div class="img-box fl">
                        <a href=""><img src="img/54359.jpg" alt=""></a>
                    </div>
                    <div class="info-side fr">
                        <h4><a href="">苹果智能手机32G苹果智能手机32G苹果智能手机</a></h4>
                        <div class="remain">剩余次数: <b class="red">0</b></div>
                    </div>
                    <div class="top one">3</div>
                </li>
                <li>
                    <div class="img-box fl">
                        <a href=""><img src="img/54359.jpg" alt=""></a>
                    </div>
                    <div class="info-side fr">
                        <h4><a href="">苹果智能手机32G苹果智能手机32G苹果智能手机</a></h4>
                        <div class="remain">剩余次数: <b class="red">0</b></div>
                    </div>
                    <div class="top">4</div>
                </li>
            </ul>
        </div>
        <!--人气排行内容结束-->
    </div>
</div>
