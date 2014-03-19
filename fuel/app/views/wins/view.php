<?php echo Asset::css(['product.css', 'style.css', 'customBootstrap.css','common.css']);?>
<?php echo Asset::js(['bootstrap.min.js' ,'jquery.pin.js']);?>
    <?php 
        $itemInfo = $getItem($win->item_id);
        $memberInfo = $getUser($win->member_id);
    ?>
    <div class="panel">
        <div class="title">
            <h2>
                <b>(第<?php echo $win->phase_id; ?>期)</b>
                <?php echo $win->title; ?>
            </h2>
        </div>
        <div class="results-img fl">
            <img src="<?php echo Uri::create('image/400x400/'.$itemInfo->image); ?>" alt="">
        </div>
        <div class="state-column fr">
            <div class="state-heading">
                <span class="fl"><span class="icon icon-horn"></span>本商品已开出 <b class="blue"><?php echo $openCount($itemInfo->id); ?></b>期<?php $activePhase = $activePhase($itemInfo->id); if($activePhase):?>，第<b class="blue"><?php echo $activePhase->phase_id; ?></b>期正在进行中...</span>
                <a href="<?php echo Uri::create('m/'.$activePhase->id); ?>" class="details fr">查看详情</a>
                <?php endif;?>
            </div>
            <div class="worth">价值:￥<?php echo sprintf('%.2f', $itemInfo->price );?></div>
            <div class="result-box">
                <div class="H fl">揭晓结果</div>
                <div class="right-box fl">
                    <h2><?php echo $win->code; ?></h2>
                    <div class="result-info">
                         <div class="row">
                         <div class="head-img fl">
                              <a href="<?php echo Uri::create('u/'.$memberInfo->id); ?>"><img src="<?php echo Uri::create($memberInfo->avatar); ?>" alt=""></a>
                         </div>
                         <div class="info-side fl">
                              <div class="username">获得者：<a href="<?php echo Uri::create('u/'.$memberInfo->id); ?>"><b><?php echo $memberInfo->nickname; ?></b></a></div>
                              <span class="datetime">揭晓时间：<b><?php echo $friendlyDate($win->opentime);?></b></span>
                              <span class="datetime">乐拍时间：<b><?php echo $friendlyDate($win->order_created_at);?></b></span>
                              <span class="number">乐购数量：<b class="red"><?php echo $win->code_count; ?></b>元宝</span>
                         </div>
                         </div>
                        <div class="win-number">
                            <div class="left"><?php echo date('Y-m-d', $win->order_created_at); ?><br><?php echo date('H:i:s', $win->order_created_at); ?></div>
                                    <dl>
                                    	<?php
                                    		foreach($orderCodes as $code) {
                                    			if($win->code == $code) 
                                    				echo '<dd style="color:red; font-weight: bold">'.$code.'</dd>';
                                    			else
                                    				echo '<dd>'.$code.'</dd>';
                                    		}
                                    	?>
                                    </dl>
                            </div>
                    </div>
                    <span class="icon-01"></span>
                    <span class="icon-02"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="bd w">
		<div class="sub-nav w" id="bigNav">
        <ul>
            <li><a href="#result" class="active" data-toggle="tab">计算结果</a></li>
            <li><a href="#buylog" phaseId="<?php echo $win->id; ?>"  data-toggle="tab">所有参与纪录(<s class="r"><?php echo $orderCount; ?></s>)</a></li>
            <li><a href="#posts" itemId="<?php echo $itemInfo->id; ?>" data-toggle="tab">晒单(<s class="r"><?php echo $postCount; ?></s>)</a></li>
            <li><a href="#phase" itemId="<?php echo $itemInfo->id; ?>" data-toggle="tab">往期回顾(<s class="r"><?php echo $phaseCount; ?></s>)</a></li>
        </ul>
        </div>
		<div class="tab-content">
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
                            <th>元宝数量</th>
                            <th>商品名称</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $results = unserialize($win->results);
                                if(!empty($results) && is_array($results)):
                                $memberIds = [];
                                $phaseIds  = [];
                                foreach($results as $result) {
                                    $memberIds[] = $result['member_id'];
                                    $phaseIds[]  = $result['phase_id'];
                                }
                                $members = $getMembers($memberIds);
                                $phases = $getPhases($phaseIds);

                                foreach($results as $result):
                                    $times = explode('.', $result['ordered_at']);
                            ?>
                            <tr>
                                <td><s><?php echo date('Y-m-d', $times[0]);?></s><?php echo date('H:i:s', $times[0]); ?>.<?php echo $times[1]; ?></td>
                                <td><a href="<?php echo Uri::create('u/'.$result['member_id']); ?>" class="username"><?php echo $members[$result['member_id']]->nickname;?></a></td>
                                <td><?php echo $result['count']; ?></td>
                                <td>
                                    <div class="inner-title">
                                        <a href="<?php echo Uri::create('m/'.$result['phase_id']); ?>">（第<?php echo $phases[$result['phase_id']]->phase_id; ?>期）<s><?php echo $phases[$result['phase_id']]->title; ?></s></a>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="calculation-results">
                    <h3 class="fl">计算结果</h3>
                    <ul class="fl">
                        <li>求和：<?php echo $win->total; ?>(上面<?php echo count($results); ?>条云购记录时间取值相加之和)</li>
                        <li>取余：<?php echo $win->total; ?>(<?php echo count($results); ?>条时间记录之和) % <?php echo $win->amount; ?>(本商品总需参与人次) = <?php echo $win->total%$win->amount; ?>(余数)</li>
                        <li>结果：<?php echo $win->total%$win->amount; ?>(余数) + 10000001 = <?php echo $win->code; ?></li>
                        <li><span>最终结果：<s><?php echo $win->code; ?></s></span></li>
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
        <!--往期回顾结束-->
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
