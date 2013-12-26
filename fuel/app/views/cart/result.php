<?php echo Asset::css('product.css'); ?>
    <div class="wrapper w">
        <div class="pay-panel">
            <div class="pay-panel-head">
                <span class="icon"></span>
                <p>恭喜你支付成功！请等待系统为你揭晓结果</p>
                <p>你可以 <a href="<?php echo Uri::create('u/orders'); ?>">查看云购记录</a>或<a href="<?php echo Uri::base(); ?>">继续购物</a> </p>
                <p>总共成功云购1件商品，信息如下</p>
            </div>
            <table>
                <thead>
                <tr>
                    <th>购买时间</th>
                    <th>商品名称</th>
                    <th>购买数量</th>
                    <th>乐拍码</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($items as $item):
                        $info = $getInfo($item->get_id());
                    ?>
                    <tr>
                        <td>2013-12-33 10:00:00</td>
                        <td>(第<?php $info->phase->phase_id; ?>期)<?php echo $info->phase->title; ?></td>
                        <td><?php echo $item->get_qty(); ?></td>
                        <td>100021</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
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


