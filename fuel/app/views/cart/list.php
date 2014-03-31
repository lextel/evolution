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
            <form action="<?php echo Uri::create('cart/pay'); ?>" method="post" id="cartForm">
                <div class="cart-list">
                    <table>
                        <thead>
                        <tr>
                            <th></th>
                            <th>商品名称</th>
                            <th>总元宝</th>
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
                            if(!empty($items)):
                                list($normalList, $overdueList) = $getList($items);
                            endif;
                            if(isset($normalList) && !empty($normalList)):
                                foreach($normalList as $item):
                                $subTotal += $item['qty'];
                        ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" checked="true" value="<?php echo $item['rowid'];?>"/></td>
                            <td>
                                <div class="img-sm fl">
                                    <a href="<?php echo Uri::create('m/'. $item['id']); ?>">
                                        <img src="<?php echo \Helper\Image::showImage($item['image'], '80x80');?>"/>
                                    </a>
                                </div>
                                <div class="info-side fl">
                                    <div class="title-row">
                                         <a href="<?php echo Uri::create('m/'. $item['id']); ?>"><?php echo $item['title']; ?></a>
                                    </div>
                                    <div class="remain">还需<b class="o"><?php echo $item['remain']; ?></b>元宝</div>
                                </div>
                            </td>
                            <td><span class="price"><b><?php echo \Helper\Coins::showCoins($item['cost'], true); ?></b></span></td>
                            <td><span class="price"><b><?php echo \Helper\Coins::showCoins(Config::get('point'), true); ?></b></span></td>
                            <td>
                                <div class="btn-menu inner-b-m">
                                    <a class="add btn-jian" href="javascript:void(0);">-</a>
                                    <input type="text" value="<?php echo $item['qty']; ?>" class="qty" name="qty" rowId="<?php echo $item['rowid']; ?>" remain="<?php echo $item['remain'];?>">
                                    <a class="add btn-jia" href="javascript:void(0);">+</a>
                                    <span>元宝</span>
                                </div>
                            </td>
                            <td><span class="price"><b><?php echo \Helper\Coins::showCoins(Config::get('point') * $item['qty'], true); ?></b></span></td>
                            <td><a href="javascript:void(0)" action="delete" rowId="<?php echo $item['rowid'];?>">删除</a></td>
                        </tr>
                        <?php 
                                endforeach;
                            endif;
                            if(isset($overdueList) && !empty($overdueList)):
                        ?>
                        <tr>
                            <td colspan="7" style="background:#eee">以下商品已经过期，将不参与结算</td>
                        </tr>
                        <?php
                            foreach($overdueList as $item):
                        ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <div class="img-sm fl">
                                    <a href="<?php echo Uri::create('m/'. $item['id']); ?>">
                                        <img src="<?php echo \Helper\Image::showImage($item['image'], '80x80');?>"/>
                                    </a>
                                </div>
                                <div class="info-side fl">
                                    <div class="title-row">
                                         <a href="<?php echo Uri::create('m/'. $item['id']); ?>"><?php echo $item['title']; ?></a>
                                    </div>
                                    <div class="remain">还需<b class="o"><?php echo $item['remain']; ?></b>元宝</div>
                                </div>
                            </td>
                            <td><span class="price"><b><?php echo \Helper\Coins::showCoins($item['cost'], true); ?></b></span></td>
                            <td><span class="price"><b><?php echo \Helper\Coins::showCoins(Config::get('point'), true); ?></b></span></td>
                            <td>
                                <div class="btn-menu inner-b-m">
                                    <?php echo $item['qty']; ?>
                                    <span>元宝</span>
                                </div>
                            </td>
                            <td><span class="price"><b><?php echo \Helper\Coins::showCoins(Config::get('point') * $item['qty'], true); ?></b></span></td>
                            <td><a href="javascript:void(0)" action="delete" rowId="<?php echo $item['rowid'];?>">删除</a></td>
                        </tr>
                        <?php
                            endforeach;
                            endif;
                        ?>
                        <?php 
                            if(empty($normalList) && empty($overdueList)):
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
                        <label class="fl"><input type="checkbox" action="selectAll" checked="true"/>全选/取消</label>
                        <div class="total fr">总元宝：<b id="total"><?php echo \Helper\Coins::showCoins($subTotal * Config::get('point'), true); ?></b></div>
                    </div>
                </div>
                <div class="btn-group tr">
                    <a href="<?php echo Uri::base(); ?>" class="btn btn-y btn-md doCart"><继续乐淘</a>
                    <button type="submit" class="btn btn-red btn-md" id="doOrder">提交订单</button>
                </div>
            </form>
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
                        <input type="text" name="username" placeholder="请输入手机/邮箱"  datatype="em" errorms="请输入手机/邮箱" sucmsg=" " id="form_username" class="Validform_error"/>
                        <span class="icon-user"></span>
                    </li>
                    <li>
                        <input type="password" value="" name="password" placeholder="输入密码"   datatype="*6-18" sucmsg=" " errorms="密码范围在6-18位之间" id="form_username" class="Validform_error"/>
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
            <div class="caption">以下商品即将揭晓,快去乐淘吧~</div>
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
                            <a href="<?php echo Uri::create('/m/'.$remain->phase->id); ?>">
                                <img src="<?php echo \Helper\Image::showImage($remain->image, '200x200');?>"/>
                            </a>
                            <div class="sheng-yi">
                                还需 <s style="font-size:18px;font-weight: normal;"><?php echo $remain->phase->remain; ?></s>元宝！
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
        datatype:{
              'em': function (gets,obj,curform,regxp){
                var m = /^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/;
                var e = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
                if(m.test(gets) || e.test(gets)){
                   return true;
                }
                return "手机/邮箱格式不正确";
              }
            }
    	});
    });
    </script>
    <script>
        IS_LOGIN = <?php echo isset($current_user) ? 'true' : 'false';?>;
    </script>
