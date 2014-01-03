<?php echo Asset::css(['member/validfrom_style.css']); ?>
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
        <?php echo Form::open(['action' => 'u/passwd', 'method' => 'post', 'class'=>'form-password registerform']); ?>
        <ul class="edit-data">
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
                <input type="password" value="" name="oldpassword" class="inputxt" datatype="*6-20">
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <label>新密码：</label>
                <input type="password" value="" name="userpassword" class="inputxt" datatype="*6-20">
                <span class="Validform_checktip"></span>
                <div class="passwordStrength" style="display:none;">
                    <b>密码强度：</b>
                    <span class="bgStrength">弱</span>
                    <span>中</span>
                    <span class="last">强</span>
                </div>
            </li>
            <li>
                <label>确认新密码：</label>
               <input type="password" value="" name="userpassword2" class="inputxt" datatype="*6-20" recheck="userpassword">
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <input class="btn btn-red btn-password" type="submit" value="提交"/>
            </li>
        </ul>
         <?php echo Form::close(); ?>
</div>
<script type="text/javascript">

$(function(){
	//$(".registerform").Validform();  //就这一行代码！;
	var demo=$(".registerform").Validform({
		tiptype:3,
		label:".label",
		showAllError:true,
		datatype:{
			"zh1-6":/^[\u4E00-\u9FA5\uf900-\ufa2d]{1,6}$/
		},
		ajaxPost:true
	});
	demo.addRule([{
		ele:".inputxt:eq(0)",
		datatype:"*6-20"
	},
	{
		ele:".inputxt:eq(1)",
		datatype:"*6-20"
	},
	{
		ele:".inputxt:eq(2)",
		datatype:"*6-20",
		recheck:"userpassword"
	},
	{
		ele:"select",
		datatype:"*"
	},
	{
		ele:":radio:first",
		datatype:"*"
	},
	{
		ele:":checkbox:first",
		datatype:"*"
	}]);

})
</script>