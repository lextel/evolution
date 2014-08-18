<div class="panel panel-default" style="padding: 10px 0">
    <form class="navbar-form navbar-left" role="search" action="" method="get">
        <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">礼品码</span>
              <input type="text" class="form-control" name="code" value="<?php echo !empty(Input::get('code')) ? Input::get('code') : ''; ?>" placeholder="礼品码">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">搜索</button>
        <a href="<?php echo Uri::create('v2admin/invitcodes'); ?>" class="btn btn-default">重置</a>
    </form>
    <form class="navbar-form navbar-left" role="search" action="" method="get">
        <div class="col-sm-5">
            <div class="input-group">
              <span class="input-group-addon">数量</span>
              <input type="text" class="form-control" value="" id="num" placeholder="礼品码生成数量">
              <span class="input-group-addon">奖励</span>
              <?php Config::load('common');?>
              <input type="text" class="form-control" value="<?php echo Config::get('inviteCodeAddPoints');?>" id="award" placeholder="奖励">
              <span class="input-group-addon"><img src="/assets/img/jinbi.png"></span>
            </div>
        </div>
        <a class="btn btn-primary" id="create">生成</a>
        <a class="btn btn-info" style="float: right;" id="loads">批量导出</a>
        </form>
    <div class="clearfix"></div>
</div>

<div class="panel panel-default">
<?php if (isset($codes) && is_array($codes)): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th># ID</th>
            <th width="20%">礼品码</th>
            <th width="10%">奖励价值</th>
            <th>状态</th>
            <th width="20%">激活ID</th>
            <th width="20%">激活时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($codes as $code): ?>
          <tr>
            <td><?php echo $code->id; ?></td>
            <td><?php echo $code->code; ?></td>
            <td><?php echo $code->award . ' <img class="jin" src="/assets/img/jinbi.png">'; ?></td>
            <td><?php echo $code->status == 1 ? '已使用' : '<span style="color:green">未使用</span>'; ?></td>
            <td><?php echo $code->status == 1 ? $getUsername($code->member_id) : ''; ?></td>
            <td><?php echo $code->status == 1 ? date('Y-m-d H:i:s', $code->updated_at) : ''; ?></td>
            <td>
            <?php echo Html::anchor('v2admin/invitcodes/delete/'.$code->id, '删除', array('onclick' => "return confirm('亲，确定删除么?')")); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p style='text-align:center; padding: 40px'>还没有礼品码.</p>
<?php endif; ?>
</div>
<?php echo Pagination::instance('mypagination')->render();?>
<script>
    $(function(){
        $('#loads').click(function(){

            window.location.href = '<?php echo Uri::create('v2admin/invitcodes/outcodes');?>';
        });
        $('#create').click(function(){
            var num = $('#num').val();
            var award = $('#award').val();
            window.location.href = '<?php echo Uri::create('v2admin/invitcodes/create/')?>' + num + '?award=' + award;
        });
        $('#award').click(function() { return false; });
        $('#award').trigger("focus");
        $('#award').blur(function() {
            var award = $(this).val();
            //判断非负整数
            if (!(/^[0-9]{0,3}$/.test(award))){
                $(this).val(<?php echo Config::get('inviteCodeAddPoints');?>);
                return false;
            }
        });
        /*
        $(".rewrite").click(function() {
            var td = $(this);
            var iid = td.attr('iid');
            var txt = td.text();
            var input = $("<input type='text' size='2' value='" + txt + "' />");
            td.html(input);
            input.click(function() { return false; });
            //获取焦点
            input.trigger("focus");
            //文本框失去焦点后提交内容，重新变为文本
            input.blur(function() {
                var newtxt = $(this).val();
                //判断非负整数
                if (!(/^[0-9]{0,5}$/.test(newtxt))){
                    newtxt = 0;
                    td.html(newtxt);
                    return false;
                }
                //判断文本有没有修改
                if (newtxt != txt) {
                    //ajax发送信息
                    $.post("/v2admin/invitcodes/modifyAward/"+iid, { "award": newtxt },
                    function(data){
                        if (data.code == 1){
                            td.html(newtxt);
                        }else{
                            td.html(txt);
                        }
                        alert(data.msg);
                    }, "json")

                }else{
                    td.html(txt);
                }
            });
        }); */
    });
</script>

