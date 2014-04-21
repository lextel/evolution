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
    '0' => '待审核晒单',
    '1' => '已审核晒单',
    '2' => '驳回的晒单',
    '3' => '已删除晒单',
    ],
    ['class'=>'form-control postactive', 'style'=>'height:34px; width: 200px']
);?>
</div>

<br>
<?php if ($posts): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th width="5%">#ID</th>
            <th>标题</th>
            <th width="10%">审核</th>
            <th width="10%">发布会员</th>
            <th width="10%">操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $item){ ?>
         <tr>
            <th><?php echo $item->id; ?></th>
            <td>
                <?php echo $item->title;?><br/>
                <a href="<?php echo Uri::create('w/'.$item->phase_id);?>" target='_blank'>(第<?php echo $getPhase($item)->phase_id; ?>期) <?php echo $getPhase($item)->title; ?></a>
            </td>
            <td><?php echo $getStatus($item); ?></td>
            <td><?php echo $getUser($item->member_id)->nickname; ?></td>
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
<?php echo Pagination::instance('postspage')->render(); ?>
<?php else: ?>
<p>该分类没晒单.</p>
<?php endif; ?><p>
</p>
