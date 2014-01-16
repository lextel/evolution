<?php echo Asset::css('member/jquery-ui.css'); ?>
<?php echo Asset::js(['jquery-ui.js', 'member/index.js']); ?>

    <div class="content-inner">
        <!--获得的商品开始-->
        <div class="acquire-box">
            <div class="remind ">乐拍提醒：你总共乐购获得商品（<?php echo $wincount;?>)件</div>
            <div class="select-box">
            <label for="">全部商品</label>
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
                        <th>乐拍状态</th>
                        <th>购买数量</th>
                        <th>幸运乐拍码</th>
                        <th> 快递状态 </th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                       if(empty($list)) {
                       echo '<tr><td colspan="5" style="text-align:center">亲，您还没有中过奖，请再努力点哦！</td></tr>';
                       }
                     ?>
                    <?php foreach($list as $win) { ?>
                    <tr>

                        <td><div class="img-box img-sm"><?php echo Html::anchor("w/".$win->id, Html::img($win->image)); ?></div></td>
                        <td>（第<?php echo $win->phase_id;?>期）<?php echo $win->title;?></td>
                        <td>已经揭晓</td>
                        <td><?php echo $win->code_count;?>人次</td>
                        <td><?php echo $win->code; ?></td>
                        
                        <td><?php $status = intval($getShipping($win->id)); ?>
                        <?php echo $getShippingStatus($status);?>
                        <?php if ($status < 100) { ?>
                           <div class="toolbox">
                           <a class="tooltip" href="javascript:void(0)" style="padding: 2px 2px;">查看快递</a>
                        
                           <div class="num-list">
                                <div class="icon-arrow"></div>
                                <ul>
                                    
                                 </ul>
                            </div>
                            </div>
                        <?php }?>                        
                        </td>
                        <td><?php echo Html::anchor('w/'.$win->id, '查看详情'); ?></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
                <br />
                <?php echo Pagination::instance('uwins')->render(); ?>
            </div>
        </div>
        <!--获得的商结束-->
    </div>
