<?php echo Asset::css(['product.css', 'style.css']);?>
<div class="latest-wrap w">
   <!--左边内容开始-->
    <div class="left-content">
        <div class="title">
            <h4>最新揭晓 <small>(截至目前共揭晓商品 <s class="red"><?php echo $count;?></s>件)</small></h4>
        </div>
        <ul class="latest-item">
            <?php foreach($wins as $win) { ?>
            <li>
                <div class="item-head">
                    <h4 class="fl"><small>(第30期)</small>小米超薄800mAh移动电源</h4>
                    <span class="price fr">价值：<s class="red">￥2666.00</s></span>
                </div>
                <div class="item-body">
                    <div class="img-box fl">
                        <a href=""><img src="img/54359.jpg" alt=""/></a>
                    </div>
                    <div class="info-side fr">
                          <div class="head-img fl">
                              <a href=""><img src="img/54359.jpg" alt=""/></a>
                          </div>
                          <div class="name-box fr">
                              <div class="name">老衲用飘柔</div>
                              <div class="ip">来自：广东省深圳市</div>
                          </div>
                          <div class="number">当前乐拍:<s>10</s>人次</div>
                          <div class="datetime">揭晓时间：10分钟前</div>
                    </div>
                </div>
                <div class="item-footer">
                    <div class="lucky-code fl">
                        幸运乐拍码:<b class="red">10000016</b>
                    </div>
                    <a href="" class="btn btn-default fr">查看详情</a>
                </div>
            </li>
            <?php } ?>
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
                <li>
                    <div class="img-box">
                        <a href=""><img src="img/54359.jpg" alt=""></a>
                    </div>
                    <div class="info-side">
                        <div class="winner"><a href=""><b>王大锤</b>刚刚乐拍了</a></div>
                        <h4><a href="">苹果智能手机32G苹果智能手机32G苹果智能手机</a></h4>
                    </div>

                </li>
                <li>
                    <div class="img-box">
                        <a href=""><img src="img/54359.jpg" alt=""></a>
                    </div>
                    <div class="info-side">
                        <div class="winner"><a href=""><b>王大锤</b>刚刚乐拍了</a></div>
                        <h4><a href="">苹果智能手机32G苹果智能手机32G苹果智能手机</a></h4>
                    </div>

                </li>
                <li>
                    <div class="img-box">
                        <a href=""><img src="img/54359.jpg" alt=""></a>
                    </div>
                    <div class="info-side">
                        <div class="winner"><a href=""><b>王大锤</b>刚刚乐拍了</a></div>
                        <h4><a href="">苹果智能手机32G苹果智能手机32G苹果智能手机</a></h4>
                    </div>

                </li>
                <li>
                    <div class="img-box">
                        <a href=""><img src="img/54359.jpg" alt=""></a>
                    </div>
                    <div class="info-side">
                        <div class="winner"><a href=""><b>王大锤</b>刚刚乐拍了</a></div>
                        <h4><a href="">苹果智能手机32G苹果智能手机32G苹果智能手机</a></h4>
                    </div>
                </li>
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
