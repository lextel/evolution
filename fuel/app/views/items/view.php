<?php echo Asset::css(['product.css', 'jquery.jqzoom.css', 'customBootstrap.css', 'style.css']); ?>
<?php echo Asset::js(['jquery.jqzoom-core.js', 'bootstrap.min.js','jquery.pin.js', 'item/view.js']); ?>
<?php $this->title = '(第' . $item->phase->phase_id .'期)' . $item->title; ?>
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
                    <a href="<?php echo Uri::create('/image/600x600/' .$item->image); ?>" class="jqzoom" rel="zoom">
                        <img src="<?php echo Uri::create('/image/400x400/' . $item->image); ?>" alt=""/>
                    </a>
                </div>
                <ul class="slide-list" id="thumblist">
                    <?php
                        $images = unserialize($item->images);
                        foreach($images as $image):
                    ?>
                    <li>
                        <a class="<?php echo $image == $item->image ? 'zoomThumbActive' : ''; ?>" rel='<?php echo str_replace('\/', '/', $getZoom($image));?>'>
                            <img src="<?php echo Uri::create('/image/80x80/' . $image); ?>" alt=""/>
                            <span></span>
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
                <div class="title"><h3>上期获奖者</h3></div>
                <div class="head-img fl"><a href="<?php Uri::create('u/'.$winner->id); ?>"><img src="<?php echo Uri::create($winner->avatar); ?>" alt=""></a></div>
                <div class="info-side fl">
                    <div class="username">获得者：<a href="<?php Uri::create('u/'.$winner->id); ?>"><b><?php echo $winner->nickname; ?></b></a></div>
                    <span class="datetime">揭晓时间：<b><?php echo date('Y-m-d H:i:s', $prevWinner->opentime); ?></b></span>
                    <span class="datetime">乐拍时间：<b><?php echo date('Y-m-d H:i:s', $prevWinner->order_created_at); ?></b></span>
                    <span class="number">幸运码：<b class="red"><?php echo $prevWinner->code; ?></b></span>
                </div>
            </div>
            <!--获奖者结束-->
            <?php endif; ?>
        </div>
        <?php
            Config::load('common');
            $unit = Config::get('unit');
        ?>
        <div class="product-column fr">
            <div class="state-heading">
                <span class="icon icon-horn"></span>
                <span>本商品已有 <b class="blue"><?php echo $postsCount($item->id); ?></b>位幸运者晒单，<b class="blue"><?php echo $commentCount($item->id); ?></b>评论</span>
            </div>
            <div class="middle">
            <div class="price">价值:<b>￥<?php echo sprintf('%.2f', $item->price); ?></b></div>
            <div class="price">总积分:<b><?php echo $item->phase->cost; ?><?php echo $unit; ?></b></div>
            <?php if(!empty($item->phase->remain)): ?>
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
                    <a class="add btn-jian" href="javascript:void(0);">-</a>
                    <input type="text" value="1" name="qty" amount="<?php echo $item->phase->amount; ?>" remain="<?php echo $item->phase->remain; ?>">
                    <a class="add btn-jia" href="javascript:void(0);">+</a>
                    <span>(剩余<?php echo $item->phase->remain; ?>人次)</span>
                    <span class="chance">获得几率：<s class="red" id="percent"><?php echo sprintf('%.2f', 1/$item->phase->amount*100); ?>%</s> </span>
                </div>
                <div class="btn-group">
                    <input type="hidden" value="<?php echo $item->phase->id ?>" name="id"/>
                    <button type="submit" class="btn btn-red">立即乐拍</button>
                    <a class="btn btn-y doAddCart" href="javascript:void(0);" phaseId="<?php echo $item->phase->id; ?>">加入购物车</a>
                </div>
            </form>
            <?php else: ?>
            <!--已卖完-->
            <div class="sell-out" style="display:block">
                 <h2>啊哦！！ 被抢光啦！！ </h2>
            </div>
             <!--已卖完结束-->
             <?php endif; ?>
            <ul class="security-list">
                <li><a href="<?php echo Uri::create('/h/safeguard'); ?>" class="01">100%公平公正</a></li>
                <li><a href="<?php echo Uri::create('/h/promise'); ?>" class="02">100%正品保证</a></li>
                <li><a href="<?php echo Uri::create('/h/expressinfo'); ?>" class="03">全国免费配送</a></li>
            </ul>
            </div>
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
                                        <td><div class="head-sm"><a href="<?php echo Uri::create('u/'.$member->id); ?>"><img src="<?php echo Uri::create($member->avatar); ?>" alt=""></a></div></td>
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
                                        <td><div class="head-sm"><a href="<?php echo Uri::create('u/'.$current_user->id); ?>"><img src="<?php echo Uri::create($current_user->avatar); ?>" alt=""></a></div></td>
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
                                          <a class="btn-register" href="<?php echo Uri::create('signup'); ?>">注册</a>
                                    </li>
                               </ul>
                         </form>
                         <?php endif; ?>
                         </tbody>
                       </table>
                    </div>
                    <div class="tab-pane" id="help">
                        <p>乐乐淘是指只需10乐淘币就有机会买到想要的商品。即每件商品被平分成若干“等份”出售，每份10乐淘币，
                         当一件商品所有“等份”售出后，根据云购规则产生一名幸运者，该幸运者即可获得此商品。
                        </p>
                        <p>
                       乐乐淘以“快乐云淘，惊喜无限”为宗旨，力求打造一个100%公平公正、100%正品保障、寄娱乐与购物一体化的新型购物网站。
                        </p>
                        <div class="tr"><a href="<?php echo Uri::create('h/new'); ?>" class="link">更多详情></a></div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="wrapper w">
    <!--商品信息开始-->
    <div class="bd w">
         <div class="sub-nav w" id="bigNav">
            <ul class="fl">
                <li><a href="#desc" data-toggle="tab" class="active">商品详情</a></li>
                <li><a href="#buylog" phaseId="<?php echo $item->phase->id; ?>" data-toggle="tab">所有参与纪录(<s class="r"><?php echo $orderCount; ?></s>)</a></li>
                <li><a href="#posts" itemId="<?php echo $item->id; ?>" data-toggle="tab">晒单(<s class="r"><?php echo $postCount; ?></s>)</a></li>
                <li><a href="#phase" itemId="<?php echo $item->id; ?>" data-toggle="tab">往期回顾(<s class="r"><?php echo $phaseCount; ?></s>)</a></li>
            </ul>
            <div class="online-qq fr"><span class="icon icon-qq"></span><a class="chance" href="javaxcript:void(0)">在线客服</a></div>
        </div>
        <div class="tab-content">
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
            <div class="look-bak d-n tab-pane" id="phase"></div>
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
        containerSelector: ".bd"
    })
</script>

