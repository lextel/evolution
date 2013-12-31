<?php echo Asset::css('product.css'); ?>
<div class="wrapper w">
<!--产品列表开始-->
<div class="content">
    <div class="top-navbar w">
        <ul>
            <li><a href="">手机</a></li>
            <li><a href="">数码</a></li>
            <li><a href="">相机</a></li>
            <li><a href="">平板电视</a></li>
            <li><a href="">钟表首饰</a></li>
            <li><a href="">其他商品</a></li>
        </ul>
    </div>
    <div class="select-result w">
        <h2>商品搜索- <b>"<?php echo $title; ?>"</b><small>（共找到 <b><?php echo $total; ?></b>件相关商品）</small></h2>
    </div>
    <div class="product-list">
        <ul class="product-box">
            <?php
                if($items) :
                foreach($items as $item):
            ?>
            <li>
              <form class="xpxp" id="xpxp" action="<?php echo Uri::create('cart/add'); ?>" method="post">
                <div class="title-box">
                    <h4><a href="<?php echo Uri::create('m/' . $item->phase->id); ?>"><?php echo $item->phase->title; ?></a></h4>
                    <span class="price">价值 <b>￥<?php echo sprintf('%.2f', $item->price); ?></b></span>
                </div>
                <div class="img-box">
                    <a href="<?php echo Uri::create('m/' . $item->phase->id); ?>"><img src="<?php echo Uri::create('image/200x200/' . $item->image);?>" alt=""></a>
                </div>
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
                    <span>我要乐拍</span>
                    <a class="add btn-jian" href="javascript:void(0);">-</a>
                    <input type="text" value="1" name="qty" remain="<?php echo $item->phase->remain; ?>"/>
                    <a class="add btn-jia" href="javascript:void(0);">+</a>
                    <span>人次</span>
                </div>
                <div class="btn-group">
                    <input name="id" value="<?php echo $item->phase->id; ?>" type="hidden">
                    <button class="btn btn-red" type="submit">立即乐拍</button>
                    <a class="btn btn-default doCart" href="javascript:void(0);">加入购物车</a>
                </div>
              </form>
            </li>
            <?php
                endforeach;
                else:
                echo '<p style="margin-bottom: 15px;text-align: center">没有找到任何商品。</p>';
                endif;
            ?>
        </ul>
        <?php echo Pagination::instance('mypagination')->render();?>
    </div>
</div>
<!--产品列表结束-->
<!--今日热门开始-->
<div class="date-hot w">
    <div class="title"><h4>今日热门</h4></div>
    <div class="scrollleft">
    <ul>
        <?php
            $hotItems = $getHots();
            foreach($hotItems as $item) :
        ?>
        <li>
            <div class="img-box">111111<a href="<?php echo Uri::create('/m/'.$item->phase->id); ?>"><img src="<?php echo Uri::create('/image/200x200/'.$item->image); ?>" alt=""></a></div>
            <h5><?php echo $item->phase->title; ?></h5>
            <div class="price fr">价值<b>￥<?php echo sprintf('%.2f', $item->price); ?></b></div>
            <div class="btn-group">
                <form action="<?php echo Uri::create('cart/add'); ?>" method="post">
                    <input name="id" value="<?php echo $item->phase->id; ?>" type="hidden">
                    <input name="qty" value="1" type="hidden">
                    <button class="btn btn-red" type="submit">立即乐拍</button>
                </form>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<!--今日热门结束-->
</div>

