<?php echo Asset::css('notice.css'); ?>
<div class="bread">
     <ul>
        <li><a href="<?php echo Uri::create('/'); ?>">首页</a></li>
        <li><em>&gt;</em></li>
        <li><a href="<?php echo Uri::create('notice'); ?>">公告列表</a></li>
        <li><em>&gt;</em></li>
        <li><?php echo $notice->title; ?></li>
     </ul>
</div>
<div class="notice_container"> 
    <div class="notice_title">
        <h2><?php echo $notice->title?></h2>
    </div>
    <div class="notice_time"><span>乐乐淘</span>发布于：<?php echo date('Y-m-d H:i', $notice->created_at);?></div>
    <div class="notice_content">
        <?php echo html_entity_decode($notice->desc);?>
    </div>
</div>
