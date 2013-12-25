
    <div class="content-inner">
        <!--获得的商品开始-->
        <div class="acquire-box">
            <div class="remind ">乐拍提醒：你总共乐购获得商品（<b><?php echo $count;?></b>)件</div>
            <div class="select-box">
                <label for="">全部商品</label>
            <span class="time-choose">选择时间段：
                <select name="" >
                    <option value="">1</option>
                    <option value="">2</option>
                </select>
                <select name="">
                    <option value="">1</option>
                    <option value="">2</option>
                </select>
            </span>
            </div>
            <div class="select">
                <label for="" class="select-title">商品名称</label>
                <input type="text" value="输入商品名字关键字"/>
                <button>搜索</button>
            </div>
            <div class="acquire">
                <table>
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>商品图片</th>
                        <th>商品名称</th>
                        <th>乐拍状态</th>
                        <th>购买数量</th>
                        <th>乐拍码</th>
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
                        <td>1</td>
                        <td><div class="img-box"><a href=""><img src="<?php echo $win->item_id; ?>" alt=""/></a></div></td>
                        <td>（第539期）苹果Iphone 5s 16G版 3G手机</td>
                        <td>已经揭晓啦</td>
                        <td>1人次</td>
                        <td><?php echo $win->code; ?><a href="">查看</a></td>
                        <td><?php echo Html::anchor('w/'.$win->id, '查看详情'); ?></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
                <br />
                <?php echo Pagination::instance('ulottery')->render(); ?>
            </div>
        </div>
        <!--获得的商结束-->
    </div>

