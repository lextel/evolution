<?php echo Asset::css('product.css'); ?>
<?php echo Asset::js(['Xslider.js', 'item/index.js']); ?>
<div class="wrapper w">
<!--产品列表开始-->
    <div class="top-navbar w">
        <ul>
            <?php
                $cates = $getCates();
                foreach($cates as $cate):
            ?>
            <li><a href="<?php echo Uri::create('m/c/'.$cate->id.'#list'); ?>"><?php echo $cate->name; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="select-result w">
        <h2>商品搜索- <b>"<?php echo $title; ?>"</b><small>（共找到 <b><?php echo $total; ?></b>件相关商品）</small></h2>
    </div>
    <div class="product-list">
        <ul class="product-box">
            <?php
                Config::load('common');
                if(!empty($items)) :
                foreach($items as $item):
            ?>
            <li>
              <form class="xpxp" id="xpxp" action="<?php echo Uri::create('cart/add'); ?>" method="post">
                <div class="title-box">
                    <h4 class="title-md"><a href="<?php echo Uri::create('m/' . $item->id); ?>"><?php echo $item->title; ?></a></h4>
                    <span class="price">价值 <b>￥<?php echo sprintf('%.2f', $item->cost/Config::get('point')); ?></b></span>
                </div>
                <div class="img-box img-lg">
                    <a href="<?php echo Uri::create('m/' . $item->id); ?>"><img src="<?php echo Uri::create('image/400x400/' . $item->image);?>" alt=""></a>
                </div>
                <dl class="progress-side">
                    <dd>
                        <div class="progress"><div class="progress-bar" style="width: <?php echo sprintf('%.2f', $item->joined/$item->amount*100)?>%"></div></div>
                    </dd>
                    <dd>
                        <span class="fl r"><?php echo $item->joined; ?></span>
                        <span class="fr b"><?php echo $item->remain; ?></span>
                    </dd>
                    <dd>
                        <span class="fl c9">已攒金币</span>
                        <span class="fr c9">还需金币</span>
                    </dd>
                </dl>
                <?php if($item->status == \Helper\Item::IS_CHECK): ?>
                <div class="btn-menu">
                    <span class="left">我要乐拍</span>
                    <a class="add btn-jian" href="javascript:void(0);">-</a>
                    <input type="text" value="1" name="qty" remain="<?php echo $item->remain; ?>"/>
                    <a class="add btn-jia" href="javascript:void(0);">+</a>
                    <span class="right">金币</span>
                </div>
                <div class="btn-group">
                    <input name="id" value="<?php echo $item->id; ?>" type="hidden">
                    <button class="btn btn-md btn-red" type="submit" >立即一元乐淘</button>
                    <a class="btn btn-md btn-y doCart" href="javascript:void(0);" phaseId="<?php echo $item->id; ?>">加入购物车</a>
                </div>
                <?php else: ?>
                <div class="btn-group soon">
                    <button class="btn btn-red" onclick="window.location.href='<?php echo Uri::create('/m/'.$item->id); ?>'; return false;">即将开拍</button>
                </div>
                <?php endif;?>
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
                          <div class="img-box img-md">
                            <a href="<?php echo Uri::create('/m/'.$item->id); ?>" rel="nofollow">
                                <img src="<?php echo Uri::create('/image/200x200/'.$item->image); ?>" alt="">
                             </a>
                             <div class="price fr">价值<b>￥<?php echo sprintf('%.2f', $item->cost / Config::get('point')); ?></b></div>
                          </div>
                          <h4 class="caption"><?php echo $item->title; ?></h4>
                          <div class="btn-group">
                                <form action="<?php echo Uri::create('cart/add'); ?>" method="post">
                                    <input name="id" value="<?php echo $item->id; ?>" type="hidden">
                                    <input name="qty" value="1" type="hidden">
                                    <button class="btn btn-red hot-buy" type="submit">立即一元乐淘</button>
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
</div>
