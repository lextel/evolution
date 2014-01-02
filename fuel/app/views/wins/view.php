<?php echo Asset::css(['product.css', 'style.css', 'customBootstrap.css']);?>
<?php echo Asset::js(['bootstrap.min.js' ,'jquery.pin.js']);?>
    <?php 
        $itemInfo = $getItem($win->item_id);
        $memberInfo = $getUser($win->member_id);
    ?>
    <div class="panel w">

        <div class="title">
            <h2>
                <b>(第<?php echo $win->phase_id; ?>期)</b>
                <?php echo $win->title; ?>
            </h2>
        </div>
        <div class="img-side fl">
            <img src="<?php echo Uri::create('image/400x400/'.$itemInfo->image); ?>" alt="">
        </div>
        <div class="state-column fr">
            <div class="state-heading">
                <span class="fl">本商品已开出 <b class="blue"><?php echo $openCount($itemInfo->id); ?></b>期<?php $activePhase = $activePhase($itemInfo->id); if($activePhase):?>，第<b class="blue"><?php echo $activePhase->phase_id; ?></b>期正在进行中...</span>
                <a href="<?php echo Uri::create('m/'.$activePhase->id); ?>" class="details fr">查看详情</a>
                <?php endif;?>
            </div>
            <div class="price">价值:<b><?php echo sprintf('%.2f', $itemInfo->price );?></b></div>
            <div class="result-box">
                <div class="H fl">揭晓结果</div>
                <div class="right-box fl">
                    <h2><?php echo $win->code; ?></h2>
                    <div class="result-info">
                         <div class="img-box fl">
                              <a href="<?php echo Uri::create('u/'.$memberInfo->id); ?>"><img src="<?php echo Uri::create($memberInfo->avatar); ?>" alt=""></a>
                         </div>
                         <div class="info-side fl">
                              <div class="winner">获得者<a href="<?php echo Uri::create('u/'.$memberInfo->id); ?>"><b><?php echo $memberInfo->nickname; ?></b></a></div>
                              <span class="announce-time">揭晓时间：<b><?php echo $friendlyDate($win->opentime);?></b></span>
                              <span class="buy-time">乐拍时间：<b><?php echo $friendlyDate($win->order_created_at);?></b></span>
                              <span class="buy-number">乐购数量：<b class="red"><?php echo $win->code_count; ?></b>人次</span>
                         </div>
                        <div class="win-number">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bd w">
		<div class="sub-nav w" id="bigNav">
        <ul>
            <li><a href="#result" class="active" data-toggle="tab">计算结果</a></li>
            <li><a href="#buylog" phaseId="<?php echo $win->id; ?>"  data-toggle="tab">所有参与纪录(<b><?php echo $orderCount; ?></b>)</a></li>
            <li><a href="#posts" itemId="<?php echo $itemInfo->id; ?>" data-toggle="tab">晒单(<b><?php echo $postCount; ?></b>)</a></li>
            <li><a href="#phase" itemId="<?php echo $itemInfo->id; ?>" data-toggle="tab">往期回顾(<b><?php echo $phaseCount; ?></b>)</a></li>
        </ul>
        </div>
		<div class="content tab-content">
        <!--计算结果开始-->
        <div class="tab-pane active" id="result">
            <div class="calculation-box">
                <ol>
                    <li>1、取该商品最后购买时间前网站所有商品的最后100条购买时间记录</li>
                    <li>2、每个时间记录按时、分、秒、毫秒依次排列取数值 </li>
                    <li>3、将这100个数值之和除以该商品总参与人次后取余数，余数加上10000001 即为“幸运云购码”。</li>
                </ol>
                <div class="calculation-list">
                    <table>
                        <thead>
                        <tr>
                            <th>乐拍时间</th>
                            <th>会员帐号</th>
                            <th>购买数量</th>
                            <th>商品名称</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><s>2013-12-20</s>10:46:49.687</td>
                                <td><a href="">最后一次</a></td>
                                <td>1</td>
                                <td><a href="">（第633期）<b>苹果（Apple）iPhone 5S 16G版 3G手机</b> </a></td>
                            </tr>
                            <tr>
                                <td><s>2013-12-20</s>10:46:49.687</td>
                                <td><a href="">最后一次</a></td>
                                <td>1</td>
                                <td><a href="">（第633期）<b>苹果（Apple）iPhone 5S 16G版 3G手机</b> </a></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <h4>截止该商品最后购买时间【2013-12-20 10:46:36.578】最后100条全站购买时间记录</h4>
                                </td>
                            </tr>
                            <tr>
                                <td><s>2013-12-20</s>10:46:49.687</td>
                                <td><a href="">最后一次</a></td>
                                <td>1</td>
                                <td><a href="">（第633期）<b>苹果（Apple）iPhone 5S 16G版 3G手机</b> </a></td>
                            </tr>
                            <tr>
                                <td><s>2013-12-20</s>10:46:49.687</td>
                                <td><a href="">最后一次</a></td>
                                <td>1</td>
                                <td><a href="">（第633期）<b>苹果（Apple）iPhone 5S 16G版 3G手机</b> </a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="calculation-results">
                    <h3 class="fl">计算结果</h3>
                    <ul class="fl">
                        <li>求和：10445775630(上面100条云购记录时间取值相加之和)</li>
                        <li>取余：10445775630(100条时间记录之和) % 72(本商品总需参与人次) = 6(余数)</li>
                        <li>结果：6(余数) + 10000001 = 10000007</li>
                        <li><span>最终结果：<s>10000007</s></span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--揭计算结果结束-->
        <!--参与者记录开始-->
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
        <div  class="look-bak d-n tab-pane" id="phase"></div>

        <!--参与者记录结束-->
	</div>
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
