<ol class="breadcrumb">
    <li><a href="">首页</a></li>
    <li><a href="">用户中心</a></li>
    <li class="active"><a href="">资料修改</a></li>
</ol>
<form action="/u/profile" role="form" class="form-horizontal" method="POST">
    <div class="form-group">
        <label for="" class="col-md-2 control-label">昵称：</label>
        <div class="col-md-4">
            <input name="nickname" type="text" class="form-control" placeholder=""/ value="">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label col-md-2">性别：</label>
        <div class="col-md-2">
            <label for="" class="radio-inline">
                <input type="radio" name="gender" value="男"/>男
            </label>
            <label for="" class="radio-inline">
                <input type="radio" name="gender" value="女"/>女
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-md-2 control-label">生日：</label>
        <div class="col-md-4">
            <input name="birth" type="text" class="form-control" placeholder=""/>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-md-2 control-label">星座：</label>
        <div class="col-md-4">
            <input name="horoscope" type="text" class="form-control" placeholder=""/>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-md-2 control-label">现居住地：</label>
        <div class="col-md-4">
            <input name="local" type="text" class="form-control" placeholder=""/>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label col-md-2">家乡：</label>
        <div class="col-md-4">
            <input name="address" type="text" class="form-control" placeholder=""/>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label col-md-2">QQ：</label>
        <div class="col-md-4">
            <input name="" type="text" class="form-control" placeholder=""/>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-md-2 control-label">签名：</label>
        <div class="col-md-4">
            <textarea name="bio" type="text" class="form-control" placeholder=""></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-4 col-md-offset-2">
            <button type="submit" class="btn btn-primary">保存</button>
            <button type="button" class="btn btn-default">取消</button>
        </div>
    </div>
</form>
