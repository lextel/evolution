<?php echo Asset::css(['product.css', 'style.css']);?>
<?php echo Asset::js(['jquery.cookie.js','common.js', 'post/postup.js']);?>
<div class="share-details w">
   <div class="left-content">
       <div class="content-title">
           <h3><?php echo $post->title; ?></h3>
           <div class="datetime">晒单时间：<?php echo date('Y-m-d H:i:s', $post->created_at); ?></div>
       </div>
       <ul class="content-nav">
           <li>
               <div class="head-img fl">
                   <?php echo Html::anchor('u/'.$post->member_id, Html::img($getUser($post->member_id)->avatar));?>
               </div>
               <div class="info fl">
                   <span class="text-title blue">幸运获奖者：<?php echo Html::anchor('u/'.$post->member_id, $getUser($post->member_id)->username, ['class'=>'blue']);?></span>
                   <span>共乐拍：<b>1</b> 人次</span>
                   <span>幸运乐拍码：<b>1000000</b></span>
                   <span class="datetime">揭晓时间：<s>2013-11-22 22:10:10</s></span>
               </div>
           </li>
           <li>
               <div class="head-img fl">
                   <?php echo Html::anchor('m/'.$post->item_id, Html::img($getItem($post->item_id)->image));?>
               </div>


               <div class="info fl">
                   <span class="text-title blue">
                       (第<?php echo $post->phase_id; ?>期)<?php echo Html::anchor('/m/'.$post->item_id, $getItem($post->item_id)->title); ?>|
                   </span>
                   <span class="price">价值<b>￥<?php echo $getItem($post->item_id)->price;?></b></span>
                   <a href="" class="btn btn-default btn-sx">第48期进行中...</a>
               </div>
           </li>
       </ul>
       <div class="content">
       <p><?php echo $post->desc; ?>
       </p>
       <?php foreach(unserialize($post->images) as $img) { ?>
           <?php echo Html::img($img); ?>
       <?php } ?>
       </div>
       <div class="btn-group">
           <?php echo Html::anchor('javascript:;', '喜欢(<s>'.$post->up.'</s>)', array('class'=>'btn btn-link btn-up', 'id'=>$post->id));?>
           <?php echo Html::anchor('javascript:;', '评论(<s>'.$post->comment_count.'</s>)', array('class'=>'btn btn-link btn-comment'));?>
       </div>
   </div>
    <div class="content-right fr">
        <div class="title">
            <h4 class="fl">往期获得者</h4>
        </div>
        <ul class="before">
            <?php foreach($getLastWins($post->item_id) as $lwin){?>
            <li>
                <div class="head-img fl">
                    <?php echo Html::anchor('u/'.$lwin->member_id, Html::img($getUser($lwin->member_id)->avatar));?>
                </div>
                <div class="info-side">
                    <div class="info-side-head">
                        <span class="name blue"><?php echo Html::anchor('u/'.$lwin->member_id, $getUser($lwin->member_id)->username, ['class'=>'blue']);?></span>
                        <span class="datetime"><?php echo '获得了第'.$lwin->phase_id.'期';?></span>
                    </div>
                    <?php if($lwin->post_id == 0){?>
                        <p>暂未晒单</p>
                    <?php }else{?>
                        <p><?php echo Html::anchor('p/'.$lwin->post_id, '查看晒单', ['class'=>'blue']);?></p>
                    <?php }?>
                </div>
            </li>
            <?php }?>
        </ul>
        <div class="title">
            <h4 class="fl">最新晒单</h4>
        </div>
        <ul class="news">
            <?php foreach($getNewPosts() as $npost){?>
            <li>
                <div class="info-side">
                    <div class="info-side-head">
                        <span class="name blue"><?php echo Html::anchor('u/'.$npost->member_id, $getUser($npost->member_id)->username, ['class'=>'blue']);?></span>
                        <span class="datetime"><?php echo date('Y-m-d H:i:s', $npost->created_at); ?></span>
                    </div>
                    <div class="new-text">
                        <?php echo Html::anchor('p/'.$npost->id, mb_substr($npost->desc, 0, 100,'utf-8')); ?>
                    </div>
                    <dl class="images-list">
                       <a href="<?php echo Uri::create('p/'.$npost->id)?>">
                       <?php foreach(unserialize($npost->images) as $img1) { ?>
                        <dd><?php echo Html::img($img1); ?></dd>
                        <?php } ?>
                       </a>
                    </dl>
                </div>
            </li>
            <?php }?>
        </ul>
    </div>
</div>
<!--评论-->
<div class="comment-panel w">
    <div class="comment-box">
        <input id="<?php echo $post->id;?>" type="hidden" class="postid">
        <textarea name="text" id="comment" cols="30" rows="5"></textarea>
        <div class="comment-footer">
            <div class="expression fl"><span class="icon icon-expression"></span>表情</div>
            <button class="fr btn btn-default btn-comment">发表评论</button>
            <span class="fr"><s>0</s>/200字</span>
        </div>
    </div>
    <dl class="comment-list">
        <dt><h4>全部评论</h4></dt>
        <dd>
            <div class="head-img fl">
                <a href=""><img src="img/96515277.jpg" alt=""/></a>
            </div>
            <div class="info-side">
                <div class="info-side-head">
                    <span class="name blue">幸运获奖者</span>
                    <span class="datetime">55分钟前</span>
                </div>
                <div class="comment-text">
                    我也想中一个！
                </div>
                <!--
                <button class="btn btn-link blue">回复</button>

                <div class="comment-box d-n">
                    <textarea name="" cols="30" rows="4"></textarea>
                    <div class="comment-footer">
                        <div class="head-img fl">
                            <a href=""><img src="img/96515277.jpg" alt=""/></a>
                        </div>
                        <div class="btn-group fl">
                            <a href="" class="blue">登录</a>
                        </div>
                        <div class="expression fl">表情</div>
                        <button class="fr btn btn-default">发表评论</button>
                        <span class="fr"><s>0</s>/200字</span>
                    </div>
                </div>
                -->
            </div>
        </dd>

    </dl>
</div>
