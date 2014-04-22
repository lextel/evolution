<?php echo Asset::js(['jquery.validate.js','additional-methods.min.js']); ?>

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
                <input id="oldpassword" type="password" value="" class="txt" name="oldpassword" class="inputxt" />
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <label>新密码：</label>
                <input type="password" value="" class="txt" id="newpassword" name="newpassword" class="inputxt" />
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <label>确认密码：</label>
               <input type="password" value="" class="txt" name="newpassword2" class="inputxt" />
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
    $(".validForm").validate({
        rules:{
            oldpassword:{
                required:true,
                rangelength:[6,18]
            },
            newpassword:{
                required:true,
                rangelength:[6,18],
            },
            newpassword2:{
                required:true,
                equalTo:"#newpassword"
            }
        },
        messages:{
            oldpassword:{
                required:"请输入旧密码",
                rangelength:"请输入正确的旧密码"
            },
            newpassword:{
                required:"请输入新密码",
                rangelength:"请输入6-18位新密码",  
            },
            newpassword2:{
                required:"请输入确认密码",
                equalTo:"两次密码输入不一致"
            }
        }
    });
});
</script>