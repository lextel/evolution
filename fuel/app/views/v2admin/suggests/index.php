<script type="text/javascript">
$(function(){
   $(".postactive").change(function(){
       var val = $(this).val();
       var url = window.location.pathname;
       window.location.href = url + '?active='+ val;
   });
});
</script>
            <div class="input-group">
              <span class="input-group-addon">选择分类</span>
<?php echo Form::select('active', Input::param('active'),[
    '0' => '所有',
    '1' => '投诉建议',
    '2' => '商品配送',
    '3' => '售后服务',
    ],
    ['class'=>'form-control postactive', 'style'=>'height:34px; width: 200px']
);?>
</div>

<br>
<?php if ($suggests): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th width="5%">#ID</th>
            <th width="5%">类型</th>
            <th width="40%">内容</th>
            <th width="10%">提交人</th>
            <th width="10%">操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($suggests as $item){ ?>
         <tr>
            <th><?php echo $item->id; ?></th>
            <td>
                <?php echo $item->type;?>
            </td>
            <td><?php echo $item->title; ?><br /><?php echo $item->text;?></td>
            <td><?php echo $item->nickname; ?><br /><?php echo $item->email;?></td>
            <td>
                <?php if (Input::param('active')=='0' or Input::param('active')==null ) { ?>
                <?php echo Html::anchor('v2admin/posts/view/'.$item->id, '审核'); ?>
                <?php }elseif(Input::param('active')=='1') { ?>
                <?php echo Html::anchor('p/'.$item->id, '详情', ['target'=>'_blank']); ?>
                <?php }else{ ?>
                <?php }?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php echo Pagination::instance('suggestpage')->render(); ?>
<?php else: ?>
<p>该分类没晒单.</p>
<?php endif; ?><p>
</p>
