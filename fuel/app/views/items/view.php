<?php echo Asset::css(['product.css', 'jquery.jqzoom.css', 'customBootstrap.css']); ?>
<?php echo Asset::js(['jquery.jqzoom-core.js', 'bootstrap.min.js', 'item/view.js']); ?>
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
            <?php if($prevWinner):?>
            <!--获奖者开始-->
            <div class="previous-box">
                <div class="img-box fl"><a href=""><img src="img/54359.jpg" alt=""></a></div>
                <div class="info-side fl">
                    <div class="winner">获得者<a href=""><b>王大锤</b></a></div>
                    <span class="announce-time">揭晓时间：<b>2012-12-30</b></span>
                    <span class="buy-time">乐拍时间：<b>2012-12-30</b></span>
                    <span class="buy-number">幸运码：<b class="red">1000000</b></span>
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
                    <a class="add">-</a>
                    <input type="text" value="1" name="qty">
                    <a class="add">+</a>
                    <span>人次</span>
                    <span>获得几率：<s class="red">0.00%</s> </span>
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
                                        <td><div class="img-box"><a href=""><img src="<?php echo Uri::create($member->avatar); ?>" alt=""></a></div></td>
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
                                    if($myOrders):
                                        foreach($myOrders as $myOrder):
                                    ?>
                                    <tr>
                                        <td><div class="img-box"><a href=""><img src="<?php echo Uri::create($current_user->avatar); ?>" alt=""></a></div></td>
                                        <td><?php echo $current_user->nickname; ?></td>
                                        <td><!--s>(广东深圳市)</s--><b><?php echo $friendlyDate($myOrder->created_at); ?></b></td>
                                        <td>乐拍了<s><?php echo $myOrder->code_count; ?></s>次</td>
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
                    <div class="tab-pane" id="help">
                        如何乐拍
                        如何乐拍
                        如何乐拍
                        如何乐拍
                        如何乐拍
                        如何乐拍
                        如何乐拍
                        如何乐拍
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-nav w">
        <ul>
            <li><a href="#desc" data-toggle="tab" class="active">商品详情</a></li>
            <li><a href="#buylog" data-toggle="tab">所有参与纪录(<b><?php echo $orderCount; ?></b>)</a></li>
            <li><a href="#posts" data-toggle="tab">晒单(<b><?php echo $postCount; ?></b>)</a></li>
            <li><a href="#phase" data-toggle="tab">往期回顾(<b><?php echo $item->phase->phase_id; ?></b>)</a></li>
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
            <table>
                <thead>
                    <tr>
                        <th>会员帐号</th>
                        <th>数量/人次</th>
                        <th>时间</th>
                    <tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span class="head-img-sm fl"><a href=""><img src="img/54359.jpg" alt=""/></a></span>
                            <span class="name fl">我是买家名字</span>
                            <span class="ip fl">（广东深圳市 IP:25.42.251.11）</span>
                        </td>
                        <td>10</td>
                        <td>2013-12-23 10:16:22</td>
                    <tr>
                    <tr>
                        <td>
                            <span class="head-img-sm fl"><a href=""><img src="img/54359.jpg" alt=""/></a></span>
                            <span class="name fl">我是买家名字</span>
                            <span class="ip fl">（广东深圳市 IP:25.42.251.11）</span>
                        </td>
                        <td>10</td>
                        <td>2013-12-23 10:16:22</td>
                    <tr>
                    <tr>
                        <td>
                            <span class="head-img-sm fl"><a href=""><img src="img/54359.jpg" alt=""/></a></span>
                            <span class="name fl">我是买家名字</span>
                            <span class="ip fl">（广东深圳市 IP:25.42.251.11）</span>
                        </td>
                        <td>10</td>
                        <td>2013-12-23 10:16:22</td>
                    <tr>
                    <tr>
                        <td>
                            <span class="head-img-sm fl"><a href=""><img src="img/54359.jpg" alt=""/></a></span>
                            <span class="name fl">我是买家名字</span>
                            <span class="ip fl">（广东深圳市 IP:25.42.251.11）</span>
                        </td>
                        <td>10</td>
                        <td>2013-12-23 10:16:22</td>
                    <tr>
                </tbody>
            </table>
            <!--分页-->
            <div class="pagination fr">
                <span><a href="" class="previous-inactive">上一页&lt;</a></span>
                <span><a href="" class="active">1</a></span>
                <span><a href="">2</a></span>
                <span><a href="">3</a></span>
                <span><a href="">4</a></span>
                <span><a href="" class="next">下一页&gt;</a></span>
            </div>
            <!--结束-->
        </div>
        <!--参与记录结束-->
        <!--晒单开始-->
        <div class="product-bask tab-pane" id="posts">
            <ul>
                <li>
                    <div class="head-img fl">
                        <a href=""><img src="img/54359.jpg" alt=""></a>
                        <div class="name"><a href="">我是买家名字</a></div>
                    </div>
                    <div class="bask-list fr">
                        <h4 class="text-title">终于中了一个！</h4>
                        <div class="datetime">2013-12-30</div>
                        <div class="bask-text">
                           艳遇地点：重庆。理由：重庆也许是中国美女最集中的城市，重庆特殊的地理环境造就重庆女孩天生的漂亮，
                            加上重庆是雾城，长年都有雾，女孩都长得很水灵，化妆品不外是保持水份，而重庆却是一个长年潮湿的城市。
                        </div>
                        <dl class="bask-imgBox">
                            <dd class="img-box">
                                <a href=""><img src="img/54359.jpg" alt=""></a>
                            </dd>
                            <dd class="img-box">
                                <a href=""><img src="img/54359.jpg" alt=""></a>
                            </dd>
                            <dd class="img-box">
                                <a href=""><img src="img/54359.jpg" alt=""></a>
                            </dd>
                        </dl>
                        <div class="btn-group tl">
                            <a href="" class="btn btn-link">喜欢<s>(0)</s></a>
                            <a href="" class="btn btn-link">评论<s>(0)</s></a>
                        </div>
                        <div class="bask-number">
                            第01期晒单
                        </div>
                    </div>
                </li>
                <li>
                    <div class="head-img fl">
                        <a href=""><img src="img/54359.jpg" alt=""></a>
                        <div class="name"><a href="">我是买家名字</a></div>
                    </div>
                    <div class="bask-list fr">
                        <h4 class="text-title">终于中了一个！</h4>
                        <div class="datetime">2013-12-30</div>
                        <div class="bask-text">
                            艳遇地点：重庆。理由：重庆也许是中国美女最集中的城市，重庆特殊的地理环境造就重庆女孩天生的漂亮，
                            加上重庆是雾城，长年都有雾，女孩都长得很水灵，化妆品不外是保持水份，而重庆却是一个长年潮湿的城市。
                        </div>
                        <dl class="bask-imgBox">
                            <dd class="img-box">
                                <a href=""><img src="img/54359.jpg" alt=""></a>
                            </dd>
                            <dd class="img-box">
                                <a href=""><img src="img/54359.jpg" alt=""></a>
                            </dd>
                            <dd class="img-box">
                                <a href=""><img src="img/54359.jpg" alt=""></a>
                            </dd>
                        </dl>
                        <div class="btn-group tl">
                            <a href="" class="btn btn-link">喜欢<s>(0)</s></a>
                            <a href="" class="btn btn-link">评论<s>(0)</s></a>
                        </div>
                        <div class="bask-number">
                            第01期晒单
                        </div>
                    </div>
                </li>
                <li>
                    <div class="head-img fl">
                        <a href=""><img src="img/54359.jpg" alt=""></a>
                        <div class="name"><a href="">我是买家名字</a></div>
                    </div>
                    <div class="bask-list fr">
                        <h4 class="text-title">终于中了一个！</h4>
                        <div class="datetime">2013-12-30</div>
                        <div class="bask-text">
                            艳遇地点：重庆。理由：重庆也许是中国美女最集中的城市，重庆特殊的地理环境造就重庆女孩天生的漂亮，
                            加上重庆是雾城，长年都有雾，女孩都长得很水灵，化妆品不外是保持水份，而重庆却是一个长年潮湿的城市。
                        </div>
                        <dl class="bask-imgBox">
                            <dd class="img-box">
                                <a href=""><img src="img/54359.jpg" alt=""></a>
                            </dd>
                            <dd class="img-box">
                                <a href=""><img src="img/54359.jpg" alt=""></a>
                            </dd>
                            <dd class="img-box">
                                <a href=""><img src="img/54359.jpg" alt=""></a>
                            </dd>
                        </dl>
                        <div class="btn-group tl">
                            <a href="" class="btn btn-link">喜欢<s>(0)</s></a>
                            <a href="" class="btn btn-link">评论<s>(0)</s></a>
                        </div>
                        <div class="bask-number">
                            第01期晒单
                        </div>
                    </div>
                </li>
            </ul>
            <!--分页-->
            <div class="pagination fr">
                <span class="previous-inactive"><a href="">上一页&lt;</a></span>
                <span class="active"><a href="">1</a></span>
                <span><a href="">2</a></span>
                <span><a href="">3</a></span>
                <span><a href="">4</a></span>
                <span class="next"><a href="">下一页&gt;</a></span>
            </div>
            <!--结束-->
        </div>
        <!--晒单结束-->
        <!--往期回顾开始-->
        <div  class="look-bak d-n tab-pane" id="phase">
            <table>
                <thead>
                <tr>
                    <th>期数</th>
                    <th>幸运获奖者</th>
                    <th>幸运乐拍码</th>
                    <th>购买数量</th>
                    <th>揭晓时间</th>
                <tr>
                </thead>
                <tbody>
                    <tr>
                        <td>第516期</td>
                        <td>正在进行中...</td>
                        <td>我是买家名字</td>
                        <td>10</td>
                        <td>2013-12-30 10:22:33</td>
                    <tr>
                    <tr>
                        <td>第516期</td>
                        <td>10002103</td>
                        <td>我是买家名字</td>
                        <td>10</td>
                        <td>2013-12-30 10:22:33</td>
                    <tr>
                    <tr>
                        <td>第516期</td>
                        <td>10001582</td>
                        <td>我是买家名字</td>
                        <td>10</td>
                        <td>2013-12-30 10:22:33</td>
                    <tr>
                </tbody>
            </table>
            <!--分页-->
            <div class="pagination fr">
                <span><a href="" class="previous-inactive">上一页&lt;</a></span>
                <span><a href="" class="active">1</a></span>
                <span><a href="">2</a></span>
                <span><a href="">3</a></span>
                <span><a href="">4</a></span>
                <span><a href="" class="next">下一页&gt;</a></span>
            </div>
            <!--结束-->
        </div>
    </div>

</div>

