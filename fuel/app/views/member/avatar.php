<?php
echo Asset::js(
        [
            //'jquery.validate.js',
            //'additional-methods.min.js',
            'jquery.ui.widget.js',
            'jquery.iframe-transport.js',
            'jquery.fileupload.js',
            'swfobject.js',
            //'ueditor/ueditor.config.js',
            //'ueditor/ueditor.all.min.js',
            //'ueditor/lang/zh-cn/zh-cn.js',
            //'admin/items/form.js',
            ]
        );
?>
<script type="text/javascript">
$(function(){
    UPLOAD_URL = "<?php echo Uri::create('u/avatar/upload'); ?>";
    IMAGE_URL  = "<?php echo Uri::create('/'); ?>";

    var flashvars = {
      "jsfunc":"upload",
      "imgUrl":"<?php echo Uri::create($member->avatar);?>",
      //"pid":"",
      "uploadSrc":true,
      "showBrow":true, //关闭上传按钮
      "showCame":false, //关闭摄像头
      "uploadUrl":"<?php echo Uri::create('u/avatar/upload');?>",
      "pSize":"250|250|160|160|60|60"// 这里可以改尺寸
    };

    var params = {
      menu: "false",
      scale: "noScale",
      allowFullscreen: "true",
      allowScriptAccess: "always",
      wmode:"transparent",
      bgcolor: "#FFFFFF"
    };

    var attributes = {
      id:"FaustCplus"
    };

    swfobject.embedSWF("<?php echo Uri::create('assets/images/FaustCplus.swf')?>", "avatar", "650", "360", "9.0.0", "<?php echo Uri::create('assets/images/expressInstall.swf')?>", flashvars, params, attributes);


});

function upload(status){
     status += '';
     switch(status){

        case '1': //上传完后的操作。
            alert('上传成功!');
        break;
        case '2': //这里是js调用提示参数,如果不需要提示，直接 return 1即可
            return 1;
        break;
        case '-1':
            alert('请上传指定类型图片!');
            window.location.href = "#";
        break;
        case '-2':
            alert('上传失败!');
            window.location.href = "#";
        break;
        default:
            alert(typeof(status) + ' ' + status);
    } 
}
</script>
<div class="set-wrap">
        <div class="lead">个人设置</div>
        <div class="navbar-inner">
            <ul>
                <li><?php echo Html::anchor('u/getprofile', '个人资料'); ?></li>
                <li class="active"><?php echo Html::anchor('u/getavatar', '更换头像'); ?></li>
                <li><?php echo Html::anchor('u/address', '收货地址'); ?></li>
                <li><?php echo Html::anchor('u/passwd', '修改密码'); ?></li>
            </ul>
        </div>
        <!--修改资头像-->
        <div class="portWarp">
            <div id="avatar"></div>
            <div class="savePre">
                <input type="button" class="btn btn-red btn-md" onclick="swfobject.getObjectById('FaustCplus').jscall_updateAvatar();" value="保存">
            </div>
        </div>
</div>
