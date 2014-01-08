<h2>晒单审核列表</h2>
<script type="text/javascript">
$(function(){
   $(".postactive").change(function(){
       var val = $(this).val();
       var url = window.location.pathname;
       window.location.href = url + '?active='+ val;
   });
});
</script>
<?php echo Form::select('active', Input::param('active'),[
    '0' => '待审核晒单列表',
    '1' => '运行中晒单列表',
    '2' => '审核不通过晒单列表',
    '3' => '已删除晒单列表',
    ],
    ['class'=>'postactive', 'style'=>'height:34px']
);?>
<br>
<?php if ($posts): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>标题</th>
            <th>标题</th>
            <th>内容</th>
            <th>状态</th>
            <th>发布人</th>
            <th>商品名称</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($posts as $item){ ?>     <tr>
            <th><?php echo $item->id; ?></th>
            <td><?php echo mb_substr($item->title, 0, 16,'utf-8'); ?>...</td>
            <td><?php echo mb_substr($item->desc, 0, 16,'utf-8');?>...</td>
            <td><?php echo $getStatus($item); ?></td>
            <td><?php echo $getUser($item->member_id)->nickname; ?></td>
            <td>第<?php echo $getPhase($item)->phase_id; ?>期 <?php echo mb_substr($getPhase($item)->title, 0, 16,'utf-8'); ?>...</td>
            <td>
                <?php if (Input::param('active')=='0' or Input::param('active')==null ) { ?>
                <?php echo Html::anchor('admin/posts/view/'.$item->id, '审核'); ?>
                <?php }elseif(Input::param('active')=='1') { ?>
                <?php echo Html::anchor('p/'.$item->id, '浏览页面', ['target'=>'_blank']); ?>
                <?php }else{ ?>
                <?php }?>


            </td>
        </tr>
<?php } ?>    </tbody>
</table>
<?php echo Pagination::instance('postspage')->render(); ?>
<?php else: ?>
<p>该分类没数据.</p>

<?php endif; ?><p>
</p>
