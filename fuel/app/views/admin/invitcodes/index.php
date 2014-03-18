<div class="panel panel-default" style="padding: 10px 0">
    <form class="navbar-form navbar-left" role="search" action="" method="get">
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">数量</span>
              <input type="text" class="form-control" value="" id="num" placeholder="邀请码生成数量">
            </div>
        </div>
        <a class="btn btn-primary" id="create">生成</a>
        </form>
    <div class="clearfix"></div>
</div>

<div class="panel panel-default">
<?php if (isset($codes) && is_array($codes)): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th># ID</th>
            <th width="45%">邀请码</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($codes as $code): ?>
          <tr>
            <td><?php echo $code->id; ?></td>
            <td><?php echo $code->code; ?></td>
            <td><?php echo $code->status == 1 ? '已使用' : '<span style="color:green">未使用</span>'; ?></td>
            <td>
            <?php echo Html::anchor('admin/invitcodes/delete/'.$code->id, '删除', array('onclick' => "return confirm('亲，确定删除么?')")); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p style='text-align:center; padding: 40px'>还没有邀请码.</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('mypagination')->render();?>
<script>
    $(function(){
        $('#create').click(function(){
            var num = $('#num').val();
            window.location.href = '<?php echo Uri::create('admin/invitcodes/create/')?>' + num
        });
    })
</script>

