<div class="w">
<?php echo Asset::css(['style.css']);?>
<!--中间内容开始-->
    <div class="register-warp">
            <div class="title">
                <h3 class="fl">设置密码成功。</h3>
            </div>
            <form class="demoform">            
                <ul class="registerForm">
                    <li>
                       <p>你的密码设置成功</p>
                       <p><a href="<?php echo Uri::create('/');?>">返回首页</a></p>
                       <p>将在<s class="time1">5</s>秒后自动跳转到首页</p>
                    </li>
                    <li>
                    </li>
                </ul>
            </form>
            <div class="help-tool">
                 
             </div>
    </div>
<!--中间内容结束-->
</div>
<script type="text/javascript">

$(function(){
    var curCount = 5;
    function countingDown(){
        if (curCount == 0) {
            window.location.href = '<?php echo Uri::create('/');?>';
        }
        else {
            curCount--;
            $(".time1").html(curCount);
        }
    };
    InterValObj = window.setInterval(countingDown, 1000);
})
</script>
