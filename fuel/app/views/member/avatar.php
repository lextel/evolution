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
    $(".btn-avatarUpload").click(function(){
        $(".form-avatarUpload").submit();
    });

    $('#avatarUpload').fileupload({
        url: UPLOAD_URL,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#newavatar').attr('src', IMAGE_URL+file.link);
                $('#avatar').val(file.link);
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    var flashvars = {
      "jsfunc":"uploadevent",
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

    swfobject.embedSWF("<?php echo Uri::create('assets/images/FaustCplus.swf')?>", "avatar", "650", "360", "9.0.0", "expressInstall.swf", flashvars, params, attributes);



});
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
            <div id="avatar">
            </div>
            <div class="savePre">
                <input type="button" class="btn btn-red btn-md" onclick="swfobject.getObjectById('FaustCplus').jscall_updateAvatar();" value="保存">
            </div>
            <div id="avatar_priview"></div>
        </div>
        <!--
        <ul class="edit-data">
            <?php echo Form::open(['action' => 'u/avatar', 'method' => 'post', 'class'=>'form-avatarUpload']); ?>
            <li>
            <?php if (Session::get_flash('success')): ?>
                 <?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
            <?php endif; ?>
            <?php if (Session::get_flash('error')): ?>
                 <?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
            <?php endif; ?>
            </li>
            <li>
                <div class="file-img">
                    <input id="avatarUpload" type="file" name="avatar" multiple>
                </div>
            </li>
            <li>
                <div class="upload-photo">
                    <?php echo Html::img($member->avatar, ['id'=>'newavatar']); ?>
                </div>
            </li>
            <li>
                <input type="hidden" value="" name="avatar" id="avatar">
            </li>
            <li>
                 <button class="btn btn-red btn-md" type="submit">保存</button>
            </li>
            <?php echo Form::close(); ?>
        </ul>
        -->
</div>
