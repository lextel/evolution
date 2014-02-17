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
                <?php echo Html::anchor('u/moneylog', '充值记录', ['class'=>'first-child active']); ?>
                <?php echo Html::anchor('u/moneylog/b/1', '消费记录', ['class'=>'last-child']); ?>
        </div>
        <div class="select-box">
            <label for=""><?php echo Html::anchor("u/moneylog/b/1", '全部');?></label>
            <span class="time-choose">选择时间段：
            <input  id="datepicker" type="text" placeholder="输入起始时间" />

            <input  id="datepicker1" type="text" placeholder="输入结束时间" />
            <button class="buylog-date-search">搜索</button>
        </span>
        </div>

       <?php if ($list): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>乐拍商品</th>
                <th>购买数量</th>
                <th>购买时间</th>
                <th>消费金额</th>
            </tr>
        </thead>
        <tbody>
        <?php $phaselist = $getPhaseInfo($list);?>
        <?php foreach ($list as $item): ?>
             <tr>
                <td style="text-align: left;"><?php echo '第('.$item->phase_id.')期 '.$phaselist[$item->phase_id]->title; ?></td>
                <td><?php echo $item->total.'人次'; ?></td>
                <td><?php echo Date::forge($item->created_at)->format("%Y-%m-%d %H:%M:%S"); ?></td>
                <td><?php echo $item->sum; ?>点积分</td>

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
