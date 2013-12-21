<?php echo Asset::css('product.css'); ?>

<?php
serialize(['']);

?>
<div class="wrapper w">
    <!--商品信息开始-->
    <div class="panel w">
        <div class="title">
            <h2>
                <b>(第1期)</b>
                <?php echo $item->title; ?>
            </h2>
        </div>
        <div class="img-box fl">
            <div class="previous-box">
                <div class="img-box fl"><a href=""><img src="img/54359.jpg" alt=""></a></div>
                <div class="info-side fl">
                    <div class="winner">获得者<a href=""><b>王大锤</b></a></div>
                    <span class="announce-time">揭晓时间：<b>2012-12-30</b></span>
                    <span class="buy-time">乐拍时间：<b>2012-12-30</b></span>
                    <span class="buy-number">幸运码：<b class="red">1000000</b></span>
                </div>
            </div>
        </div>
        <div class="product-column fr">
            <div class="state-heading">
                <span>本商品已有 <b class="blue">20</b>位幸运者晒单，<b class="blue">40</b>评论</span>
            </div>
            <div class="price">价值:<b><?php echo sprintf('%.2f', $item->price); ?></b></div>
            <dl class="progress-side">
                <dd>
                    <div class="progress"><div class="progress-bar"></div></div>
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
            <div class="btn-menu">
                <span>购买数量：</span>
                <button class="">-</button>
                <input type="text" value="1">
                <button class="">+</button>
                <span>人次</span>
                <span>获得几率：<s class="red">0.00%</s> </span>
            </div>
            <div class="btn-group">
                <button class="btn btn-red">立即乐拍</button>
                <button class="btn btn-default">加入购物车</button>
            </div>
            <ul class="security-list">
                <li><a href="" class="01">100%公平公正</a></li>
                <li><a href="" class="02">100%正品保证</a></li>
                <li><a href="" class="03">全国免费配送</a></li>
            </ul>
            <div class="new-buyer">
                <div class="new-buyer-header">
                    <ul>
                        <li><a href="">最新乐拍记录</a></li>
                        <li><a href="">我的乐拍记录</a></li>
                        <li><a href="">如何乐拍</a></li>
                    </ul>
                 </div>
                <div class="new-buyer-body">
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
            </div>
        </div>
    </div>
    <div class="sub-nav w">
        <ul>
            <li><a href="">商品详情</a></li>
            <li><a href="">计算结果</a></li>
            <li><a href="">所有参与纪录(<b>100</b>)</a></li>
            <li><a href="">晒单(<b>100</b>)</a></li>
            <li><a href="">往期回顾(<b>100</b>)</a></li>
        </ul>
    </div>
    <!--商品信息结束-->
    <div class="content">
        <!--商品详情开始-->
        <div class="product-details">
            <?php echo $item->desc; ?>
        </div>
        <!--商品详情结束-->
    </div>

</div>

