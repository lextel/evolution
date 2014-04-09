<?php echo Asset::css(['product.css', 'style.css']);?>
<?php echo Asset::js(['wins/index.js']); ?>
 <div class="bread">
    <ul>
        <li><a href="<?php echo Uri::create('/')?>">首页</a></li>
        <li><em>&gt;</em></li>
        <li><a href="<?php echo Uri::create('w')?>">最新揭晓</a></li>
    </ul>
 </div>
<div class="latest-wrap w">
   <!--左边内容开始-->
    <div class="left-content">
        <div class="title">
            <h3>最新揭晓 <small>(截至目前共揭晓商品 <s class="red"><?php echo $count;?></s>件)</small></h3>
        </div>
        <ul class="item-group">
            <?php
                if($wins):
                list($members, $areas) = $getMembersByWin($wins);

                foreach($wins as $win):
                    if($win->member_id):
            ?>
            <li>
                <div class="item-head">
                    <h4 class="title-sm fl">
                       <a href="<?php echo Uri::create('w/'.$win->id); ?>">(第<?php echo $win->phase_id;?>期)<?php echo $win->title; ?></a>
                    </h4>
                    <div class="price black fr">价值:<b>￥<?php echo sprintf('%.2f', $win->amount); ?></b></div>
                </div>
                <div class="item-body">
                    <div class="img-box img-md fl">
                        <a href="<?php echo Uri::create('w/'.$win->id); ?>" rel="nofollow">
                            <img src="<?php echo \Helper\Image::showImage($win->image, '200x200');?>"/>
                        </a>
                    </div>
                    <div class="info-side fr">
                        <div class="h-info">
                            <div class="head-img fl">
                                <a href="<?php echo Uri::create('u/'.$win->member_id); ?>">
                                    <img src="<?php echo \Helper\Image::showImage($members[$win->member_id]->avatar, '60x60');?>"/>
                                </a>
                            </div>
                            <div class="user-info fl">
                                <div class="username">获奖者：<a href="<?php echo Uri::create('u/'.$win->member_id); ?>"><?php echo $members[$win->member_id]->nickname; ?></a></div>
                                <div class="ip">来自：<?php echo $areas[$win->order_id]->area; ?></div>
                            </div>
                        </div>
                        <div class="p-info">
                            <div class="number">本期乐淘：<b><?php echo $win->code_count; ?></b>元宝</div>
                            <div class="datetime">揭晓时间：<?php echo date('Y-m-d H:i:s', $win->opentime);?></div>
                        </div>
                    </div>
                </div>
                <div class="item-footer">
                    <div class="lucky-code fl">
                        <b>幸运乐淘码:</b><s class="r"><?php echo $win->code?></s>
                    </div>
                    <?php echo Html::anchor('w/'.$win->id, '查看详情', ['class'=>'btn btn-red latest-btn fr']); ?>
                </div>
            </li>
            <?php
            else:
            ?>
            <!--<li id="win<?php echo $win->id; ?>">
                <div class="item-body">
                    <div class="img-box img-md fl">
                        <a href="<?php echo Uri::create('m/'.$win->id); ?>" rel="nofollow">
                            <img src="<?php echo \Helper\Image::showImage($win->image, '200x200');?>"/>
                        </a>
                    </div>
                    <div class="info-side fr">
                        <div class="p-info">
                            <h5 class="title-sm">
                                <a href="<?php echo Uri::create('m/'.$win->id); ?>">(第<?php echo $win->phase_id;?>期)<?php echo $win->title; ?></a>
                            </h5>
                            <div class="price">价值：<b>￥<?php echo sprintf('%.2f', $win->amount); ?></b>元</div>
                        </div>
                        <dl class="countdown" style="min-height: 29px" endtime="<?php echo date('M d, Y H:i:s', $win->opentime);?>" phaseId="<?php echo $win->id;?>"></dl>
                        <div class="counting">
                            <h2>正在计算...</h2>
                        </div>
                    </div>
                </div>
                <div class="item-footer">
                    <span>即将揭晓，敬请期待...</span>
                </div>
            </li>-->
            <li class="active" id="win<?php echo $win->id; ?>">
                <div class="item-head">
                    <h4 class="title-sm fl">
                        <a href="<?php echo Uri::create('m/'.$win->id); ?>">(第<?php echo $win->phase_id;?>期)<?php echo $win->title; ?></a>
                    </h4>
                    <div class="price fr">价值：<b>￥<?php echo sprintf('%.2f', $win->amount); ?></b>元</div>
                </div>
                <div class="item-body">
                    <div class="img-box img-md fl">
                        <a href="<?php echo Uri::create('m/'.$win->id); ?>" rel="nofollow">
                            <img src="<?php echo \Helper\Image::showImage($win->image, '200x200');?>"/>
                        </a>
                    </div>
                    <div class="info-side fr">
                        <dl class="countdown" style="min-height: 29px" endtime="<?php echo date('M d, Y H:i:s', $win->opentime);?>" phaseId="<?php echo $win->id;?>">
                        </dl>
                        <!--计算中-->
                    </div>
                    <div class="counting fr" style="display:none">
                          正在计算...
                    </div>
                    <i class="icon-jxiao"></i>
                </div>
                <div class="item-footer">
                    <p>即将揭晓，敬请期待...</p>
                </div>
            </li>
            <?php
            endif;
            endforeach;
            else:
                echo '<p style="margin-top: 20px; margin-left: 10px">暂时还没有人中奖.</p>';
            endif;
            ?>
        </ul>
        <?php echo Pagination::instance('winspage')->render(); ?>
    </div>
    <!--左边内容右边-->
    <!--右边内容开始-->
    <div class="right-box fr">
        <!--大家正在乐淘内容开始-->
        <div class="buying-box box2">
            <div class="title"><h3>大家正在乐淘</h3></div>
            <div class="buyListdiv" >
                <ul class="buyList">
                <?php $orders1 = $orders();
                       list($members,$phaseByOrders)  = $getMembersByOrder($orders1);
                ?>
                <?php foreach($orders1 as $order) {?>
                    <li>
                        <div class="img-wide fl">
                            <a href="<?php echo Uri::create('m/'.$order->phase_id); ?>" rel="nofollow">
                                <img src="<?php echo \Helper\Image::showImage($phaseByOrders[$order->phase_id]->image, '80x80');?>"/>
                            </a>
                        </div>
                        <div class="info-side">
                            <div class="username"><?php echo Html::anchor('u/'.$order->member_id, $members[$order->member_id]->nickname, ['class'=>'bule']);?> 刚刚乐淘了</div>
                            <h4 class="title-br"><?php echo Html::anchor('m/'.$order->phase_id, $phaseByOrders[$order->phase_id]->title);?></h4>
                        </div>
                    </li>
               <?php } ?>
            </ul>
            </div>
        </div>
        <!--大家正在乐淘内容结束-->
        <!--人气排行内容开始-->
        <div class="sort-list">
            <div class="title"><h3>人气排行</h3></div>
            <ul>
                <?php
                    $hots = $hotItems();
                    $i = 1;
                    foreach($hots as $hot):
                ?>
                <li>
                    <div class="shortItem" style="display: <?php echo $i == 1 ? 'none' : 'block'; ?>">
                        <div class="img-box img-sm fl">
                            <a href="<?php echo Uri::create('m/'.$hot->id); ?>" rel="nofollow">
                                <img src="<?php echo \Helper\Image::showImage($hot->image, '80x80');?>"/>
                            </a>
                            <div class="top <?php echo $i < 4 ? 'one' : '';?>"><?php echo $i; ?></div>
                        </div>
                        <div class="info-side fr">
                            <div class="title-sm"><a href=""><?php echo $hot->title; ?></a></div>
                            <div class="remain">还需元宝: <b class="red"><?php echo $hot->remain; ?></b></div>
                        </div>
                    </div>
                    <div class="longItem" style="display: <?php echo $i == 1 ? 'block' : 'none'; ?>">
                        <form  action="<?php echo Uri::create('cart/add'); ?>" method="post">
                            <div class="title-box">
                                <h4 class="title-br"><?php echo Html::anchor('/m/'.$hot->id, $hot->title); ?></h4>
                                <span class="price tr">价值 <b>￥<?php echo sprintf('%.2f', $hot->amount); ?></b></span>
                            </div>
                            <div class="img-box">
                                <a href="<?php echo Uri::create('m/'.$hot->id); ?>" rel="nofollow">
                                    <img src="<?php echo \Helper\Image::showImage($hot->image, '200x200');?>"/>
                                </a>
                            </div>
                            <div class="remain tc">还需元宝: <b class="red"><?php echo $hot->remain; ?></b></div>
                            <div class="btn-group">
                                <input name="qty" value="1" type="hidden"/>
                                <input name="id" value="<?php echo $hot->id; ?>" type="hidden">
                                <button type="submit" class="btn btn-red btn-w">立即一元乐淘</button>
                            </div>
                            <div class="top2 <?php echo $i < 4 ? 'one' : '';?>"><?php echo $i; ?></div>
                        </form>
                    </div>

                </li>
                <?php
                    $i++;
                    endforeach;
                ?>
            </ul>
        </div>
        <!--人气排行内容结束-->
    </div>
</div>

<script>
    RESULT_URL = '<?php echo Uri::create('w/result'); ?>';
</script>
