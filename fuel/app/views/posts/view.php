<?php echo Asset::css(['product.css', 'style.css']);?>
<?php echo Asset::js(['jquery.cookie.js', 'post/postup.js']);?>
<?php echo Asset::css('member/validfrom_style.css'); ?>
<?php echo Asset::js('Validform_v5.3.2_min.js'); ?>
<div class="w">
   <div class="bask-wide">
       <div class="title-bar">
           <h2><?php echo $post->title; ?></h2>
           <div class="datetime">晒单时间：<?php echo date('Y-m-d H:i:s', $post->created_at); ?></div>
       </div>
       <ul class="pane-hd">
           <li>
               <div class="head-img fl">
                  <a href="<?php echo Uri::create('u/'.$post->member_id); ?>">
                    <img src="<?php echo \Helper\Image::showImage($getUser($post->member_id)->avatar, '60x60');?>"/>
                  </a>
               </div>
               <div class="info fl">
                   <span class="username">幸运获奖者：<?php echo Html::anchor('u/'.$post->member_id, $getUser($post->member_id)->nickname, ['class'=>'blue']);?></span>
                   <span class="number">共乐淘：<b><?php echo $getPhase($post->phase_id)->code_count;?></b> 元宝</span>
                   <span class="number">幸运乐淘码：<b><?php echo $getPhase($post->phase_id)->code;?></b></span>
                   <span class="datetime">揭晓时间：<s><?php echo date('Y-m-d H:i:s', $getPhase($post->phase_id)->opentime);?></s></span>
               </div>
           </li>
           <li>
               <div class="img-box img-sm fl">
                    <a href="<?php echo Uri::create('m/'.$post->phase_id); ?>" rel="nofollow">
                        <img src="<?php echo \Helper\Image::showImage($getItem($post->item_id)->image, '80x80');?>"/>
                    </a>
               </div>
               <div class="info fl">
                   <span class="title-sm">
                       (第<?php echo $getPhase($post->phase_id)->phase_id; ?>期)<?php echo Html::anchor('/m/'.$post->phase_id, $getItem($post->item_id)->title); ?>|
                   </span>
                   <span class="price">价值<b>￥<?php echo $getItem($post->item_id)->price;?>.00</b></span>
                   <?php $phase = $getLastPhase($post->item_id);?>
                   <?php if ($phase) { ?>
                   <a href="<?php echo Uri::create('/m/'.$phase->id);?>" class="underway">第<?php echo $phase->phase_id;?>期进行中...</a>
                   <?php } ?>
               </div>
           </li>
       </ul>
       <div class="pane-bd">
       <p><?php echo $post->desc; ?>
       </p>
       <?php foreach(unserialize($post->images) as $img) { ?>
           <p style="text-align: center;text-indent: 0;">
           <img src="<?php echo $img;?>" />
           </p>
       <?php } ?>
       </div>
       <div class="btn-group sns-bar">
           <?php echo Html::anchor('javascript:;', '喜欢(<s>'.$post->up.'</s>)', array('class'=>'btn-link sns-love', 'id'=>$post->id));?>
           <span class="btn-link sns-comment"><a href="#comment">评论</a>(<s><?php echo $post->comment_count;?></s>)</span>
       </div>
       <div class="comment-panel" name="comment">
           <div class="comment-box">
               <input id="<?php echo $post->id;?>" type="hidden" class="postid">
               <textarea name="text" id="comment" cols="30" rows="4"></textarea>
               <div class="comment-footer">
                   <!--<div class="expression fl"><span class="icon icon-expression"></span>表情</div>-->
                   <button class="fr btn btn-default btn-comment">发表评论</button>
                   <span class="fr comment-count">还可以输入<b>200</b>字</span>
               </div>
           </div>
           <dl class="comment-list">
               <dt><h4>全部评论</h4></dt>
           </dl>
       </div>
       <!--弹出登录框-->
       <div class="login2">
           <form action="/signin" method="POST" class="demoform">
               <div class="login2-head">
                 <h3>用户登录</h3>
                  <button class="close" id="close"></button>
               </div>
               <label for="" class="error2"></label>
               <ul class="login2-body">
                   <li>
                       <input name="username" type="text" value="" placeholder="用户邮箱" datatype="e" errorms="请输入邮箱帐号" />
                       <span class="icon-user"></span>
                        <span class="Validform_checktip"></span>
                   </li>
                   <li>
                       <input name="password"  type="password" value="" placeholder="用户密码"  datatype="*6-18" errorms="密码范围在6-18位之间" />
                       <span class="icon-password"></span>
                       <span class="Validform_checktip"></span>
                   </li>
                   <li>

                       <button class="btn btn-red btn-modal fl">登录</button>
                       <a href="/forgot" class="fr">忘记密码？</a>
                   </li>
               </ul>
               <div class="register-bar">还没有帐号？<a href="/signup" class="register blue">马上注册</a> </div>
           </form>
       </div>
   </div>
    <div class="sidebar fr">
        <div class="title-red">
            <h3>往期获得者</h3>
            <div class="arrow-menu">
                <a href="javascript:void(0)" class="arrow-on" id="prev"></a>
                <a href="javascript:void(0)" class="arrow-up" id="next"></a>
            </div>
        </div>
        <div class="overdueList" id="scrollDiv">
        <ul class="before">
            <?php $lwins = $getLastWins($post->item_id);?>
            <?php if ($lwins) { ?>
            <?php $members = $getMembersByPhases($lwins);?>
            <?php foreach($lwins as $lwin){?>
            <li>
                <div class="head-img fl">
                  <a href="<?php echo Uri::create('u/'.$lwin->member_id); ?>">
                    <img src="<?php echo \Helper\Image::showImage($members[$lwin->member_id]->avatar, '60x60');?>"/>
                  </a>
                </div>
                <div class="info-side">
                        <div class="username">
                            <?php echo Html::anchor('u/'.$lwin->member_id, $members[$lwin->member_id]->nickname, ['class'=>'blue']);?>
                            <s class="datetime"><?php echo '获得了第'.$lwin->phase_id.'期';?></s>
                        </div>
                    <?php if($lwin->post_id == 0){?>
                        <div class="no-show">暂未晒单</div>
                    <?php }else{?>
                        <p><?php echo Html::anchor('p/'.$lwin->post_id, '晒单详情', ['class'=>'btn-sm btn-y']);?></p>
                    <?php }?>
                </div>
            </li>
            <?php }?>
            <?php }?>
        </ul>
        </div>
        <div class="title-red">
            <h3 class="fl">最新晒单</h3>
        </div>
        <ul class="news">
            <?php $nposts = $getNewPosts();
                   $npostMembers = $getMembersByPosts($nposts);
            ?>
            <?php foreach($nposts as $npost) { ?>
            <li>
               <div><?php echo Html::anchor('u/'.$npost->member_id, $npostMembers[$npost->member_id]->nickname, ['class'=>'blue username']);?>
               <s class="datetime"><?php echo \Helper\Timer::friendlyDate($npost->created_at); ?></s>
               </div>

               <div class="content-md">
                    <?php echo Html::anchor('p/'.$npost->id, mb_substr($npost->desc, 0, 100,'utf-8')); ?>
               </div>
               <dl class="images-list">
                    <a href="<?php echo Uri::create('p/'.$npost->id)?>">
                    <?php foreach(unserialize($npost->images) as $v=>$img1) { ?>
                    <?php if ($v < 3) { ?>
                    <dd>
                        <img src="<?php echo \Helper\Image::showImage($img1, '70x70');?>"/>
                    </dd>
                    <?php } ?>
                    <?php } ?>
                    </a>
               </dl>
            </li>
            <?php }?>
        </ul>
    </div>
</div>
<!--评论-->
<script type="text/javascript">
    $(function(){
    	$(".demoform").Validform({
    	tiptype:4
    	});
    });
</script>
