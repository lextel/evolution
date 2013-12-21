<?php echo Asset::css('product.css'); ?>
<div class="wrapper w">
    <div class="product-inner w">
        <ul class="left-sidebar fl">
            <div class="header">商品分类</div>
            <?php
                $cates = $getCates();
                foreach ($cates as $cate) :
                    echo "<li><a href='". Uri::create('/m/c/'. $cate->id) ."'>{$cate->name}</a></li>";
                endforeach;
            ?>
        </ul>
        <div class="sidebar fl">
            <?php 
            $brands = $getBrands($cates);
            $i = 0;
            foreach($brands as $k => $brand) : 
                $style = $i == 0 ? '' : 'display:none';
            ?>
            <dl class="fl" style="<?php echo $style; ?>">
                <dt>品牌</dt>
                <?php
                    foreach($brand as $val) {
                        echo "<dd><a href=''>{$val->name}</a></dd>";
                    } 
                ?>
            </dl>
            <?php 
                $i++;
            endforeach; 
            ?>
            <div class="img-box fl">
                <a href=""><img src="" alt=""/></a>
            </div>
        </div>
        <?php 
            $topItem = $getTopItem();
        ?>
        <div class="product-hot fr">
            <div class="title-box">
                <h4><a href=""><?php echo $topItem->title; ?></a></h4>
                <span class="price">价值 <b>￥<?php echo sprintf('%.2f', $topItem->price); ?></b></span>
            </div>
            <div class="img-box">
                <a href=""><img src="<?php echo $topItem->image; ?>" alt=""></a>
                <div class="sheng-yi">
                    剩余 <b class="red"><?php echo $topItem->phase->remain ?></b>人本次商品就揭晓了！
                </div>
            </div>
            <button class="buy">立即乐拍</button>
        </div>
    </div>
    <!--产品列表开始-->
    <div class="content">
        <div class="list_sort">
            <span>排序</span>
            <a class="btn btn-default btn-sx">即将揭晓</a>
            <a class="btn btn-default  btn-sx">人气</a>
            <a class="btn btn-default  btn-sx">剩余人次</a>
            <a class="btn btn-default  btn-sx">最新</a>
            <a class="btn btn-default  btn-sx">价格</a>
        </div>
        <div class="product-list">
            <ul class="product-box">
                <?php foreach($items as $item): ?>
                <li>
                    <div class="title-box">
                        <h4><a href="<?php echo Uri::create('/m/'.$item->phase->id); ?>"><?php echo $item->title; ?></a></h4>
                        <span class="price">价值 <b>￥<?php echo sprintf('%.2f' ,$item->price); ?></b></span>
                    </div>
                    <div class="img-box">
                        <a href="<?php echo Uri::create('/m/'.$item->phase->id); ?>"><img src="<?php echo $item->image; ?>" alt=""></a>
                    </div>
                    <dl class="progress-side">
                        <dd>
                            <div class="progress"><div class="progress-bar"></div></div>
                        </dd>
                        <!--dd>
                            <span class="fl red"><?php echo $item->phase->joined; ?></span>
                            <span class="fr blue"><?php echo $item->phase->remain; ?></span>
                        </dd>
                        <dd>
                            <span class="fl">已参与人次</span>
                            <span class="fr">剩余人次</span>
                        </dd-->
                    </dl>
                    <div class="btn-menu">
                        <span>我要乐拍</span>
                        <button class="">-</button>
                        <input type="text" value="1"/>
                        <button class="">+</button>
                        <span>人次</span>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-red">立即乐拍</button>
                        <button class="btn btn-default">加入购物车</button>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <ul class="pages fr">
                <li><a href="" class="prev-page">上一页<</a></li>
                <li><a href="" class="curr-page">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href="">4</a></li>
                <li><a href="" class="next-page">下一页></a></li>
            </ul>
        </div>
    </div>
    <!--产品列表结束-->
    <!--今日热门开始-->
        <div class="date-hot w">
            <div class="title"><h4>今日热门</h4></div>
            <ul>
                <li>
                    <div class="img-box"><a href=""><img src="img/54359.jpg" alt=""></a></div>
                    <h5>苹果智能手机32G苹果智能手机32G</h5>
                    <div class="price fr">价值<b>￥5000</b></div>
                    <div class="btn-group">
                        <button class="btn btn-red">立即乐拍</button>
                    </div>
                </li>
                <li>
                    <div class="img-box"><a href=""><img src="img/54359.jpg" alt=""></a></div>
                    <h5>苹果智能手机32G苹果智能手机32G</h5>
                    <div class="price fr">价值<b>￥5000</b></div>
                    <div class="btn-group">
                        <button class="btn btn-red">立即乐拍</button>
                    </div>
                </li>
                <li>
                    <div class="img-box"><a href=""><img src="img/54359.jpg" alt=""></a></div>
                    <h5>苹果智能手机32G苹果智能手机32G</h5>
                    <div class="price fr">价值<b>￥5000</b></div>
                    <div class="btn-group">
                        <button class="btn btn-red">立即乐拍</button>
                    </div>
                </li>
                <li>
                    <div class="img-box"><a href=""><img src="img/54359.jpg" alt=""></a></div>
                    <h5>苹果智能手机32G苹果智能手机32G</h5>
                    <div class="price fr">价值<b>￥5000</b></div>
                    <div class="btn-group">
                        <button class="btn btn-red">立即乐拍</button>
                    </div>
                </li>
                <li>
                    <div class="img-box"><a href=""><img src="img/54359.jpg" alt=""></a></div>
                    <h5>苹果智能手机32G苹果智能手机32G</h5>
                    <div class="price fr">价值<b>￥5000</b></div>
                    <div class="btn-group">
                        <button class="btn btn-red">立即乐拍</button>
                    </div>
                </li>
            </ul>
        </div>
    <!--今日热门结束-->
</div>
