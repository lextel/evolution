<?php echo Asset::css('product.css'); ?>
<div class="pay-panel">
        <div class="panel-head">
            <h2 class="title-chg"><span class="icon icon-succeed"></span>抱歉, 操作失败！</h2>
            <div style="padding: 20px;">
                失败原因：<?php echo $reason;?>
            </div>
        </div>
    <a class="btn btn-red btn-atc" href="<?php echo Uri::base(); ?>">继续乐淘</a>
</div>
