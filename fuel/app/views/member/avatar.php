<br />
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
            <li>
                <button class="btn">上传头像</button>
            </li>
            <li>
                <div class="upload-photo">
                    <img src="" alt=""/>
                </div>
            </li>
            <li>
                <a href="javascript:void(0);" class="btn btn-red">保存头像</a>
            </li>
        </ul>
</div>
