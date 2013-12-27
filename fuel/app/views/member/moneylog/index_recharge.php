
<div class="content-inner">
    <!--晒单开始-->
    <?php echo Html::anchor('u/moneylog', '用户充值记录'); ?>|
    <?php echo Html::anchor('u/moneylog/b/1', '用户消费记录'); ?>
    <div class="account-box">
        <h4>帐户明细</h4>
        <div class="remind ">
            <span class="fl">你的帐户余额为：<b>￥<?php echo $current_user->points;?></b></span>
            <?php echo Html::anchor('u/recharge', '充值', ['class'=>'btn fl btn-sx']);?>
        </div>
        <div class="select-box">
            <label for="">全部商品</label>
        <span class="time-choose">选择时间段：
            <select name="" >
                <option value="">1</option>
                <option value="">2</option>
            </select>
            <select name="">
                <option value="">1</option>
                <option value="">2</option>
            </select>
            <button>搜索</button>
        </span>
    </div>
    <?php if ($list): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>编号</th>
                <th>充值时间</th>
                <th>充值方式</th>
                <th>金额</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $item): ?>
             <tr>
                <td>1</td>
                <td><?php echo Date::forge($item->created_at)->format("%Y-%m-%d %H:%M:%S"); ?></td>
                <td><?php echo $item->type; ?></td>
                <td>￥<?php echo round($item->sum, 2); ?></td>
                
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo Pagination::instance('ulogpage')->render(); ?>
    <?php else: ?>
    <p>没有日志</p>

    <?php endif; ?>
    <p>
        
    </p>
    </div>
</div>