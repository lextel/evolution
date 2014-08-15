<div class="panel panel-default" style="padding: 10px 0">
    <form class="navbar-form navbar-left" role="search" action="" method="get">
        <a class="btn btn-info"  id="create">添加游戏</a>
        <a class="btn btn-prime"  id="create" href="<?php echo Uri::create('v2admin/gift');?>">返回奖品列表</a>
    </form>
    <div class="clearfix"></div>
</div>

<div class="panel panel-default">
<?php if (isset($games) && is_array($games)): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th># ID</th>
            <th>游戏名</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($games as $index): ?>
          <tr>
            <td><?php echo $index->id; ?></td>
            <td><?php echo $index->name; ?></td>
            <td>
            <?php echo Html::anchor('v2admin/gift/delete/'.$index->id, '删除', array('onclick' => "return confirm('亲，确定删除么?')")); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p style='text-align:center; padding: 40px'>还没有游戏请添加.</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('mypagination')->render();?>
<script>
    $(function(){
        $('#create').click(function(){      
            window.location.href = '<?php echo Uri::create("v2admin/giftgame/create");?>';
        });
    });
</script>

