<br />
<div class="set-wrap">
        <div class="navbar-inner">
            <ul>
                <li><?php echo Html::anchor('u/getprofile', '个人资料'); ?></li>
                <li><?php echo Html::anchor('u/getavatar', '更换头像'); ?></li>
                <li><?php echo Html::anchor('u/address', '收货地址'); ?></li>
                <li class="active"><?php echo Html::anchor('u/passwd', '修改密码'); ?></li>
            </ul>
        </div>
        <!--修改密码-->
        <ul class="edit-data">
            <li>
                <label>原密码：</label>
                <input name="oldpassword" type="password" class="form-control" placeholder="原密码"/>
                <span for="" class=""></span>
            </li>
            <li>
                <label>新密码：</label>
                <input name="newpassword" type="password" class="form-control" placeholder="新密码"/>
                <span for="" class=""></span>
            </li>
            <li>
                <label>确认新密码：</label>
                <input name="newpassword2" type="password" class="form-control" placeholder="确认新密码"/>
                <span for="" class=""></span>
            </li>
            <li>
                <a href="javascript:void(0);" class="btn btn-red">保存</a>
                <!--<button type="button" class="btn btn-red">保存</button>
                <button type="button" class="btn btn-default">取消</button>-->
            </li>
        </ul>
</div>
