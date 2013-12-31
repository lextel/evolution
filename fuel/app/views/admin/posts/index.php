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
    ['class'=>'postactive']
);?>
<br>
<?php if ($posts): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>标题</th>
            <th>标题</th>
            <th>内容</th>
            <th>审核状态</th>
            <th>商品名</th>
            <th>发布人</th>
            <th>商品分类</th>
            <th>期数</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($posts as $item){ ?>     <tr>
            <th><?php echo $item->id; ?></th>
            <td><?php echo $item->title; ?></td>
            <td><?php echo mb_substr($item->desc, 0, 42,'utf-8');?></td>
            <td><?php echo $item->status; ?></td>
            <td><?php echo $item->item_id; ?></td>
            <td><?php echo $item->member_id; ?></td>
            <td><?php echo $item->type_id; ?></td>
            <td>第<?php echo $item->phase_id; ?>期</td>
            <td>
                <?php echo Html::anchor('admin/posts/view/'.$item->id, '审核'); ?> |
                <?php echo Html::anchor('javascript:;', '删除', array('onclick' => "return confirm('你确定需要删除吗?')")); ?>

            </td>
        </tr>
<?php } ?>    </tbody>
</table>
<?php echo Pagination::instance('postspage')->render(); ?>
<?php else: ?>
<p>该分类没数据.</p>

<?php endif; ?><p>
</p>
