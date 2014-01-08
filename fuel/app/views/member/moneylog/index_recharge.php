<?php echo Asset::css('member/jquery-ui.css'); ?>
<?php echo Asset::js(['jquery-ui.js', 'member/index.js']); ?>

<div class="content-inner">
    <!--晒单开始-->

    <div class="account-box">
        <div class="remind ">
            <span class="balance">帐户积分：<b><?php echo $current_user->points;?>点</b></span>
            <?php echo Html::anchor('u/getrecharge', '充值', ['class'=>'btn-pay']);?>
        </div>
        <div class="toggles">
                <?php echo Html::anchor('u/moneylog', '充值记录', ['class'=>'first-child']); ?>
                <?php echo Html::anchor('u/moneylog/b/1', '消费记录', ['class'=>'last-child active']); ?>
        </div>
        <div class="select-box">
            <label for="">全部商品</label>

        <span class="time-choose">选择时间段：
            <input  id="datepicker" type="text"/>

            <input  id="datepicker1" type="text"/>
            <button class="rechargelog-date-search">搜索</button>
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
                <td><?php echo $item->id?></td>
                <td><?php echo Date::forge($item->created_at)->format("%Y-%m-%d %H:%M:%S"); ?></td>
                <td><?php echo $item->source; ?></td>
                <td><?php echo round($item->sum, 2); ?></td>

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
