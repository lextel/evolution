<?php echo Asset::css(['style.css', 'member/validfrom_style.css']); ?>
<?php echo Asset::js('Validform_v5.3.2_min.js'); ?>
<script type="text/javascript">
$(function(){
    $(".nickname").click(function(){
        $(".addnickname").submit();
    });
	$(".addnickname").Validform({
	tiptype:4,
	});
});
</script>
<div class="register-warp">
    <div class="title">
          <h3 class="fl">新用户注册</h3>
              <ul class="fl crumbs">
                  <li><s>1</s><a href="javascript:;">填写注册信息</a></li>
                  <li><b>></b><li>
                  <li class="active"><s>2</s><a href="javascript:;">完成注册</a></li>
                  <li><a href="javascript:;"></a></li>
              </ul>
              <div class="link fr">
                   <?php echo Html::anchor('invit', '邀请好友赢元宝', array('class' => 'btn btn-red b', 'style' => 'margin-right: 10px; padding:5px 10px'));?>
                        已经是会员，直接
                   <?php echo Html::anchor('signin', '登录', array('class' => 'blue'));?>
              </div>
    </div>
        <form action="/u/nickname" class="addnickname" method="POST">
        <ul class="succeedForm">
            <li><h2>恭喜你成为乐淘会员，输入您的昵称马上开始乐淘！</h2><li/>
            <li>
                <label>昵称：</label>
                <?php echo Form::input('nickname', Session::get_flash('nickname', ''), array('class' => 'txt','type'=>"text",'name'=>'nickname', 'datatype'=>'zhE',
                 'nullmsg'=>'请输入昵称' ,'errormsg'=>' ' ,'sucmsg'=>' ' ,'ajaxurl' => Uri::create('/u/checknickname')  ,'style'=>'width:180px')); ?>
                <?php if (Session::get_flash('error', null)) { ?>
                   <span class="Validform_checktip Validform_wrong"><?php echo Session::get_flash('error');?></span>
                <?php }else{?>
                   <span class="Validform_checktip"></span>
                <?php } ?>
            </li>
            <li>
                <a href="javascript:void(0);" class="btn btn-red btn-md nickname">开始乐淘</a>
            </li>
        </ul>
        </form>
</div>

<script>
$(function (){
  //,'ajaxurl' => Uri::create('/uchecknickname') 
  $(".addnickname").Validform({
        tiptype:4,
        ajaxPost:true,
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
})
</script>
