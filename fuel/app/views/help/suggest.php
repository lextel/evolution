<?php echo Asset::js(['jquery.validate.js','additional-methods.min.js']); ?>
<div class="help-main fr">
    <h2>投诉与建议</h2>
    <div class="help-content">
        <p>乐淘很高兴您能提供更好的建议与意见使我们不断完善与进步，我们收到您的意见与建议以后会尽快回复您，并根据建议与意见的可执行程度为您赠送礼品。
            你可以通过以下方式为我们提出意见和建议：</p>

        <?php $input = Session::get_flash('input', null);?>

        <?php echo Form::open(["action"=>"/ha/addsuggest",'id'=>'suggestfrom']);?>

        <ul class="edit-data">
            <?php if (Session::get_flash("error", null)) { ?>
                <p style="color:#e00"><?php echo Session::get_flash("error");?></p>
            <?php } ?>
            <?php if (Session::get_flash("info", null)) { ?>
                <li>
                    <label></label>
                    <p style="color:green"><?php echo Session::get_flash("info");?></p>
                </li>
            <?php } ?>
            <li>
                <label>主题：</label>

                <?php echo Form::select('type', isset($input) ? $input['type']: null,
                    ['投诉建议' => '投诉建议', '商品配送'=>'商品配送', '售后服务'=>'售后服务'],
                    ['class'=>'choose']);?>
            </li>
            <li>
                <label>昵称1：</label>
                <?php echo Form::input('nickname', isset($input) ? $input['nickname']: '', ['type'=>'text', 'class'=>'txt']);?>
            </li>
            <li>
                <label>电话：</label>
                <?php echo Form::input('mobile', isset($input) ? $input['mobile']: '', ['type'=>'text', 'class'=>'txt']);?>
            </li>
            <li>
                <label><font color="#f00">*</font>E-mail：</label>
                <?php echo Form::input('email', isset($input) ? $input['email']: '', ['type'=>'text', 'class'=>'txt']);?>
            </li>
            <li>
                <label><font color="#f00">*</font>反馈内容：</label>
                <?php echo Form::textarea('text', isset($input) ? $input['text']: '', ['cols'=>'60', 'rows'=>'5', 'class'=>'txt']);?>

            </li>
            <li id="contentError" style="height:25px;margin-top:-12px;">
                <label for=""></label>
            </li>
            <li>
                <label><font color="#f00">*</font>验证码：</label>
                <input id="captcha" name="captcha" type="text" class="txt" />
                <span class="captcha"><img src=""/></span>
                <span class="recaptcha"><a href="javascript:void(0)">看不清？换一张</a></span>

            </li>
            <li>
                <button id="sub" class="btn btn-red btn-md" style="margin-left:150px">提交信息</button>
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

    $("#suggestfrom").validate({
        rules :{
            email:{
                required:true,
                email:true
            },
            text:{
                required: true
            },
            captcha:{
                required: true,
                rangelength: [4, 4],
                remote:{
                 url:"<?php echo Uri::create('/index/ajaxcaptcha');?>",
                 type:"post",
                 dataType:"json",
                 data:{ 'param':function(){return $("#captcha").val();}}
                }
            }
        },
        messages:{
            email:{
                required: "请输入E-mail",
                email:"请输入正确的E-mail"
            },
            text:{
                required: "请输入反馈内容"
            },
            captcha:{
                required: "请输入验证码",
                rangelength: "验证码长度必须为4位",
                remote:"验证码错误"
            }
        },
        errorPlacement: function(error, element) {
            if(element[0].id=="form_text"){
                $("#contentError").append(error);
            }else{
                error.appendTo(element.parent());
            }
        }
    });
});
</script>

