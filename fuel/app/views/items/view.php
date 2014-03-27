<?php echo Asset::css(['product.css', 'jquery.jqzoom.css', 'customBootstrap.css', 'style.css']); ?>
<?php echo Asset::js(['jquery.jqzoom-core.js', 'bootstrap.min.js','jquery.pin.js', 'item/view.js', 'Xslider.js']); ?>
 <div class="bread">
     <ul>
     <?php echo $getBread($item->phase);?>
     </ul>
</div>
<div class="periodList">
<?php 
$phasesList =$phases($item); 
if(is_array($phasesList)) {
    echo '<ul>';
    foreach($phasesList as $list) {
       echo '<li class="'.$list['class'].'"><a href="'.Uri::create('m/'.$list['id']).'">第'.$list['phase'].'期</a></li>';
    }
    echo '</ul>';
}
?>
    <!--a href="javascript:void(0)" class="btn-periods">展开<i></i></a-->
</div>
<?php $this->title = '(第' . $item->phase->phase_id .'期)' . $item->title; ?>
<div class="panel w">
        <div class="title">
            <h2>
                <b>(第<?php echo $item->phase->phase_id; ?>期)</b>
                <?php echo $item->title; ?>
            </h2>
        </div>
        <div class="img-wide fl">
            <!--商品图片切换开始-->
            <div class="lantern-slide">
                <div class="slide-img">
                    <a href="<?php echo \Helper\Image::showImage($item->image, '600x600');?>" class="jqzoom" rel="zoom">
                        <img src="<?php echo \Helper\Image::showImage($item->image, '400x400');?>"/>
                    </a>
                </div>
                <ul class="slide-list" id="thumblist">
                    <?php
                        $images = unserialize($item->images);
                        foreach($images as $image):
                    ?>
                    <li>
                        <a class="<?php echo $image == $item->image ? 'zoomThumbActive' : ''; ?>" rel='<?php echo str_replace('\/', '/', $getZoom($image));?>'>
                            <img src="<?php echo \Helper\Image::showImage($image, '80x80');?>"/>
                            <span></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!--商品图片切换结束-->
            <?php
                if($prevWinner):
                $winner = $getMember($prevWinner->member_id);
            ?>
            <!--获奖者开始-->
            <div class="previous-box">
                <div class="title"><h3>上期获奖者</h3></div>
                <div class="head-img fl">
                    <a href="<?php Uri::create('u/'.$winner->id); ?>">
                        <img src="<?php echo \Helper\Image::showImage($winner->avatar, '60x60');?>"/>
                    </a>
                </div>
                <div class="info-side fl">
                    <div class="username">获得者：<a href="<?php Uri::create('u/'.$winner->id); ?>"><b><?php echo $winner->nickname; ?></b></a></div>
                    <span class="datetime">揭晓时间：<b><?php echo date('Y-m-d H:i:s', $prevWinner->opentime); ?></b></span>
                    <span class="datetime">乐淘时间：<b><?php echo date('Y-m-d H:i:s', $prevWinner->order_created_at); ?></b></span>
                    <span class="number">幸运码：<b class="red"><?php echo $prevWinner->code; ?></b></span>
                </div>
            </div>
            <!--获奖者结束-->
            <?php endif; ?>
        </div>
        <?php
            Config::load('common');
            $unit = Config::get('unit');
        ?>
        <div class="product-column fr">
            <div class="state-heading">
                <span class="icon icon-horn"></span>
                <span>本商品已有 <b class="blue"><?php echo $postsCount($item->id); ?></b>位幸运者晒单，<b class="blue"><?php echo $commentCount($item->id); ?></b>评论</span>
            </div>
            <div class="middle">
              <div class="price" style="margin-left: 57px"><strong>价值:￥<?php echo sprintf('%.2f', $item->price); ?></strong></div>
            <?php if(!empty($item->phase->remain) && $item->status == \Helper\Item::IS_CHECK): ?>
              <dl class="progress-side">
                  <dd>
                      <div class="progress"><div class="progress-bar" style="width: <?php echo sprintf('%.2f', $item->phase->joined/$item->phase->amount*100); ?>%"></div></div>
                  </dd>
                  <dd>
                      <span class="fl r"><?php echo $item->phase->joined; ?></span>
                      <span class="fr b"><?php echo $item->phase->remain; ?></span>
                  </dd>
                  <dd>
                      <span class="fl">已攒元宝</span>
                      <span class="fr">还需元宝</span>
                  </dd>
              </dl>
              <form action="<?php echo Uri::create('/cart/add'); ?>" method="post">
                  <div class="btn-menu" style="margin-left: 57px; margin-top: 7px">
                      <span class="left" style="height: 30px; font-size: 14px;line-height: 30px">购买数量：</span>
                      <a class="add btn-jian" href="javascript:void(0);" style="height: 30px;line-height: 30px;width:30px">-</a>
                      <input style="margin: 0;border: 1px solid #e5e5e5;font-size: 14px;height:28px" type="text" value="1" name="qty" amount="<?php echo $item->phase->amount; ?>" remain="<?php echo $item->phase->remain; ?>">
                      <a class="add btn-jia" style="height: 30px; font-size: 14px; line-height: 30px" href="javascript:void(0);">+</a>
                      <span class="right" style="line-height: 30px">(还需<?php echo $item->phase->remain; ?>元宝)</span>
                      <span class="chance fl" style="line-height: 30px">获得几率：<s class="red" id="percent"><?php echo sprintf('%.2f', 1/$item->phase->amount*100); ?>%</s> </span>
                  </div>
                  <div class="btn-group" style="margin-left: 57px">
                      <input type="hidden" value="<?php echo $item->phase->id ?>" name="id"/>
                      <button type="submit" class="btn btn-red btn-w" style="margin: 8px 0; height: 40px; line-height: 40px; width: 158px;font-size: 18px">立即一元乐淘</button>
                      <a class="btn btn-y btn-w doAddCart" style="margin-left: 28px; height: 40px; line-height: 40px; width: 158px;font-size: 18px" href="javascript:void(0);" phaseId="<?php echo $item->phase->id; ?>">加入购物车</a>
                  </div>
              </form>
              <?php elseif($item->status == \Helper\Item::IS_CHECK): ?>
              <!--已卖完-->
              <div class="sell-out" style="display:block">
                   <h2>啊哦！！ 被抢光啦！！ </h2>
              </div>
               <!--已卖完结束-->
               <?php else:?>
              <div class="sell-out" style="display:block">
                   <h2>即将开拍</h2>
              </div>
               <?php endif; ?>
              <ul class="security-list" style="width: 83%">
                  <li><a href="<?php echo Uri::create('/h/safeguard'); ?>" class="01">100%公平公正</a></li>
                  <li><a href="<?php echo Uri::create('/h/promise'); ?>" class="02">100%正品保证</a></li>
                  <li><a href="<?php echo Uri::create('/h/expressinfo'); ?>" class="03">全国免费配送</a></li>
              </ul>
            </div>
            <div class="new-buyer">
                <div class="new-buyer-header">
                    <ul class="tab">
                        <li class="active"><a href="#buy" data-toggle="tab">最新乐淘记录</a></li>
                        <li><a href="#myBuy" data-toggle="tab">我的乐淘记录</a></li>
                        <li class="last"><a href="#help" data-toggle="tab">如何乐淘</a></li>
                    </ul>
                 </div>
                <div class="new-buyer-body tab-content">
                    <div class="tab-pane active" id='buy'>
                        <table>
                            <tbody>
                                <?php
                                    if($newOrders):
                                        foreach($newOrders as $newOrder):
                                        $member = $getMember($newOrder->member_id);
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="head-sm">
                                                <a href="<?php echo Uri::create('u/'.$member->id); ?>">
                                                    <img src="<?php echo \Helper\Image::showImage($member->avatar, '60x60');?>"/>
                                                </a>
                                            </div>
                                         </td>
                                        <td><?php echo $member->nickname; ?></td>
                                        <td><!--s>(广东深圳市)</s--><b><?php echo $friendlyDate($newOrder->created_at); ?></b></td>
                                        <td>乐淘了<s><?php echo $newOrder->code_count; ?></s>元宝</td>
                                    </tr>
                                <?php
                                        endforeach;
                                    else:
                                    echo '<tr><td>暂时没有乐淘记录.</td></tr>';
                                    endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="myBuy">
                        <table>
                            <tbody>
                                <?php
                                    if(!is_null($current_user)) :
                                    if($myOrders):
                                        foreach($myOrders as $myOrder):
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="head-sm">
                                                <a href="<?php echo Uri::create('u/'.$current_user->id); ?>">
                                                    <img src="<?php echo \Helper\Image::showImage($current_user->avatar, '60x60');?>"/>
                                                </a>
                                            </div>
                                        </td>
                                        <td><?php echo $current_user->nickname; ?></td>
                                        <td><!--s>(广东深圳市)</s--><b><?php echo $friendlyDate($myOrder->created_at); ?></b></td>
                                        <td>乐淘了<s><?php echo $myOrder->code_count; ?></s>元宝</td>
                                    </tr>
                                <?php
                                        endforeach;
                                    else:
                                    echo '<tr><td>暂时没有乐淘记录.</td></tr>';
                                    endif;
                                    else:
                                ?>

                            
                         <form action="<?php echo Uri::create('signin'); ?>" method="post">
                               <dl class="inner-login" style="display: block;">
                                    <dt>请先登录</dt>
                                    <dd>
                                          <input type="text"  placeholder="请输入注册邮箱" class="text" name="username">
                                    </dd>
                                    <dd>
                                          <input type="password"   placeholder="请输入密码" class="password" name="password">
                                    </dd>
                                    <dd class="last">
                                          <button type="submit" class="btn-rg btn-red">登录</button>
                                          <a class="btn-rg btn-gr" href="">注册</a>
                                    </dd>
                               </dl>
                         </form>
                         <?php endif; ?>
                         </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="help">
                        <p>乐乐淘是指只需1元宝就有机会买到想要的商品。即每件商品被平分成若干“等份”出售，每份1元宝，
                         当一件商品所有“等份”售出后，根据云购规则产生一名幸运者，该幸运者即可获得此商品。
                        </p>
                        <p>
                            乐乐淘以“快乐云淘，惊喜无限”为宗旨，力求打造一个100%公平公正、100%正品保障、寄娱乐与购物一体化的新型购物网站。
                        </p>
                        <div class="tr"><a href="<?php echo Uri::create('h/new'); ?>" class="link">更多详情></a></div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="wrapper w">
    <!--商品信息开始-->
	<div class="bd w">
	    <div class="sub-nav" id="bigNav">
            <ul class="fl">
                <li><a href="#desc" data-toggle="tab" class="active">商品详情</a></li>
                <li><a href="#buylog" phaseId="<?php echo $item->phase->id; ?>" data-toggle="tab">所有参与纪录(<s class="r"><?php echo $orderCount; ?></s>)</a></li>
                <li><a href="#posts" itemId="<?php echo $item->id; ?>" data-toggle="tab">晒单(<s class="r"><?php echo $postCount; ?></s>)</a></li>
                <li><a href="#phase" itemId="<?php echo $item->id; ?>" data-toggle="tab">往期回顾(<s class="r"><?php echo $phaseCount; ?></s>)</a></li>
            </ul>
            <div class="online-qq fr"><span class="icon icon-qq"></span><a class="chance" href="javaxcript:void(0)">在线客服</a></div>
        </div>
        <div class="tab-content">
            <!--商品详情开始-->
            <div class="product-details tab-pane active" id="desc">
                <?php echo $item->desc; ?>
            </div>
            <!--商品详情结束-->
            <!--参与记录开始-->
            <div class="record d-n tab-pane" id="buylog">
                <p style="margin-bottom: 15px;text-align: center">暂无参与记录</p>
            </div>
            <!--参与记录结束-->
            <!--晒单开始-->
            <div class="product-bask tab-pane" id="posts">
                <p style="margin-bottom: 15px;text-align: center">暂无晒单记录</p>
            </div>
            <!--晒单结束-->
            <!--往期回顾开始-->
            <div class="look-bak d-n tab-pane" id="phase"></div>
        </div>
	</div>
