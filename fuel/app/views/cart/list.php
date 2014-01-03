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
                            if(!empty($items)) :
                            foreach($items as $item) :
                                $info = $getInfo($item->get_id());
                                $subTotal += $item->get_qty();
                        ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?php echo $item->get_id(); ?>"/></td>
                            <td>
                                <div class="img-box fl">
                                    <a href="<?php echo Uri::create('/m/'. $item->get_id()); ?>"><img src="<?php echo Uri::create('/image/80x80/' . $info->image); ?>" alt=""></a>
                                </div>
                                <div class="info-side fl">
                                    <div class="title">
                                         <a href="<?php echo Uri::create('/m/'. $item->get_id()); ?>"><?php echo $info->title; ?></a>
                                    </div>
                                    <div class="remain">剩余<b class="red"><?php echo $info->phase->remain; ?></b>人次</div>
                                </div>
                            </td>
                            <td><s class="red">￥<?php echo sprintf('%.2f', $info->price); ?></s></td>
                            <td><s class="red">￥<?php echo sprintf('%.2f', $info->price); ?></s></td>
                            <td>
                                <div class="btn-menu">
                                    <a class="add btn-jian" href="javascript:void(0);">-</a>
                                    <input type="text" value="<?php echo $item->get_qty(); ?>" name="qty" rowId="<?php echo $item->get_rowid(); ?>" remain="<?php echo $info->phase->remain?>">
                                    <a class="add btn-jia" href="javascript:void(0);">+</a>
                                    <span>人次</span>
                                </div>
                            </td>
                            <td><s class="red">￥<?php echo sprintf('%.2f', $item->get_qty()); ?></s></td>
                            <td><button class="btn btn-default btn-sx" action="delete">删除</button></td>
                        </tr>
                        <?php 
                            endforeach;
                            else:
                                if(!is_null($current_user)):
                                echo "<tr><td colspan='7' style='line-height: 50px'>暂时没有商品 <a href='".Uri::base()."'>去购买</a></td></tr>";
                                else:
                                echo "<tr><td colspan='7' style='line-height: 50px'>您还没有登陆，请先<a href='".Uri::create('signin')."'>登陆</a></td></tr>";
                                endif;
                            endif;
                        ?>
                        </tbody>
                    </table>
                    <div class="cart-footer">
                        <label class="fl"><input type="checkbox" action="selectAll"/>全选</label>
                        <button class="btn btn-default btn-sx fl" action="batchDelete">批量删除</button>
                        <div class="price fr">总金额：<s class="red" id="total">￥<?php echo sprintf('%.2f', $subTotal); ?></s></div>
                    </div>
                </div>
            </form>
            <div class="btn-group tr">
                <a href="<?php echo Uri::base(); ?>" class="btn btn-default">< 返回首页</a>
                <a href="<?php echo Uri::create('cart/pay'); ?>" class="btn btn-default" id="doOrder">提交订单</a>
            </div>
        </div>
        <!--弹出登录框-->
        <div class="login2">
            <form action="<?php echo Uri::create('signin'); ?>" method="post">
                <div class="login2-head">
                  <h4>用户登录</h4>
                   <button class="close" id="close"></button>
                </div>
                <label for="" class="error"></label>
                <ul class="login2-body">
                    <li>
                        <input type="text" value="" name="username" placeholder="输入邮箱"/>
                        <span class="icon-user"></span>
                    </li>
                    <li>
                        <input type="password" value="" name="password" placeholder="输入密码"/>
                        <span class="icon-password"></span>
                    </li>
                    <li>
                        <a href="<?php echo Uri::create('/u/passwd/forgot'); ?>" class="fr">忘记密码？</a>
                    </li>
                    <li>
                        <button class="btn btn-red">登录</button>
                    </li>
                    <li>还没有帐号？<a href="<?php echo Uri::create('signup'); ?>" class="register">马上注册</a> </li>
                </ul>
            </form>
        </div>
        <!--登陆框-->
        <!--今日热门开始-->
        <div class="unveiled w">
            <h4>以下商品即将揭晓,快去乐拍吧~</h4>
            <ul>
                <?php
                $remains = $getRemains();
                foreach($remains as $remain):
                ?>
                <li>
                    <form action="<?php echo Uri::create('cart/add'); ?>" method="post" />
                        <div class="title">
                            <h5><?php echo $remain->title; ?></h5>
                            <div class="price">价值<b>￥<?php echo sprintf('%.2f', $remain->price); ?></b></div>
                        </div>
                        <div class="img-box">
                            <a href="<?php echo Uri::create('/m/'.$remain->phase->id); ?>"><img src="<?php echo Uri::create('/image/200x200/' . $remain->image); ?>" alt=""></a>
                            <div class="sheng-yi">
                                剩余 <b class="red"><?php echo $remain->phase->remain; ?></b>人次本商品就揭晓了！
                            </div>
                        </div>
                        <div class="btn-group">
                            <input type="hidden" name="id" value="<?php echo $remain->phase->id; ?>"/>
                            <input type="hidden" name="qty" value="1"/>
                            <button class="btn btn-red" type="submit">放入购物车</button>
                        </div>
                    </form>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!--今日热门结束-->
    </div>
    <script>
        IS_LOGIN = <?php echo isset($current_user) ? 'true' : 'false';?>;
    </script>

