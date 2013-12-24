<?php echo Asset::css(['product.css', 'style.css']);?>
<div class="share-details w">
   <div class="left-content">
       <div class="content-title">
           <h3><?php echo $post->title; ?></h3>
           <div class="datetime">晒单时间：<?php echo $post->created_at; ?></div>
       </div>
       <ul class="content-nav">
           <li>
               <div class="head-img fl">
                   <a href=""><img src="img/96515277.jpg" alt=""/></a>
               </div>
               <?php echo $post->member_id; ?>
               <div class="info fl">
                   <span class="text-title blue">幸运获奖者：<a href="">终于中奖了</a></span>
                   <span>共乐拍：<b>1</b> 人次</span>
                   <span>幸运乐拍码：<b>1000000</b></span>
                   <span class="datetime">揭晓时间：<s>2013-11-22 22:10:10</s></span>
               </div>
           </li>
           <li>
               <div class="head-img fl">
                   <a href=""><img src="img/96515277.jpg" alt=""/></a>
               </div>
               <?php echo $post->item_id; ?>|
	           <?php echo $post->phase_id; ?>
               <div class="info fl">
                   <span class="text-title blue">
                       (第22期)<a href="">苹果苹果苹果苹果苹果苹果苹果苹果</a>
                   </span>
                   <span class="price">价值<b>￥3188.00</b></span>
                   <a href="" class="btn btn-default btn-sx">第48期进行中...</a>
               </div>
           </li>
       </ul>
       <div class="content">
       <?php echo $post->desc; ?>
       <?php echo $post->images; ?>
       </div>
       <div class="btn-group">
           <a href="" class="btn btn-link">喜欢<s>(0)</s></a>
           <a href="" class="btn btn-link">评论<s>(0)</s></a>
       </div>
   </div>
    <div class="content-right fr">
        <div class="title">
            <h4 class="fl">往期获得者</h4>
        </div>
        <ul class="before">
            <li>
                <div class="head-img fl">
                    <a href=""><img src="img/96515277.jpg" alt=""/></a>
                </div>
                <div class="info-side">
                    <div class="info-side-head">
                        <span class="name blue">幸运获奖者</span>
                        <span class="datetime">获得了第30期</span>
                    </div>
                    <p>暂未晒单</p>
                </div>
            </li>
            <li>
                <div class="head-img fl">
                    <a href=""><img src="img/96515277.jpg" alt=""/></a>
                </div>
                <div class="info-side">
                    <div class="info-side-head">
                        <span class="name blue">幸运获奖者</span>
                        <span class="datetime">获得了第30期</span>
                    </div>
                    <p>暂未晒单</p>
                </div>
            </li>
            <li>
                <div class="head-img fl">
                    <a href=""><img src="img/96515277.jpg" alt=""/></a>
                </div>
                <div class="info-side">
                    <div class="info-side-head">
                        <span class="name blue">幸运获奖者</span>
                        <span class="datetime">获得了第30期</span>
                    </div>
                    <p>暂未晒单</p>
                </div>
            </li>
        </ul>
        <div class="title">
            <h4 class="fl">最新晒单</h4>
        </div>
        <ul class="news">
            <li>
                <div class="info-side">
                    <div class="info-side-head">
                        <span class="name blue">幸运获奖者</span>
                        <span class="datetime">今天 14:32</span>
                    </div>
                    <div class="new-text">
                        今天终于中奖了今天终于中奖了今天终于中奖了今天终于中奖了今天终于中奖了今天终于中奖了今天终于中奖了今天终于中奖了
                    </div>
                    <dl class="images-list">
                        <dd><a href=""><img src="img/96515277.jpg" alt=""/></a></dd>
                        <dd><a href=""><img src="img/96515277.jpg" alt=""/></a></dd>
                        <dd><a href=""><img src="img/96515277.jpg" alt=""/></a></dd>
                    </dl>
                </div>
            </li>
        </ul>
    </div>
</div>
<!--评论-->
<div class="comment-panel w">
    <div class="comment-box">
        <textarea name="" id="" cols="30" rows="4"></textarea>
        <div class="comment-footer d-n">
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
            </div>
        </dd>
    </dl>
</div>
