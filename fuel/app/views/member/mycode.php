<div class="content-inner" style="min-height: 626px;">
        <!--乐淘记录开始-->
        <div class="lead">乐淘码</div>
        <div class="record-box" style="margin-top: 20px">
            <span>乐淘码：</span>
            <input type="text" id="code" style="height: 30px;border: 1px solid #D2D2D2;padding:0 5px" name="code" value="" placeholder="乐淘码">
            <span style="margin-left: 15px">验证码：</span>
            <input id="captcha" maxlength="4" type="text" style="width: 80px;height: 30px;border: 1px solid #D2D2D2;padding: 0 5px" name="code" value="" placeholder="验证码">
            <img id="captcha_img" style="vertical-align: middle;margin-bottom: 2px;cursor: pointer;" src="<?php echo Uri::create('/captcha');?>" onclick="document.getElementById('captcha_img').src = '<?php echo Uri::create('captcha'); ?>?' + Math.random(); return false" title="看不清？点击更换"/>
            <button id="use_code" style="margin-left: 15px;width: 60px;height: 30px;border-radius: 3px;background: #af2812;color: #FFFFFF;cursor: pointer;">确定</button>
        </div>
    </div>
</div>
<script>
    $(function(){
         $('#use_code').click(function() {
             var code    = $('#code').val();
             var captcha = $('#captcha').val();

             if(code.length < 1 || captcha.length < 1) {
                alert('乐淘码或者验证码不能为空。');
                return false;
             }

             $.ajax({
                url: '<?php echo Uri::create('u/usecode');?>',
                data: {code: code, captcha: captcha},
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    if(data.code == 0) {
                        alert('恭喜您，使用成功。');
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
