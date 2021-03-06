<?php echo Asset::css(['style.css']); ?>
<?php echo Asset::js(['jquery.validate.js','additional-methods.min.js']); ?>
<script type="text/javascript">
$(function(){
    $(".nickname").click(function(){
        $(".addnickname").submit();
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
        <ul class="succeedForm" style="width:630px">
            <li><h2>恭喜你成为乐淘会员，输入您的昵称马上开始乐淘！</h2><li/>
            <li>
                <label style="text-align:right">昵称：</label>
                <?php echo Form::input('nickname', Session::get_flash('nickname', ''), array('class' => 'txt','type'=>"text",'name'=>'nickname','style'=>'width:180px')); ?>
                <?php if (Session::get_flash('error', null)) { ?>
                   <span class="error"><?php echo Session::get_flash('error');?></span>
                <?php }else{?>
                   
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

  jQuery.validator.addMethod("validatenickname", function(gets,element) {
         var zhE = /^[\u4e00-\u9fa5a-zA-Z0-9]+$/;
                var zh = /[^\x00-\xff]/ig;
                var E =/[A-Za-z0-9]/;
                if(zhE.test(gets)){
                  //如果为中文
                  if(zh.test(gets)){
                     if(gets.length >= 2 && gets.length <= 8){
                       return true;
                     }
                     return false;//"请输入2-8个中文字符";
                  }
                  //如果为英文
                  if(E.test(gets)){
                     if(gets.length >= 3 && gets.length <= 8){
                       return true;
                     }
                     return false;//"请输入3-8个英文字符";
                  }
                }
                return false;//"昵称只能为中文，数字，字母";
   }, "error");

  $(".addnickname").validate({
      rules:{
            nickname:{
                required:true,
                validatenickname:true,
                remote:{
                 url:"<?php echo Uri::create('/u/checknickname');?>",  
                 type:"post",  
                 dataType:"json",
                 data:{ 'param':function(){return $("#form_nickname").val();}}
              }
            }
        },
        messages:{
            nickname:{
                required:"请输入昵称",
                validatenickname:"请输入2-8个中文或3-8个英文",
                remote:"已存在"
            }
        }
      });
})
</script>
