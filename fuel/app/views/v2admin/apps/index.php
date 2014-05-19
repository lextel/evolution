<script type="text/javascript">
$(function(){
   $(".appactive").change(function(){
       var val = $(this).val();
       var url = window.location.pathname;
       window.location.href = url + '?active='+ val;
   });
});
</script>
<div class="panel panel-default" style="padding: 10px 0">
    <div class="col-sm-3">
        <div class="input-group">
            <span class="input-group-addon">选择类型</span>
            <?php echo Form::select('active', Input::param('active', '0'),[
                '0' => '未发布',
                '1' => '已发布',
                '2' => '已删除',
                ],
                ['class'=>'form-control appactive']
            );?>
        </div>
    </div>
    <form class="navbar-form navbar-right" role="search" action="" method="get">
        <?php echo Html::anchor('v2admin/apps/create', '添加新APP', array('class' => 'btn btn-success pull-right')); ?>
    </form>
    <div class="clearfix"></div>
</div>
<div class="panel panel-default">
<?php if ($apps): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#ID</th>
            <th class="text-center">ICON</th>
            <th class="text-center">包名</th>
            <th class="text-center">名称</th>
            <th class="text-center">奖励</th>
            <th class="text-center">大小</th>
            <th class="text-center">操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($apps as $item): ?>
        <tr>

            <td><?php echo $item->id; ?></td>
            <td class="text-center"><?php echo Html::img($item->icon, ['style'=>'width:30px;height: 30px;']); ?></td>
            <td class="text-center"><?php echo $item->package;?></td>
            <td class="text-center"><?php echo $item->title; ?></td>
            <td class="text-center"><?php echo $item->award; ?><img src="/assets/img/yinbi.png" /></td>
            <td class="text-center"><?php echo $item->size; ?></td>
            <td class="text-center">
                <?php if ( $item->status == 0 ) { ?>
                    <?php echo Html::anchor('v2admin/apps/publish/'.$item->id, '发布', ['class'=>'btn btn-primary btn-xs', 'onclick' => "return confirm('亲，您确定要发布#".$item->id."吗?')",]); ?> |
                <?php } ?>
                <?php echo Html::anchor('v2admin/apps/edit/'.$item->id, '编辑', ['class'=>'btn btn-success btn-xs']); ?> |
                <?php echo Html::anchor('v2admin/apps/delete/'.$item->id, '删除', ['onclick' => "return confirm('亲，您确定要删除#".$item->id."么?')", ]); ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
</table>
<?php else: ?>
<p style="padding: 40px; text-align: center">没有任何APP。</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('appspage')->render();?>
