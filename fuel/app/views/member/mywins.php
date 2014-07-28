<?php echo Asset::css('member/jquery-ui.css'); ?>
<?php echo Asset::js(['jquery-ui.js', 'member/index.js']); ?>
    <div class="content-inner">
        <!--获得的商品开始-->
        <div class="lead">获得的商品</div>
        <div class="acquire-box">
            <div class="remind ">乐淘提醒：你总共乐淘获得商品（<?php echo $wincount;?>）件</div>
            <div class="select-box">
            <label for=""><?php echo Html::anchor('/u/wins', '全部商品', ['class'=>'b']);?></label>
            <span class="time-choose">选择时间段：
                 <input  id="datepicker" type="text" placeholder="输入起始时间" />
                 <input  id="datepicker1" type="text" placeholder="输入结束时间" />
                 <button class="wins-date-search">搜索</button>
            </span>
            </div>
            <div class="select">
                <label for="" class="select-title">商品名称</label>
                <input type="text" id="word" value="" placeholder="输入商品名字关键字" />
                <button class="wins-search">搜索</button>
            </div>
            <div class="acquire">
                <table>
                    <thead>
                    <tr>
                        <th>商品图片</th>
                        <th>商品名称</th>
                        <th>乐淘状态</th>
                        <th>购买数量</th>
                        <th>幸运乐淘码</th>
                        <th>快递状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                       if(empty($list)) {
                       echo '<tr><td colspan="7" style="text-align:center">亲，您还没有中过奖，请再努力点哦！</td></tr>';
                       }
                     ?>
                    <?php foreach($list as $win) { ?>
                    <tr>

                        <td>
                            <div class="img-box img-sm">
                                <a href="<?php echo Uri::create('w/'.$win->id); ?>" rel="nofollow">
                                    <img src="<?php echo \Helper\Image::showImage($win->image, '80x80', 'items');?>"/>
                                </a>
                            </div>
                        </td>
                        <td><div class="tl">（第<?php echo $win->phase_id;?>期）<?php echo $win->title;?></div></td>
                        <td>已经揭晓</td>
                        <td><?php echo $win->code_count;?>元宝</td>
                        <td><?php echo $win->code; ?></td>

                        <td><?php $status = intval($getShipping($win->id)); ?>
                        <?php echo $getShippingStatus($status);?>
                        <?php if ($status < 100) { ?>
                           <div class="toolbox">
                           <a class="tooltip" href="javascript:void(0)">查看快递</a>
                           <div class="num-list" id="num-list">
                                <div class="icon-arrow"></div>
                                <div class="item">
                                <table>
                                    <tbody>
                                    <?php foreach($getShippingData($win->id) as $row) { ?>
                                          <tr>
                                          <td><?php echo $row->context;?></td><td><?php echo $row->time;?></td>
                                          </tr>
                                      <?php } ?>
                                      </tbody>
                                </table>
                                </div>
                                <button class="icon-close"></button>
                            </div>
                            </div>
                        <?php }?>
                        </td>
                        <td><?php echo Html::anchor('w/'.$win->id, '查看详情'); ?></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--获得的商结束-->
         <?php echo Pagination::instance('uwins')->render(); ?>
    </div>