</div>
<!--今日热门开始-->
<div class="date-hot w">
    <div class="title"><h3>今日热门</h3></div>
    <div class="scrollleft" >
         <div class="scrollcontainer">
             <ul>
                 <?php $hotItems = $getHots();
                        if(isset($hotItems)) {
                        foreach($hotItems as $item) { ?>
                      <li>
                          <div class="img-box img-md">
                            <a href="<?php echo Uri::create('/m/'.$item->id); ?>" rel="nofollow">
                                <img src="<?php echo \Helper\Image::showImage($item->image, '200x200');?>"/>
                             </a>
                             <div class="price fr">价值<b>￥<?php echo sprintf('%.2f', $item->cost / Config::get('point')); ?></b></div>
                          </div>
                          <h4 class="caption"><?php echo $item->title; ?></h4>
                          <div class="btn-group">
                                <form action="<?php echo Uri::create('cart/add'); ?>" method="post">
                                    <input name="id" value="<?php echo $item->id; ?>" type="hidden">
                                    <input name="qty" value="1" type="hidden">
                                    <button class="btn btn-red hot-buy" type="submit">立即一元乐淘</button>
                                </form>
                          </div>
                      </li>
                      <?php }} ?>
                 </ul>
            </div>
            <a class="abtn aleft" href="#left"></a>
            <a class="abtn aright" href="#right"></a>
        </div>
    </div>
    <!--今日热门结束-->
</div>
<script>
    BUYLOG_URL   = '<?php echo Uri::create('l/joined'); ?>';
    POSTLOG_URL  = '<?php echo Uri::create('l/posts'); ?>';
    PHASELOG_URL = '<?php echo Uri::create('l/phases'); ?>';
</script>
<script>
    $(".sub-nav").pin({
        containerSelector: ".bd"
    })
</script>

