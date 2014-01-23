<?php echo Asset::css(['style.css']); ?>
<?php echo Asset::css('member/validfrom_style.css'); ?>
<?php echo Asset::js('Validform_v5.3.2_min.js'); ?>
<?php echo Asset::css('member/jquery-ui.css'); ?>
<?php echo Asset::js(['jquery-ui.js', 'member/index.js']); ?>
<div class="history">
    <div class="title">
        <span class="icon-history"></span>  历史乐拍记录
    </div>
    <div class="history-content">
        <div class="select-box time-box">
            <span class="time-choose">选择时间段：
                 <input  id="datepicker" type="text" placeholder="输入起始时间"/>
                 <input  id="datepicker1" type="text" placeholder="输入结束时间" />
                 <a class="btn btn-red btn-sx allorders-date-search" href="javascript:;">搜索</a>
            </span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>乐拍时间</th>
                    <th>会员帐号</th>
                    <th>商品名称</th>
                    <th>购买数量</th>
                </tr>
            </thead>
            <tbody>
                <?php if($orders) { ?>
                <?php foreach($orders as $item) { ?>
                <tr>
                    <td><?php echo Date('Y-m-d H:i:s', $item->created_at);?></td>
                    <td><?php echo $item->member_id;?></td>
                    <td><?php echo $item->phase_id;?> </td>
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

