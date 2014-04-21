    <?php echo Asset::css('style.css');?>
    <?php echo Asset::js(['jquery.validate.js','additional-methods.min.js']); ?>
    <div class="register-warp">
        <div class="title">
            <h3 class="fl">新用户注册</h3>
            <ul class="fl crumbs">
                <li class="active"><s>1</s>填写注册信息</li>
                <li>&gt;</li>
                <li><s>2</s>完成注册</li>
            </ul>
            <div class="link fr">
                已经是会员，直接
                <?php echo Html::anchor('signin', '登录', array('class' => 'blue'));?>
            </div>
        </div>

        <?php echo Form::open(array("class"=>"registerForm")); ?>
            <ul class="">
                <li>
                   <?php echo Form::label('手机/邮箱'); ?> 
                   <?php echo Form::input('username', Session::get_flash('username', ''), array('class' => 'txt',
                   'id'=>'username', 'name'=>'username')); ?>
                   <?php if (Session::get_flash('usernameError', null)) { ?>
                   <span class="Validform_checktip"><?php echo Session::get_flash('usernameError');?></span>
                   <?php }else{?>
                   <?php } ?>
                </li>
                <li>
                   <?php echo Form::label('密码'); ?>
                   <?php echo Form::input('password', '', ['type'=>"password",'class' => 'txt',
                    'name'=>'userpassword']); ?>
                </li>
                <li>
                   <?php echo Form::label('确认密码'); ?>
                   <input id="xp" type="password"  name="password2" class="txt"/>
                   <span class="Validform_checktip"></span>
                </li>
                <li>
                   <?php echo Form::submit('submit', '同意协议并注册', array('class' => 'btn btn-md btn-red')); ?>
                </li>
            </ul>
        <?php echo Form::close(); ?>
        <div class="protocol">
            <b>服务协议</b><br/>
            欢迎您访问并使用充满互动乐趣的购物网站--乐乐淘，为用户提供全新、有趣购物模式.
            乐乐淘通过在线网站为您提供各项相关服务,当使用乐乐淘的各项具体服务时，您和 乐乐淘都将受到本服务协议所产生的制约.
            乐乐淘会不断推出新的服务,因此所有服务都将受此服务条款的制约.请您在注册前务必认真阅读此服务协议的内容并确认,如有任何疑问,
            应向乐乐淘咨询.一旦您确认本服务协议后,本服务协议即在用户和乐乐淘之间产生法律效力.
        </div>
    </div>
<script type="text/javascript">
$(function(){
  jQuery.validator.addMethod("codemobile", function(value,element) {
      var code = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
      var mobile = /^1[3,4,5,8][0-9]{9}$/
      if(code.test(value) || mobile.test(value))
        return true;
      return false;
    },"error zhanghao");

    $(".registerForm").validate({
      rules:{
            username:{
                required:true,
                codemobile:true,
                remote:{
                 url:"<?php echo Uri::create('checkname');?>",  
                 type:"post",  
                 dataType:"json",
                 data:{ 'param':function(){return $("#username").val();}}
                }
            },
            password:{
                required:true,
                rangelength:[6,18]
            },
            password2:{
              required:true,
              equalTo:"#form_password"
            }
        },
        messages:{
            username:{
                required:"请输入注册手机/邮箱",
                codemobile:"手机/邮箱格式不正确",
                remote:"已存在"
            },
            password:{
                required:"请输入密码",
                rangelength:"密码为6~18位数"
            },
            password2:{
              required:"请确认密码",
              equalTo:"两次密码输入不一致"
            }
        }
    });
});  
</script>
