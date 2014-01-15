<?php echo Asset::css(['jquery.bxslider.css','focus.css','style.css']); ?>
<?php echo Asset::js(['jquery.bxslider.min.js', 'index.js','jquery.totemticker.min.js']);?>
    <!--banner开始-->
    <div class="banner">
        <ul class="rslides f426x240 bxslider">
            <?php foreach($ads() as $ad) { ?>
            <li><?php echo Html::anchor($ad->link, Html::img($ad->image), ['target'=>'_blank', 'title' => $ad->title]);?></li>
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
                                <?php echo Html::anchor('w/'.$win->id, Html::img($win->image, ['rel' => 'nofollow']));?>
                            </div>
                            <h4 clsss="title-br"><?php echo Html::anchor('m/'.$win->id, $win->title);?></h4>
                            <div id="win<?php echo $win->id; ?>" class="news-count countdown" endtime="<?php echo date('M d, Y H:i:s', $win->opentime);?>" phaseId="<?php echo $win->id; ?>"></div>
                            <div style="display: none" class="news-count" >计算中...</div>
                            </li>
                        <?php
                                } else {
                        ?>
                        <li>
                            <div class="img-box img-md">
                                <?php echo Html::anchor('w/'.$win->id, Html::img($win->image), ['rel' => 'nofollow']);?>
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
                <div class="title"><h3>乐拍公告 <span class="icon icon-horn"></span></h3></div>
                <ul>
                    <?php foreach($notices() as $notice) { ?>
                    <li><?php echo Html::anchor('/notice', $notice->title); ?></li>
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
             <ul>
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
                            <?php echo Html::anchor('m/'.$phase->id, Html::img('image/400x400/'.$phase->image), ['rel' => 'nofollow']);?>
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
                                <span class="fl">已参与人次</span>
                                <span class="fr">剩余人次</span>
                            </dd>
                        </dl>
                        <?php echo Html::anchor('m/'.$phase->id, '<button class="buy">立即乐拍</button>', ['rel' => 'nofollow']);?>
                    </li>
                    <?php } ?>
                </ul>
        </div>
        <!--大家正在乐拍 -->
        <div class="buying-box fr" >
                <div class="title"><h3>大家正在乐拍</h3></div>
                <div class="buyListdiv" >
                <ul class="buyList">
                    <?php 
                    foreach($data['orders'] as $order) {
                    ?>
                    <li>
                        <div class="img-box img-sm fl">
                            <?php echo Html::anchor('m/'.$order->phase_id, Html::img('image/80x80/'.$data['phases'][$order->phase_id]->image), ['rel' => 'nofollow']);?>
                        </div>
                        <div class="info-side">
                            <div class="username"><?php echo Html::anchor('u/'.$order->member_id, $data['members'][$order->member_id]->nickname, ['class'=>'b']);?>
                             <?php echo \Helper\Timer::friendlyDate($order->created_at);?>乐拍了</div>
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
        <ul>
            <?php foreach($hotItems() as $phase) { ?>
            <li>
                <div class="title-box">
                    <h3 class="title-md"><?php echo Html::anchor('m/'.$phase->id, $phase->title);?></h3>
                    <span class="price">价值 <b>￥<?php echo sprintf('%.2f', $phase->cost / Config::get('point')) ?></b></span>
                </div>
                <div class="img-box img-lg">
                    <?php echo Html::anchor('m/'.$phase->id, Html::img('image/400x400/'.$phase->image), ['rel' => 'nofollow']);?>
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
                        <span class="fl">已参与人次</span>
                        <span class="fr">剩余人次</span>
                    </dd>
                </dl>
                <?php echo Html::anchor('m/'.$phase->id, '<button class="buy">立即乐拍</button>', ['rel' => 'nofollow']);?>
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
                <div class="img-box img-md fl">
                    <?php echo Html::anchor('p/'.$post->id, Html::img($post->topimage), ['rel' => 'nofollow']);?>
                </div>
                <div class="bask-info fr">
                    <div class="title-box">
                        <h3 class="title-md"><?php echo Html::anchor('p/'.$post->id, $post->title);?></h3>
                        <div class="winner">获得者：<b><?php echo Html::anchor('u/'.$post->member_id, $data['members'][$post->member_id]->nickname, ['class'=>'bule']);?></b></div>
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
                            <?php echo Html::anchor('p/'.$post->id, Html::img($post->topimage));?>
                        </div>
                        <h4 class="title-mx"><?php echo Html::anchor('p/'.$post->id, $post->title);?></h4>
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

