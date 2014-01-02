<?php echo Asset::css(['member/validfrom demo.css','member/validfrom style.css']); ?>
<?php echo Asset::js('Validform_v5.3.2_min.js'); ?>

<br />
<script type="text/javascript">
$(function(){
    $(".btn-password").click(function(){
        $(".form-password").submit();
    });
});
</script>
<div class="set-wrap">
        <div class="navbar-inner">
            <ul>
                <li><?php echo Html::anchor('u/getprofile', '个人资料'); ?></li>
                <li><?php echo Html::anchor('u/getavatar', '更换头像'); ?></li>
                <li><?php echo Html::anchor('u/address', '收货地址'); ?></li>
                <li class="active"><?php echo Html::anchor('u/passwd', '修改密码'); ?></li>
            </ul>
        </div>
        <!--修改密码-->
        <ul class="edit-data">
            <?php echo Form::open(['action' => 'u/passwd', 'method' => 'post', 'class'=>'form-password']); ?>
            <li>
            <?php if (Session::get_flash('success')): ?>
                 <?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
            <?php endif; ?>
            <?php if (Session::get_flash('error')): ?>
                 <?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
            <?php endif; ?>
            </li>
            <li>
                <label>原密码：</label>
                <input name="oldpassword" type="password" class="form-control" placeholder="原密码" datatype="s6-18"/>
                <span for="" class=""></span>
            </li>
            <li>
                <label>新密码：</label>
                <input name="newpassword" type="password" class="form-control" placeholder="新密码"/>
                <span for="" class=""></span>
            </li>
            <li>
                <label>确认新密码：</label>
                <input name="newpassword2" type="password" class="form-control" placeholder="确认新密码"/>
                <span for="" class=""></span>
            </li>
            <li>
                <a href="javascript:void(0);" class="btn btn-red btn-password">保存</a>
            </li>
            <?php echo Form::close(); ?>
        </ul>
</div>

<script type="text/javascript">
$(function(){
    //$(".registerform").Validform();  //就这一行代码！;
        
    $(".form-password").Validform({
        tiptype:2
    });
})
</script>