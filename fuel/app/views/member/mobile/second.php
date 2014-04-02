<!--右左边内容结束-->
<div class="verify-wrap">
    <div class="tit-bar">
        <h4>手机验证</h4>
         <?php echo Html::anchor('u/mobile/first', '<< 返回', ['class'=>'more fr']);?>
    </div>
    <div class="prompt-bar">
        <s class="icon-plaint"></s>
        请完成手机验证，验证手机不仅能加强账户安全，快速找回密码，还会在您成功云购到商品后及时通知您！
    </div>
    <form action="" class="verifyForm">
        <div class="row">
            <label for="" class="fl">您的手机号码：</label>
            <span class="phone_num"><?php echo $mobile?></span>
        </div>
        <div class="row">
            <input class="btn btn-code" type="button" value="获取验证码" />
            <span class="verification sure">验证码已发送请查收！</span>
        </div>
        <div class="row">
            <label for="" class="fl">输入验证码：</label><input type="text" class="txt fl"/>
            <span class="verification sure fl">手机号码格式为11位数字！</span>
        </div>
        <div class="row">
            <a href="" class="btn btn-red btn-sx">提交</a>
        </div>
    </form>
</div>
