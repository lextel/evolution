<div class="panel panel-default" style="padding: 10px 0">
    <form class="navbar-form navbar-left" role="search" action="" method="get">
        <a class="btn btn-primary" href="<?php echo Uri::create('v2admin/giftgame');?>">游戏列表</a>
        <a class="btn btn-primary" href="<?php echo Uri::create('v2admin/giftgame/create');?>" >添加新游戏</a>
        <a class="btn btn-info" id="create">添加奖品</a>
        </form>
    <div class="clearfix"></div>
</div>

<div class="panel panel-default">
<?php if (isset($codes) && is_array($codes)): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th># ID</th>
            <th width="25%">游戏名</th>
            <th width="25%">礼品码</th>
            <th width="10%">领奖者</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($codes as $code): ?>
          <tr>
            <td><?php echo $code->id; ?></td>
            <td><?php echo $getGameName($code->game_id); ?></td>
            <td><?php echo $code->code; ?></td>
            <td><?php echo $code->member_id;?></td>
            <td><?php echo $code->status == 1 ? '已使用' : '<span style="color:green">未使用</span>'; ?></td>
            <td>
            <?php echo Html::anchor('v2admin/gift/delete/'.$code->id, '删除', array('onclick' => "return confirm('亲，确定删除么?')")); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p style='text-align:center; padding: 40px'>还没有礼品码.</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('mypagination')->render();?>
<script>
    $(function(){
        $('#create').click(function(){
            window.location.href = '<?php echo Uri::create('v2admin/gift/create');?>';
        });

        $('#award').click(function() { return false; });
        $('#award').trigger("focus");
        $('#award').blur(function() {
            var award = $(this).val();
            //判断非负整数
            if (!(/^[0-9]{0,2}$/.test(award))){
                $(this).val(<?php echo Config::get('inviteCodeAddPoints');?>);
                return false;
            }
        });
    });
</script>

