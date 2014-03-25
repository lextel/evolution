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
        <?php echo Form::open(['action' => 'u/passwd', 'method' => 'post', 'class'=>'form-password validForm']); ?>
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
                <input id="oldpassword" type="password" value="" class="txt" name="oldpassword" class="inputxt" datatype="*6-20" nullmsg="请输入旧密码" errormsg="请输入正确的旧密码" sucmsg=" "/>
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <label>新密码：</label>
                <input type="password" value="" class="txt" name="newpassword" class="inputxt" datatype="*6-20" nullmsg="请输入新密码" errormsg="请输入6-20位新密码" sucmsg=" "/>
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <label>确认密码：</label>
               <input type="password" value="" class="txt" name="newpassword2" class="inputxt"  datatype="*" recheck="newpassword" nullmsg="请输入确认密码" errormsg="两次密码输入不一致" sucmsg=" ">
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

	$(".validForm").Validform({
		tiptype:4,
        datatype:{
            "oldpassword": $(this).keyup(function (gets,obj,curform,regxp){
                var oldpassword = $("#oldpassword").val();
                //alert(1);
                //var reg=/^[\w.]{6,20}$/;
                //if(reg.test(oldpassword)|| reg.test(oldpassword)){
                if(oldpassword.length<6|| oldpassword.length>20){
                    //alert(1);
                    //return false;
                }
                //return true;
            })
            
            //function(gets,obj,curform,regxp){
            //参数gets是获取到的表单元素值，obj为当前表单元素，curform为当前验证的表单，regxp为内置的一些正则表达式的引用;           
 
            //}
        }
	});
});
</script>