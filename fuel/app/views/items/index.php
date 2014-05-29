<?php echo Asset::css(['product.css', 'nivo-slider.css' ,'default.css']); ?>
<?php echo Asset::js(['Xslider.js', 'item/index.js' ,'jquery.nivo.slider.pack.js']); ?>
 <div class="bread">
     <ul>
     <?php echo $getBread($cateId, $brandId)?>
     </ul>
</div>
<div class="slide-nav">
        <ul class="product-nav fl">
            <div class="header">商品分类</div>
            <?php
                $cates = $getCates();
                $bannerIdx = 0;
                $i = 0;
                foreach ($cates as $cate) :
                    $active = '';
                    if($cateId == $cate->id) {
                        $active = ' active';
                        $bannerIdx = $i;
                    }
                    echo "<li class='cateNav{$active}'><a href='". Uri::create('m/c/'. $cate->id) ."'>{$cate->name}></a></li>";
                    $i++;
                endforeach;
            ?>
        </ul>
        <div class="sub-menu fl">
            <?php 
            $brands = $getBrands($cates);
            $i = 0;
            foreach($brands as $k => $brand) : 
                $style = $i == $bannerIdx ? '' : 'display:none';
            ?>
            <dl class="fl" style="<?php echo $style; ?>">
                <dt>品牌</dt>
                <?php
                    foreach($brand as $val) {
                        $icon = '';
                        if(isset($val['thumb']) && !empty($val['thumb'])) {
                            $icon = '<img src="'.Uri::create($val['thumb']).'"/>';
                        }
                        $bactive = ($brandId == $val['id']) ? 'color: #af2812' : '';
                        echo "<dd><a style='{$bactive}' href='" . Uri::create('m/c/'. $k . '/b/'. $val['id']) . "'>{$icon}{$val['name']}</a></dd>";
                    } 
                ?>
            </dl>
            <?php 
                $i++;
            endforeach; 
            ?>
        </div>

        <div class="sub_banner fl theme-default">
             <div id="slider" class="nivoSlider">
             <?php
                  $ads = $getAds();
                     $i = 0;
                            foreach($ads as $ad):
                            $style = ($i == $bannerIdx) ? '' : 'display:none';
                        ?>
                        <a style="<?php echo $style;?>" href="<?php echo Uri::create($ad->link); ?>" title="<?php echo $ad->title?>" alt="<?php echo $ad->title?>">
                            <img src="<?php echo \Helper\Image::showImage($ad->image);?>"/>
                        </a>
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
        <div class="product-hot">
              <?php
                if(!empty($topItem)) {
              ?>
                    <div class="title-box">
                        <h3 class="caption"><a href="<?php echo Uri::create('/m/'.$topItem->id); ?>"><?php echo $topItem->title; ?></a></h3>
                        <span class="price tr">价值<b>￥<?php echo sprintf('%.2f', $topItem->cost / Config::get('point')); ?></b></span>
                    </div>
                    <div class="img-wide">
                        <a href="<?php echo Uri::create('m/'.$topItem->id); ?>" rel="nofollow"><img src="<?php echo \Helper\Image::showImage($topItem->image, '400x400');?>"/></a>
                        <!--<div class="sheng-yi2">还需 <b><?php echo $topItem->remain ?></b>元宝！</div>-->
                        <div class="sheng-yi2">热门推荐</div>
                    </div>
                    <div class="btn-group tc"><a href="<?php echo Uri::create('/m/'.$topItem->id); ?>" class="btn btn-red btn-hot">立即购买</a></div>
              <?php
               }
              ?>
        </div>
</div>
<!--产品列表开始-->
<style>
    .list_sort a i {
        margin-left: 2px;
        width: 13px;
        height: 12px;
        display: inline-block;
        background: url('<?php echo Uri::create('assets/images/arrow_up.png')?>');
    }

    .list_sort a s {
        margin-left: 2px;
        width: 13px;
        height: 12px;
        display: inline-block;
        background: url('<?php echo Uri::create('assets/images/arrow_down.png')?>');
    }
</style>
<a id="list"></a>
<div class="w">
        <div class="list_sort">
            <label><b>排序</b></label>
            <?php echo $sort(); ?>
        </div>
        <div class="product-list">
             <ul>
                            <?php
                            foreach($items as $item):
                            ?>
                            <li>
                                <div class="r-hover"></div>
                                <form class="xpxp" id="xpxp" action="<?php echo Uri::create('cart/add'); ?>" method="post">
                                    <div class="title-box">
                                        <h3 class="title-md"><a href="<?php echo Uri::create('/m/'.$item->id); ?>"><?php echo $item->title; ?></a></h3>
                                        <span class="price">价值 <b>￥<?php echo sprintf('%.2f' ,$item->cost / Config::get('point')); ?></b></span>
                                    </div>
                                    <div class="img-box img-lg">
                                        <a href="<?php echo Uri::create('m/'.$item->id); ?>" rel="nofollow"><img src="<?php echo \Helper\Image::showImage($item->image, '400x400');?>"/></a>
                                    </div>
                                    
                                    <?php if($item->status == \Helper\Item::IS_CHECK): ?>
                                    <div class="btn-menu">
                                        <span class="left">我要购买</span>
                                        <a class="add btn-jian" href="javascript:void(0);">-</a>
                                        <input type="text" value="1" name="qty" remain="<?php echo $item->remain; ?>"/>
                                        <a class="add btn-jia" href="javascript:void(0);">+</a>
                                        <span class="right">件</span>
                                    </div>
                                    <div class="btn-group">
                                        <input name="id" value="<?php echo $item->id; ?>" type="hidden">
                                        <button class="btn btn-red btn-md" type="submit" >立即购买</button>
                                        <a class="btn btn-y btn-md  doCart" href="javascript:void(0);" phaseId="<?php echo $item->id; ?>">加入购物车</a>
                                    </div>
                                    <?php else: ?>
                                    <div class="btn-group soon">
                                        <button class="btn btn-red" onclick="window.location.href='<?php echo Uri::create('/m/'.$item->id); ?>'; return false;">即将开拍</button>
                                    </div>
                                    <?php endif;?>
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
                          <div class="img-box img-md">
                             <a href="<?php echo Uri::create('m/'.$item->id); ?>" rel="nofollow"><img src="<?php echo \Helper\Image::showImage($item->image, '200x200');?>"/></a>
                             <div class="price fr">价值<b>￥<?php echo sprintf('%.2f', $item->cost / Config::get('point')); ?></b></div>
                          </div>
                          <h4 class="caption"><?php echo $item->title; ?></h4>
                          <div class="btn-group">
                                <form action="<?php echo Uri::create('cart/add'); ?>" method="post">
                                    <input name="id" value="<?php echo $item->id; ?>" type="hidden">
                                    <input name="qty" value="1" type="hidden">
                                    <button class="btn btn-red hot-buy" type="submit">立即购买</button>
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
