<?php echo Asset::css(['product.css', 'member/validfrom_style.css']); ?>
<?php echo Asset::js(['Validform_v5.3.2_min.js', 'cart/cart.js']); ?>
    <div class="wrapper w">
        <div class="cart-content">
            <ol class="pay-prompt">
                <li class="active"><span>1</span><a href="">确认提交订单></a></li>
                <li><span>2</span><a href="">网银支付></a></li>
                <li><span>3</span><a href="">等待揭晓></a></li>
                <li><span>4</span><a href="">揭晓获奖者></a></li>
                <li><span>5</span><a href="">晒单分享></a></li>
            </ol>
            <form action="<?php echo Uri::create('cart/remove'); ?>" method="post" id="cartForm">
                <div class="cart-list">
                    <table>
                        <thead>
                        <tr>
                            <th></th>
                            <th>商品名称</th>
                            <th>总金币</th>
                            <th>单价</th>
                            <th>购买数量</th>
                            <th>小计</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $subTotal = 0;
                            Config::load('common');
                            if(!empty($items)) :
                            foreach($items as $item) :
                                $info = $getInfo($item->get_id());
                                $subTotal += $item->get_qty();
                        ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?php echo $item->get_id(); ?>"/></td>
                            <td>
                                <div class="img-sm fl">
                                    <a href="<?php echo Uri::create('/m/'. $item->get_id()); ?>"><img src="<?php echo Uri::create('/image/80x80/' . $info->image); ?>" alt=""></a>
                                </div>
                                <div class="info-side fl">
                                    <div class="title-row">
                                         <a href="<?php echo Uri::create('/m/'. $item->get_id()); ?>"><?php echo $info->title; ?></a>
                                    </div>
                                    <div class="remain">还需<b class="o"><?php echo $info->phase->remain; ?></b>金币</div>
                                </div>
                            </td>
                            <td><span class="price"><b><?php echo \Helper\Coins::showCoins($info->phase->cost); ?></b></span></td>
                            <td><span class="price"><b><?php echo \Helper\Coins::showCoins(Config::get('point')); ?></b></span></td>
                            <td>
                                <div class="btn-menu">
                                    <a class="add btn-jian" href="javascript:void(0);">-</a>
                                    <input type="text" value="<?php echo $item->get_qty(); ?>" class="qty" name="qty" rowId="<?php echo $item->get_rowid(); ?>" remain="<?php echo $info->phase->remain?>">
                                    <a class="add btn-jia" href="javascript:void(0);">+</a>
                                    <span>金币</span>
                                </div>
                            </td>
                            <td><span class="price"><b><?php echo \Helper\Coins::showCoins(Config::get('point') * $item->get_qty()); ?></b></span></td>
                            <td><a href="javascript:void(0)" action="delete">删除</a></td>
                        </tr>
                        <?php
                            endforeach;
                            else:
                                if(!is_null($current_user)):
                                echo "<tr><td colspan='7' style='line-height: 50px'>暂时没有商品 <a href='".Uri::base()."'>去购买</a></td></tr>";
                                else:
                                echo "<tr><td colspan='7' style='line-height: 50px'>您还没有登陆，请先<a class='signin' href='".Uri::create('signin')."'>登陆</a></td></tr>";
                                endif;
                            endif;
                        ?>
                        </tbody>
                    </table>
                    <div class="cart-footer">
                        <label class="fl"><input type="checkbox" action="selectAll"/>全选</label>
                        <button class="btn btn-sx fl" action="batchDelete">批量删除</button>
                        <div class="total fr">总金币：<b id="total"><?php echo \Helper\Coins::showCoins($subTotal * Config::get('point')); ?></b></div>
                    </div>
                </div>
            </form>
            <div class="btn-group tr">
                <a href="<?php echo Uri::base(); ?>" class="btn btn-y btn-md doCart">< 返回首页</a>
                <a href="<?php echo Uri::create('cart/pay'); ?>" class="btn btn-red btn-md" id="doOrder">提交订单</a>
            </div>
        </div>
        <!--弹出登录框-->
        <div class="login2">
            <form action="<?php echo Uri::create('signin'); ?>" method="post" >
                <div class="login2-head">
                  <h3>用户登录</h3>
                   <button class="close" id="close"></button>
                </div>
                <label for="" class="error"></label>
                <ul class="login2-body">
                    <li>
                        <input type="text" name="username" placeholder="输入邮箱"  datatype="e" errorms="请输入邮箱帐号" id="form_username" class="Validform_error"/>
                        <span class="icon-user"></span>
                    </li>
                    <li>
                        <input type="password" value="" name="password" placeholder="输入密码"   datatype="*6-15" errorms="密码范围在6-18位之间" id="form_username" class="Validform_error"/>
                        <span class="icon-password"></span>
                    </li>
                    <li>
                        <button class="btn btn-red btn-modal">登录</button>
                        <a href="<?php echo Uri::create('/forgot'); ?>" class="fr">忘记密码？</a>
                    </li>
                </ul>
                <div class="register-bar">还没有帐号？<a href="/signup" class="register">马上注册</a> </div>
            </form>
        </div>
        <!--登陆框-->
        <!--今日热门开始-->
        <div class="unveiled w">
            <div class="caption">以下商品即将揭晓,快去乐拍吧~</div>
            <ul>
                <?php
                $remains = $getRemains();
                foreach($remains as $remain):
                ?>
                <li>
                    <form action="<?php echo Uri::create('cart/add'); ?>" method="post" />
                        <div class="title">
                            <h5 class="title-md"><?php echo $remain->title; ?></h5>
                            <div class="price fr">价值<b>￥<?php echo sprintf('%.2f', $remain->price); ?></b></div>
                        </div>
                        <div class="img-box img-lg">
                            <a href="<?php echo Uri::create('/m/'.$remain->phase->id); ?>"><img src="<?php echo Uri::create('/image/200x200/' . $remain->image); ?>" alt=""></a>
                            <div class="sheng-yi">
                                还需 <s style="font-size:18px;font-weight: normal;"><?php echo $remain->phase->remain; ?></s>金币！
                            </div>
                        </div>
                        <div class="btn-group">
                            <input type="hidden" name="id" value="<?php echo $remain->phase->id; ?>"/>
                            <input type="hidden" name="qty" value="1"/>
                            <button class="btn btn-red btn-atc" type="submit">放入购物车</button>
                        </div>
                    </form>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!--今日热门结束-->
    </div>
    <script type="text/javascript">

    $(function(){
    	$(".login2-body").Validform({
    	tiptype:4,
    	});
    });
    </script>
    <script>
        IS_LOGIN = <?php echo isset($current_user) ? 'true' : 'false';?>;
    </script>
