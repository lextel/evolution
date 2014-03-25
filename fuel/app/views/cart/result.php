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
                    <th>乐淘码</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($orders as $item):
                        $info = $getInfo($item->phase_id);
                    ?>
                    <tr>
                        <td style="text-align: left">(第<?php echo $info->phase->phase_id; ?>期)<?php echo $info->phase->title; ?></td>
                        <td>
                            <?php
                                $ordered_at = $item->ordered_at;
                                $at = explode('.', $ordered_at);
                                echo date('Y-m-d H:i:s.', $at[0]);
                                echo $at[1];
                            ?>
                        </td>
                        <td><?php echo $item->code_count; ?></td>
                        <td>
                        <div class="toolbox">
                            <a class="tooltip" href="javascript:void(0)">查看</a>
                            <div class="num-list">
                                <div class="icon-arrow"></div>
                                <ul>
                                     <?php 
                                        $codes = unserialize($item->codes);
                                        foreach($codes as $code) {
                                            echo "<li>{$code}</li>";
                                        }
                                     ?>
                                 </ul>
                            </div>
                         </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a class="btn btn-red btn-atc" href="<?php echo Uri::base(); ?>">继续购物</a>
        </div>
        <!--今日热门开始-->
        <div class="unveiled w">
            <h3>以下商品即将揭晓,快去乐淘吧~</h3>
            <ul>
                <?php
                $remains = $getRemains();
                foreach($remains as $remain):
                ?>
                <li>
                    <form action="<?php echo Uri::create('cart/add'); ?>" method="post" />
                        <div class="title-box">
                            <h3 class="title-md"><?php echo $remain->title; ?></h3>
                            <div class="price">价值<b>￥<?php echo sprintf('%.2f', $remain->price); ?></b></div>
                        </div>
                        <div class="img-box">
                            <a href="<?php echo Uri::create('/m/'.$remain->phase->id); ?>">
                                <img src="<?php echo \Helper\Image::showImage($remain->image, '200x200');?>"/>
                            </a>
                            <div class="sheng-yi">
                                还需 <b class="red"><?php echo $remain->phase->remain; ?></b>元宝！
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
