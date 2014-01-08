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
                   <span class="text-title blue">幸运获奖者：<?php echo Html::anchor('u/'.$post->member_id, $getUser($post->member_id)->nickname, ['class'=>'blue']);?></span>
                   <?php $winPhase = $getPhase($post->phase_id);?>
                   <span>共乐拍：<b><?php echo $winPhase ? $winPhase->code_count : 0;?></b> 人次</span>
                   <span>幸运乐拍码：<b><?php echo $winPhase ? $winPhase->code : '00000000';?></b></span>
                   <span class="datetime">揭晓时间：<s><?php echo Date('Y-m-d H:i:s', $winPhase ? $winPhase->opentime : 0);?></s></span>
               </div>
           </li>
           <li>
               <div class="head-img fl">
                   <?php echo Html::anchor('m/'.$post->phase_id, Html::img($getItem($post->item_id)->image));?>
               </div>


               <div class="info fl">
                   <span class="text-title blue">
                       (第<?php echo $winPhase->phase_id; ?>期)<?php echo Html::anchor('/m/'.$post->phase_id, $getItem($post->item_id)->title); ?>
                   </span>
                   <span class="price">价值<b>￥<?php echo $getItem($post->item_id)->price;?>.00</b></span>
                   <?php if ($getLastPhase($post->item_id)) { ?>
                   <a href="<?php echo Uri::create('/m/'.$getLastPhase($post->item_id)->id);?>" class="btn btn-default btn-sx">第<?php echo $getLastPhase($post->item_id)->phase_id;?>期进行中...</a>
                   <?php } ?>
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
           <span>评论(<s><?php echo $post->comment_count;?></s>)</span>

       </div>
   </div>
    <div class="content-right fr">
        <div class="title">
            <h4 class="fl">往期获得者</h4>
        </div>
        <ul class="before">
            <?php $lwins = $getLastWins($post->item_id);?>
            <?php if ($lwins) { ?>
            <?php foreach($lwins as $lwin){?>
            <li>
                <div class="head-img fl">
                    <?php echo Html::anchor('u/'.$lwin->member_id, Html::img($getUser($lwin->member_id)->avatar));?>
                </div>
                <div class="info-side">
                    <div class="info-side-head">
                        <span class="name blue"><?php echo Html::anchor('u/'.$lwin->member_id, $getUser($lwin->member_id)->nickname, ['class'=>'blue']);?></span>
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
                        <span class="name blue"><?php echo Html::anchor('u/'.$npost->member_id, $getUser($npost->member_id)->nickname, ['class'=>'blue']);?></span>
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
            <span class="fr btn-commentcount">还可以输入<s>200</s>字</span>
        </div>
    </div>
    <dl class="comment-list">
        <dt><h4>全部评论</h4></dt>
        
    </dl>
</div>
<!--弹出登录框-->
<div class="login2">
    <form action="/signin" method="POST">
        <div class="login2-head">
          <h4>用户登录</h4>
           <button class="close" id="close"></button>
        </div>
        <label for="" class="error"></label>
        <ul class="login2-body">
            <li>
                <input name="username" type="text" value="" placeholder="用户邮箱" />
                <span class="icon-user"></span>
            </li>
            <li>
                <input name="password"  type="text" value="" placeholder="用户密码" />
                <span class="icon-password"></span>
            </li>
            <li>
                <a href="" class="fr">忘记密码？</a>
            </li>
            <li>
                <button class=" btn btn-red">登录</button>
            </li>
            <li>还没有帐号？<a href="/signup" class="register">马上注册</a> </li>
        </ul>
    </form>
</div>
