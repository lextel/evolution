<ol class="breadcrumb">
    <li><a href="">首页</a></li>
    <li><a href="">用户中心</a></li>
    <li class="active"><a href="">资料修改</a></li>
</ol>
<form action="/u/profile" role="form" class="form-horizontal" method="POST">
    <div class="form-group">
        <label for="" class="col-md-2 control-label">昵称：</label>
        <div class="col-md-4">
            <?php echo Form::input('nickname', Input::post('nickname', $member->nickname), array('class' => 'form-control', 'placeholder'=>'用户昵称'));?>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label col-md-2">性别：</label>
         
        <div class="col-md-2">
            <?php echo Form::label('男', 'gender');?>
            <?php echo Form::radio('gender', '男', $member->gender === '男'? true : false);?>
            <?php echo Form::label('女', 'gender');?>
            <?php echo Form::radio('gender', '女', $member->gender === '女'? true : false);?>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-md-2 control-label">生日：</label>
        <div class="col-md-4">
            <?php echo Form::input('birth', Input::post('birth', $member->birth), array('class' => 'form-control', 'placeholder'=>'生日'));?>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-md-2 control-label">星座：</label>
        <div class="col-md-4">
            <?php echo Form::input('horoscope', Input::post('horoscope', $member->horoscope), array('class' => 'form-control', 'placeholder'=>'星座'));?>           
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-md-2 control-label">现居住地：</label>
        <div class="col-md-4">
            <?php echo Form::input('local', Input::post('local', $member->local), array('class' => 'form-control', 'placeholder'=>'现居住地'));?>           
        </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label col-md-2">家乡：</label>
        <div class="col-md-4">
            <?php echo Form::input('address', Input::post('address', $member->address), array('class' => 'form-control', 'placeholder'=>'家乡'));?>           
        </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label col-md-2">QQ：</label>
        <div class="col-md-4">
            <?php echo Form::input('qq', Input::post('qq', $member->qq), array('class' => 'form-control', 'placeholder'=>'QQ'));?>     
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-md-2 control-label">签名：</label>
        <div class="col-md-4">
            <?php echo Form::textarea('bio', Input::post('bio', ''), array('class' => 'form-control', 'placeholder'=>'签名'));?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-4 col-md-offset-2">
            <button type="submit" class="btn btn-primary">保存</button>
            <button type="button" class="btn btn-default">取消</button>
        </div>
    </div>
</form>
