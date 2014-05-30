<?php echo Asset::css('member/jquery-ui.css'); ?>
<?php echo Asset::js(['jquery-ui.js', 'member/index.js']); ?>

<div class="content-inner">
    <!--晒单开始-->

    <div class="account-box">
        <div class="lead">账户明细</div>
        <div class="remind ">
            <span class="balance">余额：<s><?php echo $current_user->points;?>元</s></span>
            <?php echo Html::anchor('u/getrecharge', '充值', ['class'=>'btn-pay']);?>
        </div>
        <div class="toggles">
                <?php echo Html::anchor('u/moneylog', '充值记录', ['class'=>'first-child']); ?>
                <?php echo Html::anchor('u/moneylog/b/1', '消费记录', ['class'=>'last-child active']); ?>
        </div>
        <div class="select-box">
            <label for=""><?php echo Html::anchor("/u/moneylog", '全部');?></label>

        <span class="time-choose">选择时间段：
            <input  id="datepicker" type="text" placeholder="输入起始时间" />

            <input  id="datepicker1" type="text"  placeholder="输入结束时间" />
            <button class="rechargelog-date-search">搜索</button>
        </span>
    </div>
    <?php if ($list): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="30%">充值时间</th>
                <th width="20%">充值方式</th>
                <th width="25%">金额</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $item): ?>
             <tr>
                <td><?php echo Date::forge($item->created_at)->format("%Y-%m-%d %H:%M:%S"); ?></td>
                <td><?php echo $item->source; ?></td>
                <td>￥<?php echo sprintf('%.2f',$item->sum/Config::get('point')); ?>元</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <br />
    <?php echo Pagination::instance('ulogpage')->render(); ?>
    <?php else: ?>
    <p>没有日志</p>

    <?php endif; ?>
    <p>

    </p>
    </div>
</div>
