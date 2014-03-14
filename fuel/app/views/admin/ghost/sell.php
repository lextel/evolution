<?php
    echo Asset::js(['admin/ghost/sell.js']);
?>
<div class="panel panel-default">
<?php if (isset($items)): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>图片</th>
            <th width="55%">标题</th>
            <th>已参加/总人次</th>
            <th>操作(ID为空时随机马甲乐拍)</th>
        </tr>
    </thead>
    <tbody>
        <?php Config::load('common'); ?>
        <?php foreach ($items as $item): ?>
          <tr>
            <td><img src="<?php echo Uri::create('image/80x80/' . $item->image); ?>" style="width: 40px; height: 40px"/></td>
            <td><a href="<?php echo Uri::create('m/'.$item->id); ?>" target="_blank"><?php echo '(第'.$item->phase_id.'期)'.$item->title; ?></a></td>
            <td><d id="join<?php echo $item->id;?>"><?php echo $item->joined, '</d>/', $item->amount; ?></td>
            <td>
                <input class="form-control orderNum<?php echo $item->id?>" placeholder="次数" style="width: 100px;float: left; margin-right: 15px">
                <input class="form-control orderMid<?php echo $item->id?>" placeholder="马甲ID" style="width: 120px; float:left;">
                <a class="btn btn-success pull-right ghostOrder" data-id="<?php echo $item->id?>" href="javascript:;">乐拍</a>
                <div class="clearfix"></div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
  OPERATE_URL = '<?php echo Uri::base() . 'admin/ghost/order'?>';
</script>
<?php else: ?>
<p style='text-align:center; padding: 40px'>还没有商品.</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('mypagination')->render();?>
