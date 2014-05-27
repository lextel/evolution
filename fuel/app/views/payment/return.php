<?php echo Asset::css('product.css'); ?>
        <div class="pay-panel">
            <?php if(isset($status) && $status):?>
            <div class="panel-head">
                <h2 class="title-chg"><span class="icon icon-succeed"></span>恭喜您, 支付成功！</h2>
                <div style="padding: 40px;text-align: center">
                    商品信息请在<a style="text-decoration: none" href="<?php echo Uri::create('u/orders'); ?>">【乐淘记录】</a>查看
                </div>
            </div>
            <?php else: ?>
                <div class="panel-head">
                    <h2 class="title-chg"><span class="icon icon-error"></span>抱歉, 支付失败！</h2>
                    <div style="padding: 40px;text-align: center">
                        失败原因：<?php echo $reason;?>
                    </div>
                </div>
            <?php endif;?>
            <a class="btn btn-red btn-atc" href="<?php echo Uri::base(); ?>">继续乐淘</a>
        </div>
