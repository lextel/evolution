<br />
<div class="content-inner">
        <!--乐拍记录开始-->
        <div class="record-box">
            <div class="remind ">乐拍提醒：
                <span>即将揭晓商品（<b>0</b>）件</span>
                <span>进行中的商品（<b>0</b>)件</span>
                <span>揭晓的商品（<b>0</b>）件</span>
            </div>
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
            <div class="record">
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
                    <?php if(empty($orders)) {
                      echo '<tr><td colspan="5" style="text-align:center">亲，您还没有购买过商品哦！</td></tr>';
                    }
                    ?>
                    <?php foreach($orders as $order) { ?>
                    <tr>
                        <td><?php echo $order->id; ?></td>
                        <td><div class="img-box"><a href=""><img src="img/54359.jpg" alt=""/></a></div></td>
                        <td>
                            <div class="text-title">（第539期）苹果Iphone 5s 16G版 3G手机</div>
                            <div class="winner">获得者：狼行千里</div>
                            <div class="number">幸运乐拍码：10000121</div>
                            <div class="datetime">揭晓时间：2013-12-33 10:00:00</div>
                        </td>
                        <td>未揭晓</td>
                        <td>1人次</td>
                        <td><a href="">查看</a></td>
                        <td><a href="">查看详情</a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php echo Pagination::instance('uorderpage')->render(); ?>
            </div>
        </div>
        <!--乐拍记录结束-->
    </div>
</div>
