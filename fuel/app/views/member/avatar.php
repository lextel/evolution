<br />

<?php

echo Asset::css(
    [
        'jquery.fileupload.css', 
        'admin/items/form.css', 
        ]
    );
echo Asset::js(
        [
            //'jquery.validate.js', 
            //'additional-methods.min.js',
            'jquery.ui.widget.js',
            'jquery.iframe-transport.js',
            'jquery.fileupload.js',
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
                console.log(file.link);
                $('#newavatar').attr('src', IMAGE_URL+file.link);
                $('#avatar').val(file.link);
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    
});
</script>
<div class="set-wrap">
        <div class="navbar-inner">
            <ul>
                <li><?php echo Html::anchor('u/getprofile', '个人资料'); ?></li>
                <li class="active"><?php echo Html::anchor('u/getavatar', '更换头像'); ?></li>
                <li><?php echo Html::anchor('u/address', '收货地址'); ?></li>
                <li><?php echo Html::anchor('u/passwd', '修改密码'); ?></li>
            </ul>
        </div>
        <!--修改资头像-->
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
                 <input class="btn btn-red btn-password" type="submit" value="保存">
            </li>
            <?php echo Form::close(); ?>
        </ul>
</div>
