<?php echo Asset::css('product.css'); ?>
        <div class="pay-panel">
            <div class="panel-head">
                <h2 class="title-chg"><span class="icon icon-succeed"></span>恭喜您成功购买<b><?php echo count($orders); ?></b>件商品，信息如下</h2>
            </div>
            <table>
                <thead>
                <tr>
                    <th width="60%">商品名称</th>
                    <th>购买时间</th>
                    <th>数量</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($orders as $item):
                        $info = $getInfo($item->phase_id);
                    ?>
                    <tr>
                        <td style="text-align: left"><?php echo $info->title; ?></td>
                        <td>
                            <?php
                                $ordered_at = $item->ordered_at;
                                $at = explode('.', $ordered_at);
                                echo date('Y-m-d H:i:s.', $at[0]);
                                echo $at[1];
                            ?>
                        </td>
                        <td><?php echo $item->code_count; ?></td>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a class="btn btn-red btn-atc" href="<?php echo Uri::base(); ?>">继续乐淘</a>
        </div>
        <!--今日热门开始-->
        <div class="unveiled w">
            <div class="caption">以下是热门商品，亲，赶紧淘了吧~</div>
            <ul>
                <?php
                $remains = $getRemains();
                foreach($remains as $remain):
                ?>
                <li>
                    <form action="<?php echo Uri::create('cart/add'); ?>" method="post" />
                        <div class="title">
                            <h5 class="title-md"><?php echo $remain->title; ?></h5>
                            <div class="price fr">价格<b>￥<?php echo sprintf('%.2f', $remain->price); ?></b></div>
                        </div>
                        <div class="img-box img-lg">
                            <a href="<?php echo Uri::create('/m/'.$remain->id); ?>">
                                <img src="<?php echo \Helper\Image::showImage($remain->image, '200x200');?>"/>
                            </a>
                        </div>
                        <div class="btn-group">
                            <input type="hidden" name="id" value="<?php echo $remain->id; ?>"/>
                            <input type="hidden" name="qty" value="1"/>
                            <button class="btn btn-red btn-atc" type="submit">放入购物车</button>
                        </div>
                    </form>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!--今日热门结束-->
