<?php echo Asset::css('member/jquery-ui.css'); ?>
<?php echo Asset::js('jquery-ui.js'); ?>
<script>
  $(function() {
    $( "#datepicker" ).datepicker({
      showWeek: true,
      firstDay: 1
    });
    $( "#datepicker1" ).datepicker({
      showWeek: true,
      firstDay: 1
    });
    
    
    function getDateSearch(url){
        action = url;
        form = $("<form></form>")
        form.attr('action',action)
        form.attr('method','get')
        input1 = $("#datepicker").val();
        input2 = $("#datepicker1").val();
        if (input1 && input2){
           form.append("<input type='hidden' name='date1' value="+input1+">");
           form.append("<input type='hidden' name='date2' value="+input2+">");
           form.submit()
        }
    }
    $(".wins-date-search").click(function (){
        var url = '/u/wins';
        getDateSearch(url);
    });
    
    $(".wins-search").click(function (){
        action = "/u/wins";
        form = $("<form></form>")
        form.attr('action',action)
        form.attr('method','get')
        input1 = $("#word").val();
        form.append("<input type='hidden' name='word' value="+input1+">");
        form.submit()
    });
    
  });
  </script>
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
                        <th>编号</th>
                        <th>商品图片</th>
                        <th>商品名称</th>
                        <th>乐拍状态</th>
                        <th>购买数量</th>
                        <th>幸运乐拍码</th>
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
                        <td><div class="img-box"><?php echo Html::anchor("w/".$win->id, Html::img($getItem($win)->image)); ?></div></td>
                        <td>（第<?php echo $win->phase_id;?>期）<?php echo $win->title;?></td>
                        <td>已经揭晓</td>
                        <td><?php echo $win->code_count;?>人次</td>
                        <td><?php echo $win->code; ?><!--<a href="">查看</a>--></td>
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

