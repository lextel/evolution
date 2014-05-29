<?php echo Asset::css('member/jquery-ui.css'); ?>
<?php echo Asset::js(['jquery-ui.js', 'member/index.js']); ?>
<div class="content-inner">
        <!--乐淘记录开始-->
        <div class="lead">乐淘记录</div>
        <div class="record-box">
            <div class="remind ">乐淘提醒：
                <span>总共购买的商品（<s class="r"><?php echo $count; ?></s>）件</span>
            </div>
            <div class="select-box">
                <label for=""><?php echo Html::anchor('/u/orders', '全部商品', ['class'=>'b']);?></label>
            <span class="time-choose"><s>选择时间段：</s>
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
                        <th>商品图片</th>
                        <th>商品名称</th>
                        <th>购买数量</th>
                        <th>快递状态</th>                       
                        <th>快递信息</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($orders)) {
                      echo '<tr><td colspan="6" style="text-align:center">亲，您还没有购买过商品哦！</td></tr>';
                    }
                    ?>
                    <?php foreach($orders as $order) { ?>
                    <?php $phase = $getPhaseInfo($order->phase_id);?>
                    <tr>
                        <td>
                            <div class="img-box img-sm">
                                <a href="<?php echo Uri::create('m/'.$order->phase_id); ?>" rel="nofollow">
                                    <img src="<?php echo \Helper\Image::showImage($phase->image, '80x80');?>"/>
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="title-lg"><?php echo $phase->title;?></div>
                        </td>
                        <td><?php echo $order->code_count;?>件</td>
                        <td><?php echo ($phase->member_id !=0) ? "已经揭晓": "进行中";?></td>                       
                        <td><div class="toolbox">
                           <a class="tooltip" href="javascript:void(0)">快递</a>
                           <div class="num-list"  id="num-list">
                                <div class="icon-arrow"></div>
                                <ul>
                                     <?php
                                        $codes = \Helper\Codes::getArray($order->codes);
                                        foreach($codes as $code) {
                                            echo "<li>{$code}</li>";
                                        }
                                     ?>
                                 </ul>
                                 <button class="icon-close"></button>
                            </div>
                        </div>
                            </td>
                        <td><?php echo Html::anchor("/m/".$order->phase_id, "继续购物");?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php echo Pagination::instance('uorderpage')->render(); ?>
            </div>
        </div>
        <!--乐淘记录结束-->
    </div>
</div>
