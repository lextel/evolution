<?php echo Asset::css(['style.css', 'member/validfrom_style.css']); ?>
<?php echo Asset::js('Validform_v5.3.2_min.js'); ?>
<script type="text/javascript">
$(function(){
    $(".btn-nickname").click(function(){
        $(".addnickname").submit();
    });

	$(".addnickname").Validform({
	tiptype:4,
	});
});
</script>
<br />
<div class="register w">
    <div class="title">
          <h3 class="fl">新用户注册</h3>
                    <ul class="fl crumbs">
                        <li><s>1</s><a href="javascript:;">填写注册信息</a></li>
                        <li><b>></b><li>
                        <li class="active"><s>2</s><a href="javascript:;">完成注册</a></li>
                        <li><a href="javascript:;"></a></li>
                    </ul>
                    <div class="link fr">
                        已经是会员，直接
                        <?php echo Html::anchor('signin', '登录', array('class' => 'blue'));?>
                    </div>
    </div>
    <div class="register-wrap">
        <h2><span class="icon-prompt"></span>恭喜你成为乐拍会员，现在输入昵称就可以立刻开始乐拍了</h2>
        <form action="/u/nickname" method="POST" class="addnickname">
        <ul class="edit-data">
            <li>
                <label>输入你的昵称：</label>
                <?php echo Form::input('nickname', Session::get_flash('nickname', ''), array('type'=>"text",'name'=>'nickname', 'datatype'=>'*3-8', 'errormsg'=>'请输入3-8个字符','placeholder'=>'输入昵称')); ?>
                <?php if (Session::get_flash('error', null)) { ?>
                   <span class="Validform_checktip Validform_wrong"><?php echo Session::get_flash('error');?></span>
                <?php }else{?>
                   <span class="Validform_checktip">请输入3-8个字符</span>
                <?php } ?>
            </li>
            <li>
                <a href="javascript:void(0);" class="btn btn-red btn-nickname">确定</a>
            </li>
        </ul>
        </form>
    </div>
</div>
