<?php echo Asset::css(['member/validfrom_style.css']); ?>
<?php echo Asset::js('Validform_v5.3.2_min.js'); ?>

<div class="set-wrap">
        <div class="lead">个人设置</div>
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
            <?php if (Session::get_flash('info')): ?>
                 <?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
            <?php endif; ?>
            <?php if (Session::get_flash('info')): ?>
                 <font color="#f00" style="margin-left: 20%;display: block;"><?php echo implode('</p><p>', (array) Session::get_flash('info')); ?></font>
            <?php endif; ?>
            </li>
            <li>
                <label>旧密码：</label>
                <input type="password" value="" class="txt" name="oldpassword" class="inputxt" datatype="*6-20">
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <label>新密码：</label>
                <input type="password" value="" class="txt" name="newpassword" class="inputxt" datatype="*6-20">
                <span class="Validform_checktip"></span>
                <div class="passwordStrength" style="display:none;">
                    <b>密码强度：</b>
                    <span class="bgStrength">弱</span>
                    <span>中</span>
                    <span class="last">强</span>
                </div>
            </li>
            <li>
                <label>确认密码：</label>
               <input type="password" value="" class="txt" name="newpassword2" class="inputxt" datatype="*6-20" recheck="newpassword">
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <button class="btn btn-red btn-sx btn-password" type="submit">提交</button>
            </li>
        </ul>
         <?php echo Form::close(); ?>
</div>
<script type="text/javascript">

$(function(){
	//$(".registerform").Validform();  //就这一行代码！;
	var demo=$(".registerform").Validform({
		tiptype:4,
		label:".label",
		showAllError:true,
		datatype:{
			"zh1-6":/^[\u4E00-\u9FA5\uf900-\ufa2d]{1,6}$/
		},
		ajaxPost:false,
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
		recheck:"newpassword"
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
