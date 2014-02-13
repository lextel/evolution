<script type="text/javascript">
$(function(){
    $(".btn-profile").click(function(){
        $(".form-profile").submit();
    });
    $(".btn-checkemail").click(function(){
        $.get("/u/checkemail", '', function(data){          
            alert(data.msg);
        });
    });
});
</script>
<div class="set-wrap">
         <div class="lead">个人设置</div>
        <div class="navbar-inner">
            <ul>
                <li class="active"><?php echo Html::anchor('u/getprofile', '个人资料'); ?></li>
                <li><?php echo Html::anchor('u/getavatar', '更换头像'); ?></li>
                <li><?php echo Html::anchor('u/address', '收货地址'); ?></li>
                <li><?php echo Html::anchor('u/passwd', '修改密码'); ?></li>
            </ul>
        </div>
        <!--修改资料-->
        <ul class="edit-data">
            <?php echo Form::open(['action' => 'u/profile', 'method' => 'post', 'class'=>'form-profile demoform']); ?>
            <li>
            <?php if (Session::get_flash('success')): ?>
                 <?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
            <?php endif; ?>
            <?php if (Session::get_flash('error')): ?>
                 <?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
            <?php endif; ?>
            </li>
            <li>
                <label>邮箱：</label>
                <?php echo Form::input('username', Input::post('username', $member->email), array('type'=>"text",'name'=>'username',
                'datatype'=>'e','errorms'=>'请输入邮箱帐号', 'style'=>'border: 0;', 'readonly')); ?>
                <?php if (!Model_Member_Email::check_emailok($member->email)) {  ?>
                <a href="javascript:;" class="btn btn-red btn-sx  btn-checkemail" style="margin-left: 0px;margin-top: -5px;">验证</a>
                <?php }else{ ?>
                <a href="javascript:;" class="btn  btn-email" style="margin-left: 0px;margin-top: -5px;">已验证</a>
                <?php }?>
            </li>
            <li>
                <label>昵称：</label>
                <?php echo Form::input('nickname', Input::post('nickname', $member->nickname), array('class' => 'form-control','name'=>'username','datatype'=>'*2-8','errorms'=>'请输入昵称 2~8个字'));?>
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <label>手机号码：</label>
                <?php echo Form::input('mobile', Input::post('mobile', $member->mobile), array('class' => 'form-control','name'=>'','datatype'=>'m','errorms'=>'请输入手机号码'));?>
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <label class="align">个性签名：</label>
                <?php echo Form::textarea('bio', Input::post('bio', $member->bio), array('class' => 'form-control','rows'=>'3'));?>
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <button class="btn btn-red " type="submit" >提交</button>
            </li>
            <?php echo Form::close(); ?>
        </ul>
</div>
<script>
$(function(){
	$(".demoform").Validform({
	tiptype:4,
	});
});
</script>
