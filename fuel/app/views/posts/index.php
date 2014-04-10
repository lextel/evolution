<?php echo Asset::css(['product.css', 'style.css']);?>
<?php echo Asset::js(['jquery.cookie.js', 'post/postup.js']);?>
<div class="wrapper w">
    <div class="title titlecontent">

     <div class="bread">
        <ul>
            <li><a href="<?php echo Uri::create('/')?>">首页</a></li>
            <li><em>&gt;</em></li>
            <li><a href="<?php echo Uri::create('p')?>">晒单分享</a></li>
        </ul>
     </div>
    <div class="title">

        <h2>晒单分享<small>（截止目前共 <b class="r"><?php echo $postscount; ?></b> 个幸运者晒单）</small></h2>
    </div>
    <div class="list_sort">
        <span><b>排序</b></span>
        <?php echo Html::anchor('/p/s/sortnew', '最新晒单', array('class' => ''));?>
        <?php echo Html::anchor('/p/s/sortup', '人气晒单', array('class' => ''));?>
        <?php echo Html::anchor('/p/s/sortcomment', '评论最多', array('class' => ''));?>
    </div>
    <div class="w">
        <ul class="share-list">
        <?php if ($posts): ?>
        <?php $members = $getMembersByPosts($posts);?>
        <?php foreach ([0,1,2,3] as $li){?>
        <li>
                <?php foreach ($posts as $v=>$item){ ?>
                            <?php if (array_search($v, array_keys($posts)) % 4 == $li){?>
                                 <div class="product-item">
                                 <div class="img-box">
                                      <a href="<?php echo Uri::create('p/'.$item->id); ?>">
                                        <img src="<?php echo \Helper\Image::showImage($item->topimage, '235x0');?>"/>
                                      </a>
                                 </div>
                                 <div class="item-head">
                                      <div class="head-img fl">
                                          <a href="<?php echo Uri::create('u/'.$item->member_id); ?>">
                                            <img src="<?php echo \Helper\Image::showImage($members[$item->member_id]->avatar, '60x60');?>"/>
                                          </a>
                                      </div>
                                      <div class="info-side fl">
                                            <div ><?php echo Html::anchor('u/'.$item->member_id, $members[$item->member_id]->nickname);?></div>
                                            <div class="datetime"><?php echo \Helper\Timer::friendlyDate($item->created_at); ?></div>
                                            <h5 class="title-mx"> <?php echo Html::anchor('p/'.$item->id, $item->title);?></h5>
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
    </div>
</div>
