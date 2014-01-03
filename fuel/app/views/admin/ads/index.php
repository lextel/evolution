<?php if($breadcrumb): ?>
<ol class="breadcrumb">
    <?php echo $breadcrumb; ?>
</ol>
<?php endif; ?>
<ul class="nav nav-tabs">
  <li class="active"><a href="#index" data-toggle="tab">首页幻灯片</a></li>
  <li><a href="#items" data-toggle="tab">所有商品页</a></li>
</ul>
<div class="tab-content">
    <div id="index" class="tab-pane active">
        <?php if ($indexAds): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名称</th>
                    <th>图片</th>
                    <th>排序</th>
                    <th>状态</th>
                    <th>有效时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
        	<?php foreach ($indexAds as $item): ?>
                <tr>
                    <td><?php echo $item->title; ?></td>
                    
                    <td><a href="<?php echo $item->link; ?>" target="_blank"><img style="width:196px; height:70px" src="<?php echo Uri::create($item->image); ?>"/></a></td>
                    <td><?php echo $item->sort; ?></td>
                    <td><?php echo $item->status == 1 ? '启用' : '不启用';?></td>
                    <td><?php echo date('Y-m-d', $item->start_at);?>/<?php echo date('Y-m-d', $item->end_at);?></td>
                    <td>
                        <?php echo Html::anchor('admin/ads/edit/'.$item->id, '编辑'); ?> |
                        <?php echo Html::anchor('admin/ads/delete/'.$item->id, '删除', array('onclick' => "return confirm('亲，你真的要删除?')")); ?>

                    </td>
                </tr>
        	<?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p style="text-align: center; margin: 10px">没有广告</p>
        <?php endif; ?>
    </div>
    <div id="items" class="tab-pane">
        <?php if ($itemAds): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名称</th>
                    <th>图片</th>
                    <th>排序</th>
                    <th>状态</th>
                    <th>有效时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
        	<?php foreach ($itemAds as $item): ?>
                <tr>
                    <td><?php echo $item->title; ?></td>
                    <td><a href="<?php echo $item->link; ?>" target="_blank"><img style="width:196px; height:70px" src="<?php echo Uri::create($item->image); ?>"/></a></td>
                    <td><?php echo $item->sort; ?></td>
                    <td><?php echo $item->status == 1 ? '启用' : '不启用';?></td>
                    <td><?php echo date('Y-m-d', $item->start_at);?>/<?php echo date('Y-m-d', $item->end_at);?></td>
                    <td>
                        <?php echo Html::anchor('admin/ads/edit/'.$item->id, '编辑'); ?> |
                        <?php echo Html::anchor('admin/ads/delete/'.$item->id, '删除', array('onclick' => "return confirm('亲，你真的要删除?')")); ?>

                    </td>
                </tr>
        	<?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p style="text-align: center; margin: 10px">没有广告</p>
        <?php endif; ?>
    </div>
</div>

