<div class="w">
    <dl class="announcement">
        <dt>乐淘公告</dt>
        <?php if ($notices) { ?>
        <?php foreach ($notices as $item) { ?>	
        <dd>
            <div class="a-title"><?php echo $item->title; ?></div>
            <div class="datetime">发布于：<?php echo Date('Y-m-d H:i', $item->created_at);?></div>
            <div class="a-content">
                <?php echo $item->desc;?>
            </div>
        </dd>
        <?php } ?>
       <?php }else{?>
       <p>暂时无公告.</p>
       <?php } ?><p>
    </dl>
</div>
