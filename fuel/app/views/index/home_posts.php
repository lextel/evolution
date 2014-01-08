<div class="navbar-inner">
        <ul>
            <li><?php echo Html::anchor('u/'.$member->id, '主页');?></li>
            <li><?php echo Html::anchor('u/'.$member->id.'/orders', '乐拍记录');?></li>
            <li><?php echo Html::anchor('u/'.$member->id.'/wins', '获得的商品');?></li>
            <li class="active"><?php echo Html::anchor('u/'.$member->id.'/posts', '晒单');?></li>
        </ul>
        <!--晒单-->
        <div class="home-c">
            <?php if($posts) { ?>
            <dl class="bask-menu">
                <?php foreach($posts as $item) { ?>
                <dd>
                    <div class="img-box fl">
                        <?php echo Html::anchor('/p/'.$item->id, Html::img('/'.$item->topimage));?>
                    </div>
                    <div class="info-side fr">
                        <h4 class="fl"><?php echo Html::anchor('/p/'.$item->id, $item->title);?>
                            <small> <?php echo \Helper\Timer::friendlyDate($item->created_at);?></small>
                        </h4>
                        <div class="text-content">
                            <?php echo $item->desc ;?>
                        </div>
                        <div class="btn-group">
                            <a href="javascript:;" class="btn btn-link">喜欢<s>(<?php echo $item->up ;?>)</s></a>
                            <a href="javascript:;" class="btn btn-link">评论<s>(<?php echo $item->comment_count ;?>)</s></a>
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
</div>
