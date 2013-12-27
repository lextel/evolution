<?php echo Asset::css('product.css'); ?>
<?php echo Asset::js('jquery1.8.2jquery.min.js'); ?>
<?php echo Asset::js('./item/view.js'); ?>

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
                        echo "<dd><a href='" . Uri::create('/m/c/'. $k . '/b/'. $val->id) . "'>{$val->name}</a></dd>";
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
            <?php
                if(!empty($topItem)) {
            ?>
                <form action="<?php echo Uri::create('cart/add'); ?>" method="post">
                    <div class="title-box">
                        <h4><a href="<?php echo Uri::create('/m/'.$topItem->phase->id); ?>"><?php echo $topItem->title; ?></a></h4>
                        <span class="price">价值 <b>￥<?php echo sprintf('%.2f', $topItem->price); ?></b></span>
                    </div>
                    <div class="img-box">
                        <a href="<?php echo Uri::create('/m/'.$topItem->phase->id); ?>"><img src="<?php echo Uri::create('/image/200x200/' . $topItem->image); ?>" alt=""></a>
                        <div class="sheng-yi">
                            剩余 <b class="red"><?php echo $topItem->phase->remain ?></b>人本次商品就揭晓了！
                        </div>
                    </div>
                    <input name="id" value="<?php echo $topItem->phase->id;?>" type="hidden"/>
                    <input name="qty" value="1" type="hidden"/>
                    <button class="buy" type="submit">立即乐拍</button>
                </form>
            <?php
                }
            ?>
        </div>
    </div>
    <!--产品列表开始-->
    <div class="content">
        <div class="list_sort">
            <span>排序</span>
            <?php echo $sort(); ?>
        </div>

        <div class="product-list">
            <ul class="product-box">
                <?php foreach($items as $item): ?>
                <li>
                    <form class="xpxp" id="xpxp" action="<?php echo Uri::create('cart/add'); ?>" method="post">
                        <div class="title-box">
                            <h4><a href="<?php echo Uri::create('/m/'.$item->phase->id); ?>"><?php echo $item->title; ?></a></h4>
                            <span class="price">价值 <b>￥<?php echo sprintf('%.2f' ,$item->price); ?></b></span>
                        </div>
                        <div class="img-box">
                            <a href="<?php echo Uri::create('/m/'.$item->phase->id); ?>"><img src="<?php echo Uri::create('/image/200x200/' . $item->image); ?>" alt=""></a>
                        </div>
                        <dl class="progress-side">
                            <dd>
                                <div class="progress"><div class="progress-bar" style="width: <?php echo printf('%.2f', $item->phase->joined/$item->phase->amount*100)?>%"></div></div>
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
                            <a class="btn-jian" >----</a>
                            <input id="qty" type="text" value="1" name="qty"/>
                            <a class="btn-jia" >+++++</a>
                            <span>人次</span>
                        </div>
                        <div class="btn-group">
                            <input name="id" value="<?php echo $item->phase->id; ?>" type="hidden">
                            <button class="btn btn-red" type="Submit" onclick="ck();">立即乐拍</button>
                            <a class="btn btn-default" href="javascript:void(0);">加入购物车</a>
                        </div>
                    </form>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php echo Pagination::instance('mypagination')->render();?>
        </div>
    </div>
    <!--产品列表结束-->
    <!--今日热门开始-->
        <div class="date-hot w">
            <div class="title"><h4>今日热门</h4></div>
            <ul>
                <?php
                    $hotItems = $getHots();
                    foreach($hotItems as $item) :
                ?>
                <li>
                    <div class="img-box"><a href="<?php echo Uri::create('/m/'.$item->phase->id); ?>"><img src="<?php echo Uri::create('/image/200x200/'.$item->image); ?>" alt=""></a></div>
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
