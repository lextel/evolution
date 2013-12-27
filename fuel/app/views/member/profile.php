<br />
<script src="text/script">
$(function (){
   alert(1111);
}
</script>
<div class="set-wrap">
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
            <?php echo Form::open(['action' => 'u/profile', 'method' => 'post', 'class'=>'profile']); ?>
            <li>
                <label>邮箱：</label>
                <?php echo Form::input('email', Input::post('email', $member->email), array('class' => 'form-control', 'placeholder'=>'邮箱'));?>
                <span for="" class=""></span>
            </li>
            <li>
                <label>昵称：</label>
                <?php echo Form::input('nickname', Input::post('nickname', $member->nickname), array('class' => 'form-control', 'placeholder'=>'昵称'));?>
                <span for="" class="error"></span>
            </li>
            <li>
                <label>手机号码：</label>
                <?php echo Form::input('mobile', Input::post('mobile', $member->mobile), array('class' => 'form-control', 'placeholder'=>'手机号码'));?>
                <span for="" class="error"></span>
            </li>
            <li>
                <label class="align">个性签名：</label>
                <?php echo Form::textarea('bio', Input::post('bio', $member->bio), array('class' => 'form-control', 'placeholder'=>'个性签名'));?>
                <span for="" class="error align"></span>
            </li>
            <li>
                <a href="javascript:void(0);" class="btn btn-red profile">保存</a>
            </li>
            <?php echo Form::close(); ?>
        </ul>
</div>

