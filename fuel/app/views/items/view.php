<?php echo Asset::css(['product.css', 'jquery.jqzoom.css']); ?>
<?php echo Asset::js(['jquery.jqzoom-core.js', 'bootstrap.min.js', 'item/view.js']); ?>
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
                    <a href="<?php echo $item->image; ?>" class="jqzoom" rel="gal1">
                        <img src="<?php echo Uri::create('/image/400x400/' . $item->image); ?>" alt=""/>
                    </a>
                </div>
                <ul class="slide-list" id="thumblist">
                    <?php
                        $images = unserialize($item->images);
                        foreach($images as $image):
                    ?>
                    <li>
                        <a class="<?php echo $image == $item->image ? 'zoomThumbActive' : ''; ?>">
                            <img src="<?php echo $image; ?>" alt=""/>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!--幻灯片结束-->
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
        </div>
        <div class="product-column fr">
            <div class="state-heading">
                <span>本商品已有 <b class="blue">20</b>位幸运者晒单，<b class="blue">40</b>评论</span>
            </div>
            <div class="price">价值:<b><?php echo sprintf('%.2f', $item->price); ?></b></div>
            <dl class="progress-side">
                <dd>
                    <div class="progress"><div class="progress-bar" style="width: <?php echo sprintf('%.2f', $item->phase->joined/$item->phase->amount); ?>%"></div></div>
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
                    <button class="">-</button>
                    <input type="text" value="1" name="qty">
                    <button class="">+</button>
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
                        <li><a href="#buy" data-toggle="tab">最新乐拍记录</a></li>
                        <li><a href="#myBuy" data-toggle="tab">我的乐拍记录</a></li>
                        <li><a href="#help" data-toggle="tab">如何乐拍</a></li>
                    </ul>
                 </div>
                <div class="new-buyer-body" id="tab_content">
                    <div class="tab-pane active" id='buy'>
                        <table>
                            <tbody>
                                <tr>
                                    <td><div class="img-box"><a href=""><img src="img/54359.jpg" alt=""></a></div></td>
                                    <td>火枪中路必胜</td>
                                    <td><s>(广东深圳市)</s><b>1分钟前</b></td>
                                    <td>乐拍了<s>100</s>次</td>
                                </tr>
                                <tr>
                                    <td><div class="img-box"><a href=""><img src="img/54359.jpg" alt=""></a></div></td>
                                    <td>火枪中路必胜</td>
                                    <td><s>(广东深圳市)</s><b>1分钟前</b></td>
                                    <td>乐拍了<s>100</s>次</td>
                                </tr>
                                <tr>
                                    <td><div class="img-box"><a href=""><img src="img/54359.jpg" alt=""></a></div></td>
                                    <td>火枪中路必胜</td>
                                    <td><s>(广东深圳市)</s><b>1分钟前</b></td>
                                    <td>乐拍了<s>100</s>次</td>
                                </tr>
                                <tr>
                                    <td><div class="img-box"><a href=""><img src="img/54359.jpg" alt=""></a></div></td>
                                    <td>火枪中路必胜</td>
                                    <td><s>(广东深圳市)</s><b>1分钟前</b></td>
                                    <td>乐拍了<s>100</s>次</td>
                                </tr>
                                <tr>
                                    <td><div class="img-box"><a href=""><img src="img/54359.jpg" alt=""></a></div></td>
                                    <td>火枪中路必胜</td>
                                    <td><s>(广东深圳市)</s><b>1分钟前</b></td>
                                    <td>乐拍了<s>100</s>次</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="myBuy">
                        tab b
                    </div>
                    <div class="tab-pane" id="help">
                        nothing
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-nav w">
        <ul>
            <li><a href="#desc" data-toggle="tab">商品详情</a></li>
            <li><a href="#buylog" data-toggle="tab">所有参与纪录(<b>100</b>)</a></li>
            <li><a href="#posts" data-toggle="tab">晒单(<b>100</b>)</a></li>
            <li><a href="#phase" data-toggle="tab">往期回顾(<b>100</b>)</a></li>
        </ul>
    </div>
    <!--商品信息结束-->
    <div class="content">
        <!--商品详情开始-->
        <div class="product-details tab-pane" id="desc">
            <?php echo $item->desc; ?>
        </div>
        <!--商品详情结束-->
        <div class="tab-pane" id="buylog">
            buylog
        </div>
        <div class="tab-pane" id="posts">
            posts
        </div>
        <div  class="tab-pane" id="phase">
            往期回顾
        </div>
    </div>

</div>

