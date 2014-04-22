<?php echo Asset::css(['style.css']); ?>
<?php echo Asset::css('member/jquery-ui.css'); ?>
<?php echo Asset::js(['jquery-ui.js', 'member/index.js']); ?>
<div class="history">
     <div class="bread">
            <ul>
                <li>首页</li>
                <li><em>&gt;</em></li>
                <li>历史记录</li>
            </ul>
     </div>
    <div class="title">
        <span class="icon-history"></span>  历史乐淘记录
    </div>
    <div class="history-content">
        <div class="select-box time-box">
            <ul class="time-choose">
                 <li>选择时间段：</li>
                 <li><input  id="datepicker" type="text" placeholder="输入起始时间"/></li>
                 <li><input  id="datepicker1" type="text" placeholder="输入结束时间" /></li>
                 <li><a class="btn btn-red btn-sx allorders-date-search" href="javascript:;">搜索</a></li>
            </ul>
        </div>
        <table>
            <thead>
                <tr>
                    <th>乐淘时间</th>
                    <th>会员帐号</th>
                    <th>商品名称</th>
                    <th>购买数量</th>
                </tr>
            </thead>
            <tbody>
                <?php if($orders) { ?>
                <?php $members = $getMembersByOrders($orders);?>
                <?php $phases = $getPhaseByOrders($orders);?>
                
                <?php foreach($orders as $item) { ?>
                <tr>
                    <td><?php echo Date('Y-m-d H:i:s', $item->created_at);?></td>
                    <td><?php echo Html::anchor('u/'.$item->member_id, $members[$item->member_id]->nickname);?></td>
                    <td><p class="tl"><?php echo Html::anchor('m/'.$item->phase_id,'（第'.$phases[$item->phase_id]->phase_id.'期) '.$item->title);?></p></td>
                    <td><?php echo $item->code_count;?>人次</td>
                </tr>
                <?php } ?>
                
                <?php }else { ?>
                <?php echo '<tr><td colspan="5" style="text-align:center">暂时无任何历史购买记录！</td></tr>'; ?>
                <?php } ?>
                
            </tbody>
        </table>
        <br />
        <?php echo Pagination::instance('orderpage')->render();?>
    </div>
</div>

