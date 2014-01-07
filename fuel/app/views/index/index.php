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
    <div class="content w">
        <!--左边开始-->
        <div class="left-content">
            <!--最新揭晓开始-->
            <div class="announced-news">
                <div class="title">
                    <h4>最新揭晓</h4>
                    <?php echo Html::anchor('w', '更多>>', ['class'=>'more']);?>
                </div>
                <div class="sidebar">
                    <ul>
                        <?php
                            foreach($newWins() as $win) { 

                                if($win->code_count == 0) {
                        ?>
                        <li>
                            <div class="img-box">
                                <?php echo Html::anchor('w/'.$win->id, Html::img($getItemInfo($win->item_id)->image));?>
                            </div>
                            <h5><?php echo Html::anchor('m/'.$win->id, $getPhaseInfo($win->id)->title);?></h5>
                                <div id="win<?php echo $win->id; ?>" class="winner countdown" endtime="<?php echo date('M d, Y H:i:s', $win->opentime);?>" phaseId="<?php echo $win->id; ?>"></div>
                                <div style="display: none">计算中...</div>
                            </li>
                        <?php
                                } else {
                        ?>
                        <li>
                            <div class="img-box">
                                <?php echo Html::anchor('w/'.$win->id, Html::img($getItemInfo($win->item_id)->image));?>
                            </div>
                            <h5><?php echo Html::anchor('m/'.$win->phase_id, $getPhaseInfo($win->id)->title);?></h5>
                            <div class="winner">获得者: <b><?php echo Html::anchor('u/'.$win->member_id, $getMemberInfo($win->member_id)->nickname, ['class'=>'bule']);?></b></div>
                        </li>
                        <?php 
                                }
                            } 
                        ?>
                    </ul>
                </div>
            </div>
            <!--人气推荐开始-->
            <div class="recommended">
                <div class="title">
                    <h4>人气推荐</h4>
                    <?php echo Html::anchor('m', '更多>>', ['class'=>'more']);?>
                </div>
                <ul>
                    <?php foreach($topHotItems() as $phase) { ?>
                    <li>
                        <div class="title-box">
                            <h4><?php echo Html::anchor('m/'.$phase->id, $phase->title);?></h4>
                            <span class="price">价值 <b>￥<?php echo $getItemInfo($phase->item_id)->price;?></b></span>
                        </div>
                        <div class="img-box">
                            <?php echo Html::anchor('m/'.$phase->id, '<img src="http://www.llt.com/'.$getItemInfo($phase->item_id)->image.'" alt="" />');?>
                        </div>
                        <dl class="progress-side">
                            <dd>
                                <div class="progress"><div class="progress-bar" style="width:<?php echo $phase->joined/$phase->amount * 100;?>%"></div></div>
                            </dd>
                            <dd>
                                <span class="fl red"><?php echo $phase->joined;?></span>
                                <span class="fr blue"><?php echo $phase->remain;?></span>
                            </dd>
                            <dd>
                                <span class="fl">已参与人次</span>
                                <span class="fr">剩余人次</span>
                            </dd>
                        </dl>
                        <?php echo Html::anchor('m/'.$phase->id, '<button class="buy">立即乐拍</button>');?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!--左边结束-->
        <!--右边开始-->
        <div class="right-content">
            <!--公告-->
            <div class="notice">
                <div class="title"><h4>乐拍公告 <span class="icon icon-horn"></span></h4></div>
                <ul>
                    <?php foreach($notices() as $notice) { ?>
                    <li><?php echo Html::anchor('/notice', $notice->title); ?></li>
                    <?php } ?>
                </ul>
            </div>
            <!--大家正在乐拍 -->
            <div class="buying-box" >
                <div class="title"><h4>大家正在乐拍</h4></div>
                <div class="buyListdiv" >
                <ul class="buyList">
                    <?php foreach($orders() as $order) {?>
                    <li>
                        <div class="head-img fl">
                            <?php echo Html::anchor('m/'.$order->phase_id, '<img src="http://www.llt.com/'.$getItemInfo($getPhaseInfo($order->phase_id)->item_id)->image.'" alt="" />');?>
                        </div>
                        <div class="info-side">
                            <div class="username"><?php echo Html::anchor('u/'.$order->member_id, $getMemberInfo($order->member_id)->nickname, ['class'=>'bule']);?> 刚刚乐拍了</div>
                            <h4><?php echo Html::anchor('m/'.$order->phase_id, $getPhaseInfo($order->phase_id)->title);?></h4>
                        </div>

                    </li>
               <?php } ?>
                </ul>
                </div>
            </div>
        </div>
        <!--右边结束-->
    </div>
    <!--人气推荐开始-->
    <div class="second w">
        <ul>
            <?php foreach($hotItems() as $phase) { ?>
            <li class="sidebar">
                <div class="title-box">
                    <h4><?php echo Html::anchor('m/'.$phase->id, $phase->title);?></h4>
                    <span class="price">价值 <b>￥<?php echo $getItemInfo($phase->item_id)->price;?></b></span>
                </div>
                <div class="img-box">
                    <?php echo Html::anchor('m/'.$phase->id, '<img src="http://www.llt.com/'.$getItemInfo($phase->item_id)->image.'" alt="" />');?>
                </div>
                <dl class="progress-side">
                    <dd>
                        <div class="progress"><div class="progress-bar" style="width:<?php echo $phase->joined/$phase->amount * 100;?>%"></div></div>
                    </dd>
                    <dd>
                        <span class="fl red"><?php echo $phase->joined;?></span>
                        <span class="fr blue"><?php echo $phase->remain;?></span>
                    </dd>
                    <dd>
                        <span class="fl">已参与人次</span>
                        <span class="fr">剩余人次</span>
                    </dd>
                </dl>
                <?php echo Html::anchor('m/'.$phase->id, '<button class="buy">立即乐拍</button>');?>
            </li>
            <?php } ?>
        </ul>
    </div>

    <!--晒单分享开始-->
    <div class="bask-wrapper w">
        <div class="title">
           <h4>晒单分享</h4>
           <?php echo Html::anchor('p', '更多>>', ['class'=>'more']);?>
        </div>

        <div class="bask-side">
            <?php if($topPost) { ?>
            <div class="bask fl">
                <div class="img-box fl">

                    <?php echo Html::anchor('p/'.$topPost->id, Html::img($topPost->topimage));?>
                </div>
                <div class="bask-info fr">
                    <div class="title-box">
                        <h4 class=""><?php echo Html::anchor('m/'.$topPost->phase_id, $getItemInfo($topPost->item_id)->title);?></h4>
                        <div class="winner">获得者：<b><?php echo Html::anchor('u/'.$topPost->member_id, $getMemberInfo($topPost->member_id)->nickname, ['class'=>'bule']);?></b></div>
                    </div>
                    <div class="bask-content">
                        <?php echo mb_substr($topPost->desc, 0, 120,'utf-8');?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($posts()) { ?>
            <div class="bask-list">
                <ul>
                    <?php foreach($posts() as $post) { ?>
                    <li>
                        <div class="img-box">
                            <?php echo Html::anchor('p/'.$post->id, Html::img($post->topimage));?>
                        </div>
                        <h5><?php echo Html::anchor('m/'.$post->phase_id, $getItemInfo($post->item_id)->title);?></h5>
                        <div class="winner">获得者：<b><?php echo Html::anchor('u/'.$post->member_id, $getMemberInfo($post->member_id)->nickname, ['class'=>'bule']);?></b></div>
                        <p>揭晓时间：<?php  echo date('Y-m-d', $getPhaseInfo($post->phase_id)->opentime);?></p>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
    <!--晒单分享结束-->
    <script>
        RESULT_URL = '<?php echo Uri::create('w/result'); ?>';
    </script>

