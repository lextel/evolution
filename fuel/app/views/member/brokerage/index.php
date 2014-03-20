<div class="content-inner" style="min-height: 565px;">
    <!--邀请开始-->
    <div class="lead">佣金明细</div>
    <div class="show-box">
        <div class="show-c">
            <table>
                <thead>
                <tr>
                    <th width="25%">会员</th>
                    <th width="25%">类型</th>
                    <th width="25%">佣金</th>
                    <th>时间</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!isset($brokerages) || empty($brokerages)) {
                        echo '<tr><td colspan="4" style="text-align:center">亲，还没有您的邀请好友哦！</td></tr>';
                } else {?>
                <?php foreach($brokerages as $brokerage) { ?>
                <tr>
                    <td>
                        <div><a target="_blank" class="b" href="<?php echo Uri::create('u/'.$brokerage->target_id); ?>" ><?php echo $members[$brokerage->target_id]->nickname;?></a></div>
                    </td>
                    <td><?php echo $brokerage->type_id == 1 ? '注册' : '消费'; ?></td>
                    <td><?php echo \Helper\Coins::showCoins($brokerage->points); ?></td>
                    <td><div><?php echo date('Y-m-d H:i:s', $members[$brokerage->target_id]->created_at);?></div></td>
                </tr>
               <?php };?>
               <?php };?>
                </tbody>
            </table>
            <?php echo Pagination::instance('page')->render(); ?>
        </div>
    </div>
    <!--获晒单结束-->
</div>
