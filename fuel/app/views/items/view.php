<?php echo Asset::css(['product.css', 'jquery.jqzoom.css', 'customBootstrap.css', 'style.css']); ?>
<?php echo Asset::js(['jquery.jqzoom-core.js', 'bootstrap.min.js','jquery.pin.js', 'item/view.js']); ?>
<?php $this->title = '(第' . $item->phase->phase_id .'期)' . $item->title; ?>
<div class="wrapper w">
    <!--商品信息开始-->
    <div class="panel w">
        <div class="title">
            <h2>
                <b>(第<?php echo $item->phase->phase_id; ?>期)</b>
                <?php echo $item->title; ?>
            </h2>
        </div>
        <div class="img-side fl">
            <!--幻灯片开始-->
            <div class="lantern-slide">
                <div class="slide-img">
                    <a href="<?php echo Uri::create('/image/600x600/' .$item->image); ?>" class="jqzoom" rel="gal1">
                        <img src="<?php echo Uri::create('/image/400x400/' . $item->image); ?>" alt=""/>
                    </a>
                </div>
                <ul class="slide-list" id="thumblist">
                    <?php
                        $images = unserialize($item->images);
                        foreach($images as $image):
                    ?>
                    <li>
                        <a class="<?php echo $image == $item->image ? 'zoomThumbActive' : ''; ?>" rel='<?php echo $getZoom($image);?>'>
                            <img src="<?php echo Uri::create('/image/80x80/' . $image); ?>" alt=""/>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!--幻灯片结束-->
            <?php 
                if($prevWinner):
                $winner = $getMember($prevWinner->member_id);
            ?>
            <!--获奖者开始-->
            <div class="previous-box">
                <div class="img-box fl"><a href="<?php Uri::create('u/'.$winner->id); ?>"><img src="<?php echo Uri::create($winner->avatar); ?>" alt=""></a></div>
                <div class="info-side fl">
                    <div class="winner">获得者<a href="<?php Uri::create('u/'.$winner->id); ?>"><b><?php echo $winner->nickname; ?></b></a></div>
                    <span class="announce-time">揭晓时间：<b><?php echo date('Y-m-d H:i:s', $prevWinner->opentime); ?></b></span>
                    <span class="buy-time">乐拍时间：<b><?php echo date('Y-m-d H:i:s', $prevWinner->order_created_at); ?></b></span>
                    <span class="buy-number">幸运码：<b class="red"><?php echo $prevWinner->code; ?></b></span>
                </div>
            </div>
            <!--获奖者结束-->
            <?php endif; ?>
        </div>
        <div class="product-column fr">
            <div class="state-heading">
                <span>本商品已有 <b class="blue">20</b>位幸运者晒单，<b class="blue">40</b>评论</span>
            </div>
            <div class="price">价值:<b><?php echo sprintf('%.2f', $item->price); ?></b></div>
            <dl class="progress-side">
                <dd>
                    <div class="progress"><div class="progress-bar" style="width: <?php echo sprintf('%.2f', $item->phase->joined/$item->phase->amount*100); ?>%"></div></div>
                </dd>
                <dd>
                    <span class="fl red"><?php echo $item->phase->joined; ?></span>
                    <span class="fr blue"><?php echo $item->phase->remain; ?></span>
                </dd>
                <dd>
                    <span class="fl">已参与人次</span>
                    <span class="fr">剩余人次</span>
                </dd>
            </dl>
            <form action="<?php echo Uri::create('/cart/add'); ?>" method="post">
                <div class="btn-menu">
                    <span>购买数量：</span>
                    <a class="add btn-jian">-</a>
                    <input type="text" value="1" name="qty">
                    <a class="add btn-jia">+</a>
                    <span>人次</span>
                    <span>获得x几率：<s class="red">0.00%</s> </span>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-red">立即乐拍</button>
                    <button class="btn btn-default">加入购物车</button>
                    <input type="hidden" value="<?php echo $item->phase->id ?>" name="id"/>
                </div>
            </form>
            <ul class="security-list">
                <li><a href="" class="01">100%公平公正</a></li>
                <li><a href="" class="02">100%正品保证</a></li>
                <li><a href="" class="03">全国免费配送</a></li>
            </ul>
            <div class="new-buyer">
                <div class="new-buyer-header">
                    <ul class="tab">
                        <li class="active"><a href="#buy" data-toggle="tab">最新乐拍记录</a></li>
                        <li><a href="#myBuy" data-toggle="tab">我的乐拍记录</a></li>
                        <li><a href="#help" data-toggle="tab">如何乐拍</a></li>
                    </ul>
                 </div>
                <div class="new-buyer-body tab-content">
                    <div class="tab-pane active" id='buy'>
                        <table>
                            <tbody>
                                <?php
                                    if($newOrders):
                                        foreach($newOrders as $newOrder):
                                        $member = $getMember($newOrder->member_id);
                                    ?>
                                    <tr>
                                        <td><div class="img-box"><a href="<?php echo Uri::create('u/'.$member->id); ?>"><img src="<?php echo Uri::create($member->avatar); ?>" alt=""></a></div></td>
                                        <td><?php echo $member->nickname; ?></td>
                                        <td><!--s>(广东深圳市)</s--><b><?php echo $friendlyDate($newOrder->created_at); ?></b></td>
                                        <td>乐拍了<s><?php echo $newOrder->code_count; ?></s>次</td>
                                    </tr>
                                <?php
                                        endforeach;
                                    else:
                                    echo '<tr><td>暂时没有乐拍记录.</td></tr>';
                                    endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="myBuy">
                        <table>
                            <tbody>
                                <?php
                                    if(!is_null($current_user)) :
                                    if($myOrders):
                                        foreach($myOrders as $myOrder):
                                    ?>
                                    <tr>
                                        <td><div class="img-box"><a href="<?php echo Uri::create('u/'.$current_user->id); ?>"><img src="<?php echo Uri::create($current_user->avatar); ?>" alt=""></a></div></td>
                                        <td><?php echo $current_user->nickname; ?></td>
                                        <td><!--s>(广东深圳市)</s--><b><?php echo $friendlyDate($myOrder->created_at); ?></b></td>
                                        <td>乐拍了<s><?php echo $myOrder->code_count; ?></s>次</td>
                                    </tr>
                                <?php
                                        endforeach;
                                    else:
                                    echo '<tr><td>暂时没有乐拍记录.</td></tr>';
                                    endif;
                                    else:
                                ?>
                                <form action="<?php echo Uri::create('signin'); ?>" method="post">
                                    <ul class="edit-data" style="display: block;">
                                        <li>
                                            <label>帐号：</label>
                                            <input type="text" name="username">
                                        </li>
                                        <li>
                                            <label>密码：</label>
                                            <input type="password" name="password">
                                        </li>
                                        <li>
                                            <button type="submit" class="btn btn-red">登录</button>
                                            <a href="<?php echo Uri::create('signup'); ?>">注册</a>
                                        </li>
                                    </ul>
                                </form>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="help">
                        <p>1元云购是指只需1元就有机会买到想要的商品。即每件商品被平分成若干“等份”出售，每份1元，
                         当一件商品所有“等份”售出后，根据云购规则产生一名幸运者，该幸运者即可获得此商品。
                        </p>
                        <p>
                        1元云购以“快乐云购，惊喜无限”为宗旨，力求打造一个100%公平公正、100%正品保障、
                        寄娱乐与购物一体化的新型购物网站。
                        </p>
                        <a href="<?php echo Uri::create('h/new'); ?>" class="link">查看更多</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="bd w">
		<div class="sub-nav w" id="bigNav">
        <ul>
            <li><a href="#desc" data-toggle="tab" class="active">商品详情</a></li>
            <li><a href="#buylog" phaseId="<?php echo $item->phase->id; ?>" data-toggle="tab">所有参与纪录(<b><?php echo $orderCount; ?></b>)</a></li>
            <li><a href="#posts" itemId="<?php echo $item->id; ?>" data-toggle="tab">晒单(<b><?php echo $postCount; ?></b>)</a></li>
            <li><a href="#phase" itemId="<?php echo $item->id; ?>" data-toggle="tab">往期回顾(<b><?php echo $phaseCount; ?></b>)</a></li>
        </ul>
    </div>
    <!--商品信息结束-->
    <div class="content tab-content">
        <!--商品详情开始-->
        <div class="product-details tab-pane active" id="desc">
            <?php echo $item->desc; ?>
        </div>
        <!--商品详情结束-->
        <!--参与记录开始-->
        <div class="record d-n tab-pane" id="buylog">
            <p style="margin-bottom: 15px;text-align: center">暂无参与记录</p>
        </div>
        <!--参与记录结束-->
        <!--晒单开始-->
        <div class="product-bask tab-pane" id="posts">
            <p style="margin-bottom: 15px;text-align: center">暂无晒单记录</p>
        </div>
        <!--晒单结束-->
        <!--往期回顾开始-->
        <div  class="look-bak d-n tab-pane" id="phase"></div>
    </div>
	</div>
    
</div>
<script>
    BUYLOG_URL   = '<?php echo Uri::create('l/joined'); ?>';
    POSTLOG_URL  = '<?php echo Uri::create('l/posts'); ?>';
    PHASELOG_URL = '<?php echo Uri::create('l/phases'); ?>';
</script>
<script>
    $(".sub-nav").pin({
        containerSelector: ".w"
    })
</script>

