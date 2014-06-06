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
               <div class="r-hover"></div>
              <form class="xpxp" id="xpxp" action="<?php echo Uri::create('cart/add'); ?>" method="post">
                <div class="title-box">
                    <h4 class="title-md"><a href="<?php echo Uri::create('m/' . $item->id); ?>"><?php echo $item->title; ?></a></h4>
                    <span class="price">价值 <b>￥<?php echo sprintf('%.2f', $item->price); ?></b></span>
                </div>
                <div class="img-box img-lg">
                    <a href="<?php echo Uri::create('m/' . $item->id); ?>">
                       <img src="<?php echo \Helper\Image::showImage($item->image, '400x400');?>"/>
                    </a>
                </div>
                
                
                <div class="btn-group">
                    <input name="id" value="<?php echo $item->id; ?>" type="hidden">
                    <button class="btn btn-md btn-red" type="submit" >立即乐淘</button>
                    <a class="btn btn-md btn-y doCart" href="javascript:void(0);" phaseId="<?php echo $item->id; ?>">加入购物车</a>
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
                                <img src="<?php echo \Helper\Image::showImage($item->image, '200x200');?>"/>
                             </a>
                             <div class="price fr">价值<b>￥<?php echo sprintf('%.2f', $item->price); ?></b></div>
                          </div>
                          <h4 class="caption"><?php echo $item->title; ?></h4>
                          <div class="btn-group">
                                <form action="<?php echo Uri::create('cart/add'); ?>" method="post">
                                    <input name="id" value="<?php echo $item->id; ?>" type="hidden">
                                    <input name="qty" value="1" type="hidden">
                                    <button class="btn btn-red hot-buy" type="submit">立即乐淘</button>
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
