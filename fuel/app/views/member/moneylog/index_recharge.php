<?php echo Asset::css('member/jquery-ui.css'); ?>
<?php echo Asset::js('jquery-ui.js'); ?>
<script>
  $(function() {
    $( "#datepicker" ).datepicker({
      showWeek: true,
      firstDay: 1
    });

        $( "#datepicker1" ).datepicker({
      showWeek: true,
      firstDay: 1
    });
  });
  </script>


<div class="content-inner">
    <!--晒单开始-->
    
    <div class="account-box">
        <div class="remind ">
<<<<<<< HEAD
            <span class="fl">你的帐户余额为：<b>￥<?php echo $current_user->points;?></b></span>
            <?php echo Html::anchor('u/recharge', '充值', ['class'=>' fl btn-pay']);?>
=======
            <span class="balance">你的帐户余额为：<b>￥<?php echo $current_user->points;?></b></span>
            <?php echo Html::anchor('u/recharge', '充值', ['class'=>'btn-pay']);?>
        </div>
        <div class="toggles">
                <?php echo Html::anchor('u/moneylog', '充值记录', ['class'=>'first-child']); ?>
                <?php echo Html::anchor('u/moneylog/b/1', '消费记录', ['class'=>'last-child active']); ?>
>>>>>>> a645ca58c807d490767a8615c1e1199051514100
        </div>
        <div class="select-box">
            <label for="">全部商品</label>

        <span class="time-choose">选择时间段：
            <input  id="datepicker" type="text"/>

            <input  id="datepicker1" type="text"/>
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
    <br />
    <?php echo Pagination::instance('ulogpage')->render(); ?>
    <?php else: ?>
    <p>没有日志</p>

    <?php endif; ?>
    <p>
        
    </p>
    </div>
</div>
