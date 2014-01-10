<div class="navbar-inner">
        <ul>
            <li><?php echo Html::anchor('u/'.$member->id, '主页');?></li>
            <li><?php echo Html::anchor('u/'.$member->id.'/orders', '乐拍记录');?></li>
            <li><?php echo Html::anchor('u/'.$member->id.'/wins', '获得的商品');?></li>
            <li class="active"><?php echo Html::anchor('u/'.$member->id.'/posts', '晒单');?></li>
        </ul>
</div>
 <!--晒单-->
        <div class="bask-menu">
            <?php if($posts) { ?>
            <dl>
                <?php foreach($posts as $item) { ?>
                <dd>
                    <div class="img-box img-md fl">
                        <?php echo Html::anchor('/p/'.$item->id, Html::img('/'.$item->topimage));?>
                    </div>
                    <div class="info-side fl">
                        <h5><?php echo Html::anchor('/p/'.$item->id, $item->title);?> </h5>
                        <div class"datetime"> <?php echo \Helper\Timer::friendlyDate($item->created_at);?></div>
                        <div class="text-content">
                            <?php echo $item->desc ;?>
                        </div>
                        <div class="btn-group sns-bar">
                            <a href="javascript:;" class="btn-link sns-love">喜欢<s>(<?php echo $item->up ;?>)</s></a>
                            <a href="javascript:;" class="btn-link sns-comment">评论<s>(<?php echo $item->comment_count ;?>)</s></a>
                        </div>
                    </div>
                </dd>
                <?php } ?>
            </dl>
            <?php echo Pagination::instance('hposts')->render();?>
            <?php } else { ?>
            <p> 该用户暂时没任何的晒单记录</p>
            <?php } ?>
        </div>