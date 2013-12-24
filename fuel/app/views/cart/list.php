<?php echo Asset::css('product.css'); ?>
<?php echo Asset::js('/cart/cart.js'); ?>
    <div class="wrapper w">
        <div class="cart-content">
            <ol class="pay-prompt">
                <li><a href=""><span>1</span>确认提交订单>></a></li>
                <li><a href=""><span>2</span>网银支付>></a></li>
                <li><a href=""><span>3</span>等待揭晓>></a></li>
                <li><a href=""><span>4</span>揭晓获奖者>></a></li>
                <li><a href=""><span>5</span>晒单分享>></a></li>
            </ol>
            <form action="<?php echo Uri::create('cart/remove'); ?>" method="post" id="cartForm">
                <div class="cart-list">
                    <table>
                        <thead>
                        <tr>
                            <th></th>
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
                            foreach($items as $item) :
                                $info = $getInfo($item->get_id());
                                $subTotal += $item->get_qty();
                        ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?php echo $item->get_id(); ?>"/></td>
                            <td>
                                <div class="img-box fl">
                                    <a href=""><img src="<?php echo $info->image; ?>" alt=""></a>
                                </div>
                                <div class="info-side fl">
                                    <div class="title">
                                        <a href=""><?php echo $info->title; ?></a>
                                    </div>
                                    <div class="remain">剩余<b class="red"><?php echo $info->phase->remain; ?></b>人次</div>
                                </div>
                            </td>
                            <td><s class="red">￥<?php echo sprintf('%.2f', $info->price); ?></s></td>
                            <td><s class="red">￥<?php echo sprintf('%.2f', $info->price); ?></s></td>
                            <td>
                                <div class="btn-menu">
                                    <button class="">-</button>
                                    <input type="text" value="<?php echo $item->get_qty(); ?>" name="qty">
                                    <button class="">+</button>
                                    <span>人次</span>
                                </div>
                            </td>
                            <td><s class="red">￥<?php echo sprintf('%.2f', $item->get_qty()); ?></s></td>
                            <td><button class="btn btn-default btn-sx" action="delete">删除</button></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="cart-footer">
                        <label class="fl"><input type="checkbox" action="selectAll"/>全选</label>
                        <button class="btn btn-default btn-sx fl" action="batchDelete">批量删除</button>
                        <div class="price fr">总金额：<s class="red">￥<?php echo sprintf('%.2f', $subTotal); ?></s></div>
                    </div>
                </div>
            </form>
            <div class="btn-group tr">
                <a href="<?php echo Uri::base(); ?>" class="btn btn-default">< 返回首页</a>
                <a href="<?php echo Uri::create('cart/pay'); ?>" class="btn btn-default">提交订单</a>
            </div>
        </div>
        <!--今日热门开始-->
        <div class="unveiled w">
            <h4>以下商品即将揭晓,快去乐拍吧~</h4>
            <ul>
                <li>
                    <div class="title">
                        <h5>苹果智能手机32G苹果智能手机32G</h5>
                        <div class="price">价值<b>￥5000</b></div>
                    </div>
                    <div class="img-box">
                        <a href=""><img src="img/54359.jpg" alt=""></a>
                        <div class="sheng-yi">
                            剩余 <b class="red">0</b>人次本商品就揭晓了！
                        </div>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-red">放入购物车</button>
                    </div>
                </li>
            </ul>
        </div>
        <!--今日热门结束-->
    </div>

