<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户注册</title>
    <?php echo Asset::css('common.css');?>
    <?php echo Asset::css('style.css');?>
    <?php echo Asset::js('jquery.min.js');?>
    <?php echo Asset::css('member/validfrom_style.css'); ?>
    <?php echo Asset::js('Validform_v5.3.2_min.js'); ?>

</head>
<body>
    <div class="register w">
        <div class="title">
            <h4 class="fl">新用户注册</h4>
            <ul class="fl">
                <li><a href="">1填写注册信息</a></li>
                <li><a href="">2填写注册信息</a></li>
                <li><a href=""></a></li>
            </ul>
            <div class="login fr">
                已经是会员，直接登录
                <?php echo Html::anchor('signin', '登录', array('class' => ''));?>
            </div>
        </div>
        <?php echo Form::open(array("class"=>"register-form demoform")); ?>
            <ul>
                <li>
                   <?php echo Form::label('用户邮箱'); ?>
                   <?php echo Form::input('username', '', array('type'=>"text",'datatype'=>'e','name'=>'username','errorms'=>'邮箱帐号格式不正确','nullmsg'=>'请输入邮箱帐号')); ?>
                   <span class="Validform_checktip"></span>
                </li>
                <li>
                   <?php echo Form::label('输入密码'); ?>
                   <?php echo Form::input('password', '', array('type'=>"password",'class' => 'inputxt Validform_error', 'name'=>'userpassword','datatype'=>'*6-18','errorms'=>'请输入6-18位密码','nullmsg'=>'请输入6-18位密码')); ?>
                   <span class="Validform_checktip"></span>
                </li>
                <li>
                   <?php echo Form::label('确认密码'); ?>
                   <input type="password" value="" name="userpassword2" class="inputxt" datatype="*6-20" recheck="password">
                   <span class="Validform_checktip"></span>
                </li>
                <li><!--<a href="" class="btn btn-default fl">同意协议并注册</a>-->
                   <?php echo Form::submit('submit', '同意协议并注册', array('class' => 'btn btn-default fl')); ?>
                </li>
            </ul>
        <?php echo Form::close(); ?>
        <div class="register-help">
            欢迎你访问并使用
        </div>
    </div>

<script type="text/javascript">
$(function(){
	$(".demoform").Validform({
	tiptype:4,
	});
});
</script>
</body>
</html>
