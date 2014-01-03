<?php echo Asset::css(['common.css', 'style.css']); ?>
<?php echo Asset::css('member/validfrom_style.css'); ?>
<?php echo Asset::js('Validform_v5.3.2_min.js'); ?>
<script type="text/javascript">
$(function(){
    $(".btn-nickname").click(function(){
        $(".addnickname").submit();
    });
});
</script>
<br />
<div class="register w">
    <div class="title">
        <h4 class="fl">新用户注册</h4>
        <ul class="fl">
            <li><a href="">1填写注册信息</a></li>
            <li><a href="">2填写注册信息</a></li>
            <li><a href=""></a></li>
        </ul>
    </div>
    <div class="content">
        <h2><span class="icon-prompt"></span>恭喜你成为乐拍会员，现在输入昵称开始乐拍吧</h2>
        <form action="/u/nickname" method="POST" class="addnickname">
        <ul class="edit-data">
            <li>
                <label>输入你的昵称：</label>
                <input type="text" name="nickname" placeholder="输入你的昵称" />
                <span for="" class=""></span>
            </li>
            <li>
                <a href="javascript:void(0);" class="btn btn-red btn-nickname">确定并连接到首页</a>
            </li>
        </ul>
        </form>
    </div>
</div>
