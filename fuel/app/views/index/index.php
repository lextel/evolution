<?php echo Asset::css(['jquery.bxslider.css','focus.css','style.css']); ?>
<?php echo Asset::js(['jquery.bxslider.min.js', 'index.js','jquery.totemticker.min.js']);?>
    <!--banner开始-->
    <div class="banner">
        <ul class="rslides f426x240 bxslider">
            <?php foreach($ads() as $ad) { ?>
            <li>
                <a href="<?php echo Uri::create($ad->link); ?>" title="<?php echo $ad->title?>" target="_blank">
                    <img src="<?php echo \Helper\Image::showImage($ad->image);?>"/>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <!--banner结束-->
    <!--内容开始-->
	<div class="w">
		<!--最新揭晓开始-->
        <div class="announced-news fl">
                <div class="title">
                    <h3>最新揭晓</h3>
                    <?php echo Html::anchor('w', '更多>>', ['class'=>'more']);?>
                </div>
                    <ul>
                        <?php
                            foreach($data['wins'] as $win) { 
                                if($win->code_count == 0) {
                        ?>
                        <li class="active">
                            <div class="img-box img-md">
                                <a href="<?php echo Uri::create('w/'.$win->id); ?>" rel="nofollow"><img src="<?php echo \Helper\Image::showImage($win->image, '200x200');?>"/></a>
                            </div>
                            <h4 class="title-br"><?php echo Html::anchor('m/'.$win->id, $win->title);?></h4>
                            <div id="win<?php echo $win->id; ?>" class="news-count countdown" endtime="<?php echo date('M d, Y H:i:s', $win->opentime);?>" phaseId="<?php echo $win->id; ?>"></div>
                            <div style="display: none" class="news-count" >计算中...</div>
                            </li>
                        <?php
                                } else {
                        ?>
                        <li>
                            <div class="img-box img-md">
                                <a href="<?php echo Uri::create('w/'.$win->id); ?>" rel="nofollow"><img src="<?php echo \Helper\Image::showImage($win->image, '200x200');?>"/></a>
                            </div>
                            <h4 class="title-br"><?php echo Html::anchor('w/'.$win->id, $win->title);?></h4>
                            <div class="username">获得者: <?php echo Html::anchor('u/'.$win->member_id, $data['members'][$win->member_id]->nickname, ['class'=>'']);?></div>
                        </li>
                        <?php 
                                }
                            } 
                        ?>
                    </ul>
            </div>
		<!--公告-->
        <div class="notice fr">
                <div class="title"><h3 fl>乐淘公告</h3><span class="icon icon-horn fl"></span></div>
                <ul>
                    <?php foreach($notices() as $notice) { ?>
                    <li><i></i><?php echo Html::anchor('/notice', $notice->title); ?></li>
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
                            <span class="price">价值 <b>￥<?php echo sprintf('%.2f', $phase->cost / Config::get('point')) ?></b></span>
                        </div>
                        <div class="img-box img-lg">
                            <a href="<?php echo Uri::create('m/'.$phase->id); ?>" rel="nofollow"><img src="<?php echo \Helper\Image::showImage($phase->image, '400x400');?>"/></a>
                        </div>
                        <dl class="progress-side">
                            <dd>
                                <div class="progress"><div class="progress-bar" style="width:<?php echo $phase->joined/$phase->amount * 100;?>%"></div></div>
                            </dd>
                            <dd>
                                <span class="fl r"><?php echo $phase->joined;?></span>
                                <span class="fr b"><?php echo $phase->remain;?></span>
                            </dd>
                            <dd>
                                <span class="fl c9">已攒元宝</span>
                                <span class="fr c9">还需元宝</span>
                            </dd>
                        </dl>
                        <div class="btn-group tc">
                            <?php if($phase->status == \Helper\Item::IS_CHECK):?>
                                <?php echo Html::anchor('m/'.$phase->id, '立即一元乐淘', ['rel' => 'nofollow','class'=>'btn btn-red btn-lg']);?>
                            <?php else: ?>
                                <?php echo Html::anchor('m/'.$phase->id, '即将开拍', ['rel' => 'nofollow','class'=>'btn btn-red btn-lg']);?>
                            <?php endif;?>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
        </div>
        <!--大家正在乐淘 -->
        <div class="buying-box fr" >
                <div class="title"><h3>大家正在乐淘</h3></div>
                <div class="buyListdiv" >
                <ul class="buyList">
                    <?php 
                    foreach($data['orders'] as $order) {
                    ?>
                    <li>
                        <div class="img-box img-sm fl">
                            <a href="<?php echo Uri::create('m/'.$order->phase_id); ?>" rel="nofollow"><img src="<?php echo \Helper\Image::showImage($data['phases'][$order->phase_id]->image, '80x80');?>"/></a>
                        </div>
                        <div class="info-side">
                            <div class="username"><?php echo Html::anchor('u/'.$order->member_id, $data['members'][$order->member_id]->nickname, ['class'=>'b']);?>
                             <?php echo \Helper\Timer::friendlyDate($order->created_at);?>乐淘了</div>
                            <h4 class="title-br"><?php echo Html::anchor('m/'.$order->phase_id, $data['phases'][$order->phase_id]->title);?></h4>
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
                    <span class="price">价值 <b>￥<?php echo sprintf('%.2f', $phase->cost / Config::get('point')) ?></b></span>
                </div>
                <div class="img-box img-lg">
                    <a href="<?php echo Uri::create('m/'.$phase->id); ?>" rel="nofollow"><img src="<?php echo \Helper\Image::showImage($phase->image, '400x400');?>"/></a>
                </div>
                <dl class="progress-side">
                    <dd>
                        <div class="progress"><div class="progress-bar" style="width:<?php echo $phase->joined/$phase->amount * 100;?>%"></div></div>
                    </dd>
                    <dd>
                        <span class="fl r"><?php echo $phase->joined;?></span>
                        <span class="fr b"><?php echo $phase->remain;?></span>
                    </dd>
                    <dd>
                        <span class="fl c9">已攒元宝</span>
                        <span class="fr c9">还需元宝</span>
                    </dd>
                </dl>
                <div class="btn-group tc">
                    <?php if($phase->status == \Helper\Item::IS_CHECK):?>
                        <?php echo Html::anchor('m/'.$phase->id, '立即一元乐淘', ['rel' => 'nofollow','class'=>'btn btn-red btn-lg']);?>
                    <?php else: ?>
                        <?php echo Html::anchor('m/'.$phase->id, '即将开拍', ['rel' => 'nofollow','class'=>'btn btn-red btn-lg']);?>
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
                    <span class="price fr">价值 <b>￥<?php echo sprintf('%.2f', $phase->cost / Config::get('point')) ?></b></span>
                </div>
                <div class="img-box img-lg">
                    <a href="<?php echo Uri::create('m/'.$phase->id); ?>" rel="nofollow">
                        <img src="<?php echo \Helper\Image::showImage($phase->image, '400x400');?>"/>
                    </a>
                </div>
                <dl class="progress-side">
                    <dd>
                        <div class="progress"><div class="progress-bar" style="width:<?php echo $phase->joined/$phase->amount * 100;?>%"></div></div>
                    </dd>
                    <dd>
                        <span class="fl r"><?php echo $phase->joined;?></span>
                        <span class="fr b"><?php echo $phase->remain;?></span>
                    </dd>
                    <dd>
                        <span class="fl c9">已攒元宝</span>
                        <span class="fr c9">还需元宝</span>
                    </dd>
                </dl>
                <div class="btn-group tc">
                    <?php if($phase->status == \Helper\Item::IS_CHECK):?>
                        <?php echo Html::anchor('m/'.$phase->id, '立即一元乐淘', ['rel' => 'nofollow','class'=>'btn btn-red btn-lg']);?>
                    <?php else: ?>
                        <?php echo Html::anchor('m/'.$phase->id, '即将开拍', ['rel' => 'nofollow','class'=>'btn btn-red btn-lg']);?>
                    <?php endif;?>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <!--晒单分享开始-->
    <div class="bask-wrapper w">
        <div class="title">
           <h3>晒单分享</h3>
           <?php echo Html::anchor('p', '更多>>', ['class'=>'more']);?>
        </div>

        <div class="bask-side">
            <?php 
                if(isset($data['posts']) && !empty($data['posts'])):
                $post = array_shift($data['posts']);
            ?>
            <div class="bask fl">
                <div class="img-wide fl">
                    <a href="<?php echo Uri::create('p/'.$post->id); ?>" rel="nofollow">
                        <img src="<?php echo \Helper\Image::showImage($post->topimage, '120x120');?>"/>
                    </a>
                </div>
                <div class="bask-info fr">
                    <div class="bask-title">
                        <h3 class="title-md fl"><?php echo Html::anchor('p/'.$post->id, $post->title);?></h3>
                        <div class="username fr">获得者：<b><?php echo Html::anchor('u/'.$post->member_id, $data['members'][$post->member_id]->nickname, ['class'=>'bule']);?></b></div>
                    </div>
                    <div class="bask-content">
                        <?php echo mb_substr($post->desc, 0, 120,'utf-8');?>
                    </div>
                </div>
            </div>
            <div class="bask-list">
                <ul>
                    <?php foreach($data['posts'] as $post) { ?>
                    <li>
                        <div class="img-box img-md">
                            <a href="<?php echo Uri::create('p/'.$post->id); ?>" rel="nofollow">
                                <img src="<?php echo \Helper\Image::showImage($post->topimage, '120x120');?>"/>
                            </a>
                        </div>
                        <h4 class="title-02"><?php echo Html::anchor('p/'.$post->id, $post->title);?></h4>
                        <div class="username">获得者：<b><?php echo Html::anchor('u/'.$post->member_id, $data['members'][$post->member_id]->nickname);?></b></div>
                        <div class="datetime">揭晓时间：<?php  echo date('Y-m-d', $data['phases'][$post->phase_id]->opentime);?></div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php
                endif;
            ?>
        </div>
    </div>
    <!--晒单分享结束-->
    <script>
        RESULT_URL = '<?php echo Uri::create('w/result'); ?>';
    </script>
