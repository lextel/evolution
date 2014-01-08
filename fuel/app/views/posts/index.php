<?php echo Asset::css(['product.css', 'style.css']);?>
<?php echo Asset::js(['jquery.cookie.js', 'post/postup.js']);?>
<div class="wrapper w">
    <div class="title">
        <h2>晒单分享<small>（截止目前共 <b class="r"><?php echo $postscount; ?></b> 个幸运者晒单）</small></h2>
    </div>
    <div class="list_sort">
        <span>排序</span>
        <?php echo Html::anchor('/p/s/sortnew', '最新晒单', array('class' => 'btn btn-default btn-sx'));?>
        <?php echo Html::anchor('/p/s/sortup', '人气晒单', array('class' => 'btn btn-default btn-sx'));?>
        <?php echo Html::anchor('/p/s/sortcomment', '评论最多', array('class' => 'btn btn-default btn-sx'));?>
    </div>
    <div class="w">
        <ul class="share-list">
        <?php if ($posts): ?>
        <?php foreach ([0,1,2,3] as $li){?>
        <li class="product-item">
        <?php foreach ($posts as $v=>$item){ ?>
            <?php if (array_search($v, array_keys($posts)) % 4 == $li){?>
                 <div class="img-box">
                     <?php echo Html::anchor('/p/'.$item->id, Html::img($getItem($item->item_id)->image));?>
                 </div>
                 <div class="item-head">
                      <div class="head-img fl">
                           <?php echo Html::anchor('u/'.$item->member_id, Html::img($getUser($item->member_id)->avatar));?>
                      </div>
                      <div class="info-side fl">
                            <div class="username"><?php echo Html::anchor('u/'.$item->member_id, $getUser($item->member_id)->username);?></div>
                            <div class="datetime"><?php echo \Helper\Timer::friendlyDate($item->created_at); ?></div>
                      </div>
                 </div>
                 <div class="item-footer">
                       <div class="content-md">
                            <?php echo mb_substr($item->desc, 0, 42,'utf-8'); ?>
                       </div>
                       <div class="btn-group sns-bar">
                            <?php echo Html::anchor('javascript:;', '喜欢(<s>'.$item->up.'</s>)', array('class'=>'btn-link sns-love', 'id'=>$item->id));?>
                            <?php echo Html::anchor('/p/'.$item->id, '评论(<s>'.$item->comment_count.'</s>)', array('class'=>'btn-link sns-comment'));?>
                       </div>
                 </div>
            <?php }; ?>
        <?php }; ?>
        </li>
        <?php }; ?>
        <?php else: ?>

        <?php endif; ?>
        </ul>
        <!--分页-->
        <?php echo Pagination::instance('postspage')->render(); ?>
        <!--<div class="pagination fr">
            <span><a href="" class="previous-inactive">上一页&lt;</a></span>
            <span><a href="" class="active">1</a></span>
            <span><a href="">2</a></span>
            <span><a href="">3</a></span>
            <span><a href="">4</a></span>
            <span><a href="" class="next">下一页&gt;</a></span>
        </div>-->
    </div>
</div>
