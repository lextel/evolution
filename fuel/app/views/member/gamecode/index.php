<div class="content-inner" style="min-height: 626px;">
        <!--乐淘记录开始-->
        
        <div class="lead">游戏码兑换</div>
        <div class="record-box" style="margin-top: 20px">

            （第<?php echo $phase->phase_id;?>期）<?php echo $phase->title;?>
            </div>
            <div class="record-box" style="margin-top: 20px">
            商品订单码：<?php echo $gift->code;?>
            </div>
            <div class="record-box" style="margin-top: 20px">
            可兑换的游戏：<?php echo $getGameName($gift->game_id);?>
        </div>
        <?php if ($gift->status == 0) { ?>
            <div class="record-box" style="margin-top: 20px">
                <span>填写游戏ID领取游戏码：</span>
            </div>
            <div class="record-box" style="margin-top: 20px">
                <span>游戏ID：</span>
                <input type="text" id="gameID" style="height: 30px;border: 1px solid #D2D2D2;padding:0 5px" name="project" value="" placeholder="游戏ID">
                <button id="use_code" style="margin-left: 15px;width: 60px;height: 30px;border-radius: 3px;background: #af2812;color: #FFFFFF;cursor: pointer;">领取</button>
            </div>
        <?php }else{ ?>
            <div class="record-box" style="margin-top: 20px">
                <span>该码已经兑换游戏了，兑换的码为：</span>
                <b class="r"><?php echo $getGiftCode($gift->gift_id);?></b>
            </div>
        <?php } ?>
    </div>
</div>
<script>

$(function(){
     $('#use_code').click(function() {
         var code    = $('#gameID').val();

         if(code.length < 1) {
            alert('游戏ID不能为空。');
            return false;
         }
         $.ajax({
            url: '<?php echo Uri::create('u/addgameid');?>',
            data: {project: code, gameid: <?php echo $gift->game_id?>},
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if(data.code == 0) {
                    alert('恭喜您，兑换成功。');
                    window.location="<?php echo Uri::current();?>";
                } else {
                    alert(data.msg);
                }
            },
            error: function() {
                alert('网络错误!');
            }
         });
     });
});

</script>
