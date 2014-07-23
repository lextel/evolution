<?php echo Asset::css(['product.css', 'customBootstrap.css', 'style.css']); ?>
<?php echo Asset::js(['bootstrap.min.js', '/cart/cart.js']); ?>
<div class="wrapper w">
    <div class="cart-content">
        <ol class="pay-prompt">
                        <li><span>1</span><a href="">确认提交订单></a></li>
                        <li class="active"><span>2</span><a href="">网银支付></a></li>
                        <li><span>3</span><a href="">等待揭晓></a></li>
                        <li><span>4</span><a href="">揭晓获奖者></a></li>
                        <li><span>5</span><a href="">晒单分享></a></li>
                    </ol>
        <div class="cart-list">
            <form id="cartForm" action="<?php echo Uri::create('cart/remove'); ?>" method="post">
                <table>
                    <thead>
                    <tr>
                        <th style="display:none"></th>
                        <th>商品名称</th>
                        <th>总元宝</th>
                        <th>单价</th>
                        <th>数量</th>
                        <th>小计</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $subTotal = 0;
                        Config::load('common');
                        foreach($items as $item):
                            $info = $getInfo($item->get_id());
                            $subTotal += $item->get_qty();
                    ?>
                    <tr>
                        <td style="display:none">&nbsp;</td>
                        <td>
                            <div class="img-sm fl">
                                <a href="<?php echo Uri::create('/m/'.$item->get_id()); ?>">
                                    <img src="<?php echo \Helper\Image::showImage($info->image, '80x80');?>"/>
                                </a>
                            </div>
                            <div class="info-side fl">
                                <h4>
                                    <a href="<?php echo Uri::create('/m/'.$item->get_id()); ?>"><?php echo $info->title; ?></a>
                                </h4>
                                <div class="remain">还需<b class="red"><?php echo $info->phase->remain; ?></b>元宝</div>
                            </div>
                        </td>
                        <td><s><?php echo \Helper\Coins::showCoins($info->phase->cost, true); ?></s></td>
                        <td><s><?php echo \Helper\Coins::showCoins(Config::get('point'), true); ?></s></td>
                        <td><?php echo $item->get_qty(); ?></td>
                        <td><s><?php echo \Helper\Coins::showCoins($item->get_qty() * Config::get('point'), true); ?></s></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
            <div class="cart-footer">
                <a class="btn btn-sx btn-gy fl" style="margin-left: 0px" href="<?php echo Uri::create('cart/list'); ?>"> < 返回修改订单</a>
                <div class="all-price fr">总元宝：<b id="total" total="<?php echo $subTotal*Config::get('point'); ?>"><?php echo \Helper\Coins::showCoins($subTotal * Config::get('point'), true); ?></b></div>
            </div>
        </div>
    </div>
    <div class="pay-row"><label><input type="checkbox" id="goldPay">使用元宝支付，您有：<?php echo \Helper\Coins::showCoins($current_user->points, true);?></label><b id="money" money="<?php echo $current_user->points; ?>" style="display:none"></b></div>
    <!--选择支付方式开始-->
    <div class="prepaid-box">
                <!--选择支付方式开始-->
                <div class="pay-way">
                    <div class="caption" style="margin-bottom: 8px">元宝不足？请选择下面方式购买</div>
                    <dl>
                        <dt>第三方平台</dt>
                         <dd>
                            <input type="radio" id="kq" name="account" value="99bill">
                            <label for="kq">
                                <span class="kq"></span>
                            </label>
                        </dd>
                        <?php if (0) { ?><dd>
                            <input type="radio" id="bfb" name="account" value="bfb"/>
                            <label for="bfb">
                                <span class="bfb"></span>
                            </label>
                        </dd>
                        <dd>
                            <input type="radio" id="cft" name="account" value="tenpay">
                            <label for="cft">
                                <span class="cft"></span>
                            </label>
                        </dd>
                        <?php } ?>
                        <!--dt>网银支付</dt>
                        <dd>
                            <input type="radio" id="zhs" name="account">
                            <label for="zhs">
                                <span class="zhs"></span>
                            </label>
                        </dd>
                        <dd>
                            <input type="radio" id="jt" name="account">
                            <label for="jt">
                                <span class="jt"></span>
                            </label>
                        </dd>
                        <dd>
                            <input type="radio" id="gsh" name="account">
                            <label for="gsh">
                                <span class="gsh"></span>
                            </label>
                        </dd>
                        <dd>
                            <input type="radio" id="zhg" name="account">
                            <label for="zhg">
                                <span class="zhg"></span>
                            </label>
                        </dd>
                        <dd>
                            <input type="radio" id="zhx" name="account">
                            <label for="zhx">
                                <span class="zhx"></span>
                            </label>
                        </dd>
                        <dd>
                            <input type="radio" id="jsh" name="account">
                            <label for="jsh">
                                <span class="jsh"></span>
                            </label>
                        </dd>
                        <dd>
                            <input type="radio" id="ny" name="account">
                            <label for="ny">
                                <span class="ny"></span>
                            </label>
                        </dd-->
                    </dl>
                </div>
                <!--选择支付方式结束-->
                <div id="payModal" style="top: 200px" class="modal fade bs-modal-sm login2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-sm">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                   <h4 class="modal-title" id="mySmallModalLabel">温馨提示</h4>
                              </div>
                              <div class="modal-body">
                                  您的元宝不足，请使用在线支付进行购买。
                              </div>
                         </div>
                     </div>
                 </div>
                <!--<div id="thirdPartyModal" style="top: 220px" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">-->
                <div class="payuse">
                     <div class="modal-sm">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                                   <h4 class="modal-title" id="mySmallModalLabel">支付结果</h4>
                                   <!--<h4 class="o">请在新打开的页面上完成支付</h4>
                                   <p>付款完成之前，请不要关闭本窗口！ </p>
                                   <p>完成付款后根据您的个人情况完成此操作 </p>-->
                              </div>
                              <div class="modal-body">
                                    <a href="<?php echo Uri::create('/u/orders');?>" class="btn btn-red btn-md" id="payFinish">支付完成</a>
                                    <a href="<?php echo Uri::create('/cart/pay');?>" class="btn btn-state btn-md" style="margin-left: 50px" id="payFail">支付失败</a>
                              </div>
                         </div>
                     </div>
               </div>
    </div>
    <div class="pay-row">
        <a href="javascript:;" class="btn btn-red btn-md fr" id="doBuy">确认支付</a>
    </div>
    <!--选择支付方式结束-->
        <dl class="pay-help w">
            <dt>购买遇到问题</dt>
            <dd>
                <ol>
                    <li>1、如果你未开通网上银行，可以使用储蓄卡快捷支付轻松完成付款;</li>
                    <li>2、如果您没有网银，可以使用银联在线支付，银联有支持无需开通网银的快捷支付和储值卡支付；;</li>
                    <li>3、如果您有财付通或快钱、手机支付账户，可将款项先充入相应账户内，然后使用账户余额进行一次性支付；;</li>
                    <li>4、如果银行卡已经扣款，但您的账户中没有显示，有可能因为网络原因导致，将在第二个工作日恢复。</li>
                </ol>
            </dd>
            <dd><a href="<?php echo Uri::create('/h'); ?>">更多帮助</a><a href="<?php echo Uri::create('/u'); ?>">进入我的个人中心</a></dd>
        </dl>
</div>