    <?php echo Asset::css('member/validfrom_style.css'); ?>
    <?php echo Asset::js('Validform_v5.3.2_min.js'); ?>
<div class="help-main fr">
    <h2>投诉与建议</h2>
    <div class="help-content">
        <p>乐淘很高兴您能提供更好的建议与意见使我们不断完善与进步，我们收到您的意见与建议以后会尽快回复您，并根据建议与意见的可执行程度为您赠送礼品。
            你可以通过以下方式为我们提出意见和建议：</p>

        <?php $input = Session::get_flash('input', null);?>

        <?php echo Form::open(["action"=>"/ha/addsuggest"]);?>
        <ul class="edit-data">
            <?php if (Session::get_flash("error", null)) { ?>
                <p style="color:#e00"><?php echo Session::get_flash("error");?></p>
            <?php } ?>
            <?php if (Session::get_flash("info", null)) { ?>
                <li>
                    <label></label>
                    <p style="color:#e00"><?php echo Session::get_flash("info");?></p>
                </li>
            <?php } ?>
            <li>
                <label>主题：</label>

                <?php echo Form::select('type', isset($input) ? $input['type']: null,
                    ['投诉建议' => '投诉建议', '商品配送'=>'商品配送', '售后服务'=>'售后服务'],
                    ['class'=>'choose']);?>
            </li>
            <li>
                <label>昵称：</label>
                <?php echo Form::input('nickname', isset($input) ? $input['nickname']: '', ['type'=>'text', 'class'=>'txt']);?>
            </li>

            <li>
                <label>电话：</label>
                <?php echo Form::input('mobile', isset($input) ? $input['mobile']: '', ['type'=>'text', 'class'=>'txt']);?>
            </li>
            <li>
                <label><font color="#f00">*</font>E-mail：</label>
                <?php echo Form::input('email', isset($input) ? $input['email']: '', ['type'=>'text', 'class'=>'txt','nullmsg'=>'请输入E-mail','errormsg'=>'请输入正确到E-mail', 'datatype'=>'e','sucmsg'=>' ']);?>
            </li>
            <li>
                <label><font color="#f00">*</font>反馈内容：</label>
                <?php echo Form::textarea('text', isset($input) ? $input['text']: '', ['cols'=>'60', 'rows'=>'5', 'class'=>'txt', 'datatype'=>'*','nullmsg'=>'请输入反馈内容']);?>
            </li>
            <li>
                <label><font color="#f00">*</font>验证码：</label>
                <input name="captcha" type="cap-text" class="txt" datatype="*" nullmsg="请输入验证码" />
                <span class="captcha"><?php echo Html::img('');?></span>
                <span class="recaptcha"><a href="javascript:void(0)">看不清？换一张</a></span>
            </li>
            <li>
                <button id="sub" class="btn btn-red btn-md">提交信息</button>
            </li>
        </ul>
        <?php echo Form::close();?>
    </div>
</div>
<script>
function getcaptch(){
    $(".captcha img").attr('src', '<?php echo Uri::create("captcha");?>' + '?' + Math.random());
}
$(function(){
    getcaptch();
    $(".recaptcha").click(function(){
        getcaptch();
    });

    $(".edit-data").Validform({
        btnSubmit: "#sub",
        tiptype:4
    });
});
</script>

