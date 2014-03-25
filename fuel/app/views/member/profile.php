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
            <?php echo Form::open(['action' => 'u/profile', 'method' => 'post', 'class'=>'form-profile validForm']); ?>
            <li>
            <?php if (Session::get_flash('success')): ?>
                 <?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
            <?php endif; ?>
            <?php if (Session::get_flash('error')): ?>
                 <?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
            <?php endif; ?>
            </li>
            <li>
                <label>*邮箱：</label>
                <span class="email"><?php echo $member->email;?></span>
                <?php if (!Model_Member_Email::check_emailok($member->email)) {  ?>
                <span class="red">（未验证）</span>
                <a href="javascript:;" class="btn-sm btn-state fl btn-checkemail">去验证</a>
                <?php }else{ ?>
                 <span class="green">（已验证）</span>
                <?php }?>
            </li>
            <li>
                 <label>*手机：</label>
                 <span class="red">（未绑定）</span>
                 <a href="javascript:;" class="btn-sm btn-state fl">去绑定</a>
             </li>
            <li>
                <label>*昵称：</label>
                <?php echo Form::input('nickname', Input::post('nickname', $member->nickname), array('class' => 'form-control txt','name'=>'username','datatype'=>'*2-8','errorms'=>'请输入昵称 2~8个字'));?>
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <label class="align">个性签名：</label>
                <?php echo Form::textarea('bio', Input::post('bio', $member->bio), array('class' => 'form-control txtarea','rows'=>'3'));?>
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <button class="btn btn-red btn-sx" type="submit" >提交</button>
            </li>
            <?php echo Form::close(); ?>
        </ul>
</div>
<script>
$(function(){
	$(".validForm").Validform({
	tiptype:4
	});
});
</script>
