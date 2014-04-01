<?php echo Asset::css('notice.css'); ?>
<div class="bread">
 <ul>
    <li><a href="<?php echo Uri::create('/'); ?>">首页</a></li>
    <li><em>&gt;</em></li>
    <li><a href="<?php echo Uri::create('notice'); ?>">公告列表</a></li>
 </ul>
</div>
<dl class="announcement" style="margin-bottom: 10px">
    <dt>乐淘公告</dt>
    <?php if ($notices) { ?>
    <?php foreach ($notices as $item) { ?>	
    <dd>
        <div class="a-title"><?php echo $item->is_top ? '<span class="is_top">置顶</span>' : '';?><a href="<?php echo Uri::create('notice/'.$item->id); ?>" class="<?php echo $item->is_top ? 'r' : '';?>"><?php echo $item->title; ?></a></div>
        <div class="datetime"><span>乐乐淘</span>发布于：<?php echo Date('Y-m-d H:i', $item->created_at);?></div>
        <div class="a-content">
            <?php echo $item->desc;?>
        </div>
    </dd>
    <?php } ?>
   <?php }else{?>
   <p>暂时无公告.</p>
   <?php } ?><p>
</dl>
 <?php echo Pagination::instance('mypagination')->render();?>
