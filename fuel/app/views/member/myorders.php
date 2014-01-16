<?php echo Asset::css('member/jquery-ui.css'); ?>
<?php echo Asset::js(['jquery-ui.js', 'member/index.js']); ?>
<div class="content-inner">
        <!--乐拍记录开始-->
        <div class="record-box">
            <div class="remind ">乐拍提醒：
                <?php $ordercount = $countOrder($myorders);?>
                <span>即将揭晓商品（<b><?php echo $ordercount['winstart']; ?></b>）件</span>
                <span>进行中的商品（<b><?php echo $ordercount['buy']; ?></b>)件</span>
                <span>揭晓的商品（<b><?php echo $ordercount['winok']; ?></b>）件</span>
            </div>
            <div class="select-box">
                <label for="">全部商品</label>
            <span class="time-choose">选择时间段：
                 <input  id="datepicker" type="text" placeholder="输入起始时间"/>

                 <input  id="datepicker1" type="text" placeholder="输入结束时间" />
                 <button class="order-date-search">搜索</button>
            </span>
            </div>
            <div class="select">
                <label for="" class="select-title">商品名称</label>
                <input type="text" value="" id="word" placeholder="输入商品名字关键字" />
                <button class="order-word-search">搜索</button>
            </div>
            <div class="record">
                <table>
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>商品图片</th>
                        <th>商品名称</th>
                        <th>乐拍状态</th>
                        <th>购买数量</th>
                        <th>乐拍码</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($orders)) {
                      echo '<tr><td colspan="5" style="text-align:center">亲，您还没有购买过商品哦！</td></tr>';
                    }
                    ?>
                    <?php foreach($orders as $order) { ?>
                    
                    <tr>
                        <td><?php echo $order->id; ?></td>
                        <td><div class="img-box img-sm"><?php echo Html::anchor('/m/'.$order->phase_id, Html::img($getItemInfo($getPhaseInfo($order->phase_id)->item_id)->image));?></div></td>
                        <td>
                            <div class="title-lg">（第<?php echo $getPhaseInfo($order->phase_id)->phase_id;?>期）<?php echo $getPhaseInfo($order->phase_id)->title;?></div>
                            <?php if ($getPhaseInfo($order->phase_id)->member_id !=0) {?>
                            <div class="username">获得者：<?php echo $getUser($getPhaseInfo($order->phase_id)->member_id)->nickname;?></div>
                            <div class="number">幸运乐拍码：<?php echo $getPhaseInfo($order->phase_id)->code;?></div>
                            <div class="datetime">揭晓时间：<?php echo Date("Y-m-d H:i:s", $getPhaseInfo($order->phase_id)->opentime);?></div>
                            <?php }else{ ?>
                            
                            <?php } ?>
                        </td>
                        <td><?php echo ($getPhaseInfo($order->phase_id)->member_id !=0) ? "已经揭晓": "进行中";?></td>
                        <td><?php echo $order->code_count;?>人次</td>
                        <td><a href="">查看</a></td>
                        <td><?php echo Html::anchor("/m/".$order->phase_id, "查看详情");?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php echo Pagination::instance('uorderpage')->render(); ?>
            </div>
        </div>
        <!--乐拍记录结束-->
    </div>
</div>
