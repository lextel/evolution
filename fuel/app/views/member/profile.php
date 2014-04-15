<script type="text/javascript">
$(function(){
    $(".btn-profile").click(function(){
        $(".form-profile").submit();
    });
    $(".btn-checkemail").click(function(){
        //需要个加载的图
        $(".load").show();
        window.location = "/u/checkemail";
        $(".load").hide();
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
                <label></label>
                <?php if (Session::get_flash('success')): ?>
                    <p style="color:green;">
                    <?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
                    </p>
                <?php endif; ?>
                <?php if (Session::get_flash('error')): ?>
                    <p style="color:red;">
                    <?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
                    </p>
                <?php endif; ?>
            </li>
            <li>
                <label><s class="r">*</s>邮箱：</label>
                <span class="email" style="width: 150px;"><?php echo $member->email;?></span>
                <?php if (!Model_Member_Email::check_emailok($member->email)) {  ?>
                <span class="red">（未验证）</span>
                <span class="load" style="display:none"><?php echo Html::img('assets/images/bx_loader.gif', ['style'=>'width:30px']);?></span>
                <a href="javascript:;" class="btn-sm btn-state fl btn-checkemail">去验证</a>
                <?php }else{ ?>
                 <span style="color:green;">（已验证）</span>
                <?php }?>
            </li>
            <li>
                 <label><s class="r">*</s>手机：</label>
                 <span class="mobile" style="width: 150px;"><?php echo $member->mobile;?></span>
                 <span class="red"><?php echo $member->is_mobile == '1' ? '':'（未绑定）';?></span>
                 <?php if ($member->is_mobile != '1') { ?>
                    <a href="<?php echo Uri::create('u/mobile/first');?>" class="btn-sm btn-state fl">去绑定</a>
                 <?php }else{ ?>
                    <a href="<?php echo Uri::create('u/mobile/first');?>" class="btn-sm btn-state fl">绑定新手机</a>
                 <?php } ?>
             </li>
            <li>
                <label><s class="r">*</s>昵称：</label>
                <?php echo Form::input('nickname', Input::post('nickname', $member->nickname), array('class' => 'form-control txt','name'=>'username','datatype'=>'zhE','errorms'=>'请输入昵称 2~8个字','sucmsg'=>' '));?>
                
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
	var validForm = $(".validForm").Validform({
	  tiptype:4,
    datatype:{
        'zhE': function (gets,obj,curform,regxp){
                var zhE = /^[\u4e00-\u9fa5a-zA-Z0-9]+$/;
                var zh = /[^\x00-\xff]/ig;
                var E =/[A-Za-z0-9]/;
                if(zhE.test(gets)){
                  //如果为中文
                  if(zh.test(gets)){
                     if(gets.length >= 2 && gets.length <= 8){
                       return true;
                     }
                     return "请输入2-8个中文字符";
                  }
                  //如果为英文
                  if(E.test(gets)){
                     if(gets.length >= 3 && gets.length <= 8){
                       return true;
                     }
                     return "请输入3-8个英文字符";
                  }
                }
                return "昵称只能为中文，数字，字母";
              }
        }
	});

  var nickname = $("#form_nickname").val();

  $("#form_nickname").bind("change",function (){
      if(nickname == $(this).val()){
        $(this).attr("ajaxurl", "");
      }else{
        $(this).attr("ajaxurl", "<?php echo Uri::create('u/checknickname');?>");
      }
  });
  
});
</script>
