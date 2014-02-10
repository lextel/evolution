<?php echo Asset::css('product.css'); ?>
<?php echo Asset::js(['Xslider.js', 'item/index.js']); ?>
<div class="w">
        <ul class="product-nav fl">
            <div class="header">商品分类</div>
            <?php
                $cates = $getCates();
                foreach ($cates as $cate) :
                    echo "<li class='cateNav'><a href='". Uri::create('/m/c/'. $cate->id) ."'>{$cate->name}</a></li>";
                endforeach;
            ?>
        </ul>
        <div class="sub-menu fl">
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
            <div class="sub_banner fl">
                <?php 
                    $ads = $getAds();
                    $i = 0;
                    foreach($ads as $ad):
                    $style = $i == 0 ? '' : 'display:none';
                ?>
                <a style="<?php echo $style; ?>" href="<?php echo $ad->link ?>"><img src="<?php echo Uri::create($ad->image); ?>" alt="<?php echo $ad->title; ?>"/></a>
                <?php
                    $i++;
                    endforeach;
                ?>
            </div>
        </div>
        <?php 
            $topItem = $getTopItem();
            Config::load('common');
        ?>
        <div class="product-hot fr">
            <?php
                if(!empty($topItem)) {
            ?>
                <form action="<?php echo Uri::create('cart/add'); ?>" method="post">
                    <div class="title-box">
                        <h3 class="title-md"><a href="<?php echo Uri::create('/m/'.$topItem->id); ?>"><?php echo $topItem->title; ?></a></h3>
                        <span class="price">价值 <b>￥<?php echo sprintf('%.2f', $topItem->cost / Config::get('point')); ?></b></span>
                    </div>
                    <div class="img-box img-lg">
                        <a href="<?php echo Uri::create('/m/'.$topItem->id); ?>" rel="nofollow"><img src="<?php echo Uri::create('/image/400x400/' . $topItem->image); ?>" alt=""></a>
                        <div class="sheng-yi">剩余 <b><?php echo $topItem->remain ?></b>人次！</div>
                    </div>
                    <input name="id" value="<?php echo $topItem->id;?>" type="hidden"/>
                    <input name="qty" value="1" type="hidden"/>
                    <div class="btn-group tc"><button class="btn btn-red" type="submit">立即乐拍</button></div>
                </form>
            <?php
                }
            ?>
        </div>
</div>
<!--产品列表开始-->
<div class="w">
        <div class="list_sort">
            <label>排序</label>
            <?php echo $sort(); ?>
        </div>
        <div class="product-list">
             <ul>
                            <?php
                            foreach($items as $item):
                            ?>
                            <li>
                                <form class="xpxp" id="xpxp" action="<?php echo Uri::create('cart/add'); ?>" method="post">
                                    <div class="title-box">
                                        <h3 class="title-md"><a href="<?php echo Uri::create('/m/'.$item->id); ?>"><?php echo $item->title; ?></a></h3>
                                        <span class="price">价值 <b>￥<?php echo sprintf('%.2f' ,$item->cost / Config::get('point')); ?></b></span>
                                    </div>
                                    <div class="img-box img-lg">
                                        <a href="<?php echo Uri::create('/m/'.$item->id); ?>" rel="nofollow"><img src="<?php echo Uri::create('/image/400x400/' . $item->image); ?>"></a>
                                    </div>
                                    <dl class="progress-side">
                                        <dd>
                                            <div class="progress"><div class="progress-bar" style="width: <?php echo sprintf('%.2f', $item->joined/$item->amount*100)?>%"></div></div>
                                        </dd>
                                        <!--dd>
                                            <span class="fl red"><?php echo $item->joined; ?></span>
                                            <span class="fr blue"><?php echo $item->remain; ?></span>
                                        </dd>
                                        <dd>
                                            <span class="fl">已参与人次</span>
                                            <span class="fr">剩余人次</span>
                                        </dd-->
                                    </dl>
                                    <div class="btn-menu">
                                        <span>我要乐拍</span>
                                        <a class="add btn-jian" href="javascript:void(0);">-</a>
                                        <input type="text" value="1" name="qty" remain="<?php echo $item->remain; ?>"/>
                                        <a class="add btn-jia" href="javascript:void(0);">+</a>
                                        <span>人次</span>
                                    </div>
                                    <div class="btn-group">
                                        <input name="id" value="<?php echo $item->id; ?>" type="hidden">
                                        <button class="btn btn-red" type="submit" >立即乐拍</button>
                                        <a class="btn btn-y doCart" href="javascript:void(0);" phaseId="<?php echo $item->id; ?>">加入购物车</a>
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
    <div class="title"><h3>今日热门</h3></div>
    <div class="scrollleft" >
         <div class="scrollcontainer">
             <ul>
                 <?php $hotItems = $getHots();
                        if(isset($hotItems)) {
                        foreach($hotItems as $item) { ?>
                      <li>
                          <div class="img-box img-md"><a href="<?php echo Uri::create('/m/'.$item->id); ?>" rel="nofollow"><img src="<?php echo Uri::create('/image/200x200/'.$item->image); ?>" alt=""></a></div>
                          <h4 class="title-mx"><?php echo $item->title; ?></h4>
                          <div class="price fr">价值<b>￥<?php echo sprintf('%.2f', $item->cost / Config::get('point')); ?></b></div>
                          <div class="btn-group">
                                <form action="<?php echo Uri::create('cart/add'); ?>" method="post">
                                    <input name="id" value="<?php echo $item->id; ?>" type="hidden">
                                    <input name="qty" value="1" type="hidden">
                                    <button class="btn btn-red" type="submit">立即乐拍</button>
                                </form>
                          </div>
                      </li>
                      <?php }} ?>
                 </ul>
            </div>
            <a class="abtn aleft" href="#left"></a>
            <a class="abtn aright" href="#right"></a>
        </div>
    </div>
    <!--今日热门结束-->
</div>
