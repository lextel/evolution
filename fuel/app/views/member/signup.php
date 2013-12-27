<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户注册</title>
    <?php echo Asset::css('common.css');?>
    <?php echo Asset::css('style.css');?>
    <?php echo Asset::js('jquery.min.js');?>
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
        <?php echo Form::open(array("class"=>"register-form")); ?>
            <ul>
                <li>
                   <?php echo Form::label('用户邮箱'); ?>
                   <?php echo Form::input('username', '', array('type'=>"text", 'placeholder'=>'用户邮箱')); ?>
                   <?php echo Form::label('', '', array('class'=>'error')); ?>
                </li>
                <li>
                   <?php echo Form::label('输入密码'); ?>
                   <?php echo Form::input('password', '', array('type'=>"password", 'placeholder'=>'输入密码')); ?>
                   <?php echo Form::label('', '', array('class'=>'error')); ?>
                </li>
                <li>
                   <?php echo Form::label('确认密码'); ?>
                   <?php echo Form::input('password', '', array('type'=>"password", 'placeholder'=>'确认密码')); ?>
                   <?php echo Form::label('', '', array('class'=>'error')); ?>
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
</body>
</html>
