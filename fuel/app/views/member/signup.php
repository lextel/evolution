
    <?php echo Asset::css('style.css');?>
    <?php echo Asset::css('member/validfrom_style.css'); ?>
    <?php echo Asset::js('Validform_v5.3.2_min.js'); ?>
    <div class="register w">
        <div class="title">
            <h3 class="fl">新用户注册</h3>
            <ul class="fl crumbs">
                <li class="active"><s>1</s><a href="javascript:;">填写注册信息</a></li>
                <li><b>></b><li>
                <li><s>2</s><a href="javascript:;">完成注册</a></li>
                <li><a href="javascript:;"></a></li>
            </ul>
            <div class="link fr">
                已经是会员，直接
                <?php echo Html::anchor('signin', '登录', array('class' => 'blue'));?>
            </div>
        </div>

        <?php echo Form::open(array("class"=>"register-form demoform")); ?>
            <ul>
                <li>
                   <?php echo Form::label('用户邮箱'); ?>
                   <?php echo Form::input('username', Session::get_flash('username', ''), array('type'=>"text",'datatype'=>'e',
                         'name'=>'username','errorms'=>'邮箱帐号格式不正确','nullmsg'=>'请输入邮箱帐号')); ?>
                   <?php if (Session::get_flash('usernameError', null)) { ?>
                   <span class="Validform_checktip Validform_wrong"><?php echo Session::get_flash('usernameError');?></span>
                   <?php }else{?>
                   <span class="Validform_checktip"></span>
                   <?php } ?>
                </li>
                <li>
                   <?php echo Form::label('输入密码'); ?>
                   <?php echo Form::input('password', '', ['type'=>"password",'class' => 'inputxt Validform_error', 
                       'name'=>'userpassword','datatype'=>'*6-18','errorms'=>'请输入6-18位密码','nullmsg'=>'请输入6-18位密码']); ?>
                   <span class="Validform_checktip"></span>
                </li>
                <li>
                   <?php echo Form::label('确认密码'); ?>
                   <input type="password" value="" name="userpassword2" class="inputxt" datatype="*6-18" recheck="password">
                   <span class="Validform_checktip"></span>
                </li>
                <li>
                   <?php echo Form::submit('submit', '同意协议并注册', array('class' => 'btn btn-red')); ?>
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
