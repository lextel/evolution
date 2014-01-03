<?php echo Asset::css(['product.css', 'customBootstrap.css']); ?>
<?php echo Asset::js(['bootstrap.min.js', '/cart/cart.js']); ?>
<div class="wrapper w">
    <div class="cart-content">
        <ol class="pay-prompt">
            <li><a href="javascript:void(0);"><span>1</span>确认提交订单>></a></li>
            <li class="active"><a href="javascript:void(0);"><span>2</span>网银支付>></a></li>
            <li><a href="javascript:void(0);"><span>3</span>等待揭晓>></a></li>
            <li><a href="javascript:void(0);"><span>4</span>揭晓获奖者>></a></li>
            <li><a href="javascript:void(0);"><span>5</span>晒单分享>></a></li>
        </ol>
        <div class="cart-list">
            <form id="cartForm" action="<?php echo Uri::create('cart/remove'); ?>" method="post">
                <table>
                    <thead>
                    <tr>
                        <th style="display:none"></th>
                        <th>商品名称</th>
                        <th>价值</th>
                        <th>单价</th>
                        <th>购买数量</th>
                        <th>小计</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $subTotal = 0;
                        foreach($items as $item):
                            $info = $getInfo($item->get_id());
                            $subTotal += $item->get_qty();
                    ?>
                    <tr>
                        <td style="display:none"><input type="checkbox" name="ids[]" value="<?php echo $item->get_id(); ?>"/></td>
                        <td>
                            <div class="img-box fl"><a href="<?php echo Uri::create('/m/'.$item->get_id()); ?>"><img src="<?php echo Uri::create('/image/80x80/' . $info->image); ?>" alt=""></a>
                            </div>
                            <div class="info-side fl">
                                <div class="title">
                                    <a href="<?php echo Uri::create('/m/'.$item->get_id()); ?>"><?php echo $info->title; ?></a>
                                </div>
                                <div class="remain">剩余<b class="red"><?php echo $info->phase->remain; ?></b>人次</div>
                            </div>
                        </td>
                        <td><s class="red">￥<?php echo sprintf('%.2f', $info->price); ?></s></td>
                        <td><s class="red">￥<?php echo sprintf('%.2f', $info->price); ?></s></td>
                        <td><?php echo $item->get_qty(); ?></td>
                        <td><s class="red">￥<?php echo sprintf('%.2f', $item->get_qty()); ?></s></td>
                        <td><button class="btn btn-default btn-sx" action="delete">删除</button></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
            <div class="cart-footer">
                <a class="btn btn-default btn-sx fl" href="<?php echo Uri::create('cart/list'); ?>">返回修改订单</a>
                <div class="price fr">总金额：<s class="red" id="total" total="<?php echo $subTotal; ?>">￥<?php echo sprintf('%.2f', $subTotal); ?></s></div>
            </div>
        </div>
            <div class="balance-box w">
                <?php
                    $memberInfo = $userInfo();
                ?>
                <label>
                    <input type="checkbox" name="balance" id="balance">
                    <span>使用帐户余额支付，帐户余额：<b class="y" id="money" money="<?php echo $memberInfo->points; ?>"><?php echo sprintf('%.2f', $memberInfo->points); ?></b>元 </span>
                </label>
            </div>
    </div>
    <!--选择支付方式开始-->
    <div class="pay-way">
        <div class="title"><h4>选择付款方式</h4></div>
        <dl>
            <dt>第三方平台</dt>
            <dd>
                <input type="radio" name="account"/>
                <label for="">
                    <span class="zhf"></span>
                </label>
            </dd>
            <dt>网银支付</dt>
            <dd>
                <input type="radio" name="account"/>
                <label for="">
                    <span class="zhs"></span>
                </label>
            </dd>
            <dd>
                <input type="radio" name="account"/>
                <label for="">
                    <span class="jt"></span>
                </label>
            </dd>
            <dd>
                <input type="radio" name="account"/>
                <label for="">
                    <span class="gsh"></span>
                </label>
            </dd>
            <dd>
                <input type="radio" name="account"/>
                <label for="">
                    <span class="zhg"></span>
                </label>
            </dd>
            <dd>
                <input type="radio" name="account"/>
                <label for="">
                    <span class="zhx"></span>
                </label>
            </dd>
            <dd>
                <input type="radio" name="account"/>
                <label for="">
                    <span class="jsh"></span>
                </label>
            </dd>
            <dd>
                <input type="radio" name="account"/>
                <label for="">
                    <span class="ny"></span>
                </label>
            </dd>
        </dl>
        <a href="javascript:void(0);" url="<?php echo Uri::create('/cart/dopay'); ?>" target="_brank" class="btn buy fr" id="doPay">确认支付</a>
        <!-- 弹出开始 -->
        <div id="payModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="mySmallModalLabel">支付提醒</h4>
                    </div>
                    <div class="modal-body">
                        <button class="btn" id="problem"> 支付遇到问题 </button>
                        <button class="btn" id="complete"> 完成支付 </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 弹出结束 -->
    </div>
    <!--选择支付方式结束-->
        <dl class="pay-help w">
            <dt><h4>付款遇到问题</h4></dt>
            <dd>
                <ol>
                    <li>1.如果你未开通网上银行，可以使用储蓄卡快捷支付轻松完成付款;</li>
                    <li>2.如果你未开通网上银行，可以使用储蓄卡快捷支付轻松完成付款;</li>
                    <li>3.如果你未开通网上银行，可以使用储蓄卡快捷支付轻松完成付款;</li>
                </ol>
            </dd>
            <dd><a href="<?php echo Uri::create('/help'); ?>">更多帮助</a><a href="<?php echo Uri::create('/u'); ?>">进入我的个人中心</a></dd>
        </dl>
</div>
<script>
    COMPLETE_URL = '<?php echo Uri::create('cart/complete'); ?>';
</script>
