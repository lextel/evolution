<?php echo Asset::css(['jquery.bxslider.css','focus.css','style.css']); ?>
<?php echo Asset::js(['jquery.bxslider.min.js', 'index.js','jquery.totemticker.min.js']);?>
    <!--banner开始-->
    <div class="banner">
        <ul class="rslides f426x240 bxslider">
            <?php foreach($ads() as $ad) { ?>
            <li>
                <a href="<?php echo Uri::create(\Classes\AdLink::getItemId($ad->link)); ?>" title="<?php echo $ad->title?>" target="_blank">
                    <img src="<?php echo \Helper\Image::showImage($ad->image);?>"/>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <!--banner结束-->
    <!--内容开始-->
    <div class="w">

        <!--最新开始-->
        <div class="announced-news fl">
                <div class="title">
                    <h3>最新上架</h3>
                    <?php echo Html::anchor('m', '更多>>', ['class'=>'more']);?>
                </div>
                    <ul>
                        <?php
                            foreach($data['wins'] as $win) {
                        ?>
                        <li>
                            <div class="img-box img-md">
                                <a href="<?php echo Uri::create('m/'.$win->id); ?>" rel="nofollow"><img src="<?php echo \Helper\Image::showImage($win->image, '200x200');?>"/></a>
                            </div>
                            <h4 class="title-br"><?php echo Html::anchor('m/'.$win->id, $win->title);?></h4>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
            </div>
        <!--公告-->
        <div class="notice fr">
                <div class="title"><h3 fl>商城公告</h3><span class="icon icon-horn fl"></span></div>
                <ul>
                    <?php foreach($notices() as $notice) { ?>
                    <li><i></i><?php echo Html::anchor('notice/'.$notice->id, $notice->title); ?></li>
                    <?php } ?>
                </ul>
            </div>
    </div>
    <div class="w">
        <!--人气推荐开始-->
         <div class="recommended fl">
            <div class="title">
                    <h3>人气推荐</h3>
                    <?php echo Html::anchor('m', '更多>>', ['class'=>'more']);?>
                </div>
             <ul class="list-hover">
                    <?php
                        Config::load('common');
                        foreach($topHotItems() as $phase) {
                    ?>
                    <li>
                        <div class="title-box">
                            <h3 class="title-md"><?php echo Html::anchor('m/'.$phase->id, $phase->title);?></h3>
                            <span class="price">价值 <b>￥<?php echo sprintf('%.2f', $phase->price) ?></b></span>
                        </div>
                        <div class="img-box img-lg">
                            <a href="<?php echo Uri::create('m/'.$phase->id); ?>" rel="nofollow"><img src="<?php echo \Helper\Image::showImage($phase->image, '400x400');?>"/></a>
                        </div>
                        <div class="btn-group tc">
                            <?php if($phase->status == \Helper\Item::IS_CHECK):?>

                                <?php echo Html::anchor('m/'.$phase->id, '立即购买', ['rel' => 'nofollow','class'=>'btn btn-red btn-lg']);?>
                            <?php else: ?>
                                <?php echo Html::anchor('m/'.$phase->id, '即将开卖', ['rel' => 'nofollow','class'=>'btn btn-red btn-lg']);?>
                            <?php endif;?>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
        </div>
        <!--大家正在乐淘 -->
        <div class="buying-box fr" >
                <div class="title"><h3>大家正在购买</h3></div>
                <div class="buyListdiv" >
                <ul class="buyList">
                    <?php
                    foreach($data['orders'] as $order) {
                    ?>
                    <li>
                        <div class="img-wide fl">
                            <a href="<?php echo Uri::create('m/'.$order->phase_id); ?>" rel="nofollow">
                            <?php if(isset($data['phases'][$order->phase_id]->image)):?>
                                <img src="<?php echo \Helper\Image::showImage($data['phases'][$order->phase_id]->image, '80x80');?>"/>
                            <?php endif;?>
                            </a>
                        </div>
                        <div class="info-side fr">
                            <div class="username">
                                <?php echo Html::anchor('u/'.$order->member_id, $data['members'][$order->member_id]->nickname, ['class'=>'b']);?>
                                <?php echo \Helper\Timer::friendlyDate($order->created_at);?>购买了
                             </div>
                            <h4 class="title-br"><?php echo Html::anchor('m/'.$order->phase_id, $order->title);?></h4>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                </div>
            </div>
        </div>
    </div>
    <!--人气推荐2开始-->
    <div class="second w">
        <ul class="list-hover">
            <?php foreach($hotItems() as $phase) { ?>
            <li>
                <div class="title-box">
                    <h3 class="title-md"><?php echo Html::anchor('m/'.$phase->id, $phase->title);?></h3>
                    <span class="price">价值 <b>￥<?php echo sprintf('%.2f', $phase->price) ?></b></span>
                </div>
                <div class="img-box img-lg">
                    <a href="<?php echo Uri::create('m/'.$phase->id); ?>" rel="nofollow"><img src="<?php echo \Helper\Image::showImage($phase->image, '400x400');?>"/></a>
                </div>
                <div class="btn-group tc">
                    <?php if($phase->status == \Helper\Item::IS_CHECK):?>

                        <?php echo Html::anchor('m/'.$phase->id, '立即购买', ['rel' => 'nofollow','class'=>'btn btn-red btn-lg']);?>
                    <?php else: ?>
                        <?php echo Html::anchor('m/'.$phase->id, '即将开卖', ['rel' => 'nofollow','class'=>'btn btn-red btn-lg']);?>
                    <?php endif;?>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>

    <!--编辑推荐-->
    <div class="editor w">
            <div class="title">
            <h3>编辑推荐</h3>
        </div>
        <ul class="list-hover">
            <?php foreach($getRecommends() as $phase) { ?>
            <li>
                <div class="title-box">
                    <h3 class="title-md"><?php echo Html::anchor('m/'.$phase->id, $phase->title);?></h3>
                    <span class="price fr">价值 <b>￥<?php echo sprintf('%.2f', $phase->price) ?></b></span>
                </div>
                <div class="img-box img-lg">
                    <a href="<?php echo Uri::create('m/'.$phase->id); ?>" rel="nofollow">
                        <img src="<?php echo \Helper\Image::showImage($phase->image, '400x400');?>"/>
                    </a>
                </div>
                <div class="btn-group tc">
                    <?php if($phase->status == \Helper\Item::IS_CHECK):?>

                        <?php echo Html::anchor('m/'.$phase->id, '立即购买', ['rel' => 'nofollow','class'=>'btn btn-red btn-lg']);?>
                    <?php else: ?>
                        <?php echo Html::anchor('m/'.$phase->id, '即将开卖', ['rel' => 'nofollow','class'=>'btn btn-red btn-lg']);?>
                    <?php endif;?>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <script>
        RESULT_URL = '<?php echo Uri::create('w/result'); ?>';
    </script>
