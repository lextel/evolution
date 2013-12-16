
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <?php echo Asset::css('bootstrap.min.css');?>
    <?php echo Asset::css('member/comme.css');?>
    <?php echo Asset::css('member/font-awesome.min.css');?>
    <?php echo Asset::js(['jquery.min.js', 'bootstrap.min.js', 'common.js']);?>


    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
    <script type="text/javascript">

    </script>
</head>
<body>
<!--导航开始-->
<div class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="nav-header">
            <a class="navbar-brand" href="">logo</a>
            <a class="navbar-brand" href="">用户中心</a>
        </div>
        <div class="collapse navbar-collapse ">
            <ul class="nav navbar-nav">
                <li><a href="">首页</a></li>
                <li class="active"><a href="">我的主页</a></li>
                <li><a href="">晒单</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="">
                </div>
                <button type="submit" class="btn btn-danger">搜索</button>
            </form>
            <!--<ul class="nav navbar-nav navbar-right">
                <li>
                    <div class="navbar-text ">
                        <a href="" class="navbar-link">补刀专业户</a>
                        <a href="" class="navbar-link">[退出]</a>
                    </div>
                </li>
                <li><a href=""></a></li>
            </ul>
            -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <!--登录成功-->
                    <!---->
                    <div class="portrait-side">
                        <a href="" class="top-portrait"><img src="img/login_bg3.jpg/"/>火枪中路必胜</a>
                        <a href="/signout" class="navbar-link">[退出]</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="usercenter-edit.html" class="dropdown-toggle" data-toggle="dropdown">设置
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="">安全设置</a></li>
                        <li><a href="">修改头像</a></li>
                        <li><a href="">修改资料</a></li>
                        <li><a href="">收货地址</a></li>
                        <li><a href="">找回密码</a></li>
                    </ul>
                </li>
                <li><a href=""><i class="glyphicon glyphicon-envelope"></i></a></li>
                <li><a href=""><i class="glyphicon glyphicon-usd"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<!--导航结束-->
<!--中间内容开始-->
<div class="container">
    <div class="row">
        <div class="col-md-2 col-md-offset-1">
            <div class="user-title">
                <h3>用户中心</h3>
            </div>
            <div class="nav-menu">
                <dl>
                    <dt><i class="fa fa-cog"></i><a href="">个人资料</a></dt>
                    <dd class="active"><a href="">基本资料</a></dd>
                    <dd><a href="javascript:void(0);">修改头像</a></dd>
                    <dd><a href="">密码修改</a></dd>
                    <dd><a href="">收货地址</a></dd>
                    <dd><a href="">好友管理</a></dd>
                </dl>
                <dl>
                    <dt><i class="fa fa-credit-card"></i><a href="">其他</a></dt>
                    <dd><a href="">购买记录</a></dd>
                    <dd><a href="">中奖记录</a></dd>
                    <dd><a href="">晒单</a></dd>
                    <dd><a href="">充值</a></dd>
                </dl>
            </div>
           
        </div>
        <div class="col-md-9" role="main">
            <div class="panel panel-default main">
                <!--基本资料-->
                <div class="panel-body">
                    <ol class="breadcrumb">
                        <li><a href="">首页</a></li>
                        <li><a href="">用户中心</a></li>
                        <li class="active"><a href="">资料修改</a></li>
                    </ol>
                    <form action="" role="form" class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-md-2 control-label">昵称：</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-2">职业：</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-2">性别：</label>
                            <div class="col-md-2">
                                <label for="" class="radio-inline">
                                    <input type="radio" name="gender" value=""/>男
                                </label>
                                <label for="" class="radio-inline">
                                    <input type="radio" name="gender" value=""/>女
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4 col-md-offset-2">
                                <button type="button" class="btn btn-primary">保存</button>
                                <button type="button" class="btn btn-default">取消</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--修改头像-->
                <div class="panel-body d_n">
                    <form action="" role="form" class="form-horizontal">
                        <div class="form-group">
                            <div for="" class="col-md-5 control-label">
                                <a href="#" class="thumbnail">
                                    <img data-src="holder.js/100%x180" alt="...">
                                </a>
                            </div>
                            <div class="col-md-2">
                                <input type="button" class="form-control" value="选择图片"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4 col-md-offset-1">
                                <button type="button" class="btn btn-primary">确定</button>
                                <button type="button" class="btn btn-default">取消</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--安全设置-->
                <div class="panel-body d_n">
                    <form action="" role="form" class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-md-2 control-label">密码</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-2">确认密码</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4 col-md-offset-2">
                                <button type="button" class="btn btn-primary">确定</button>
                                <button type="button" class="btn btn-default">取消</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--收货地址-->
                <div class="panel-body d_n">
                    <form action="" role="form" class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-md-2 control-label">当前地址</label>
                            <div class="col-md-6">
                                <textarea rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-2">新地址</label>
                            <div class="col-md-6">
                                <textarea rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4 col-md-offset-2">
                                <button type="button" class="btn btn-primary">确定</button>
                                <button type="button" class="btn btn-default">取消</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--中间内容结束-->
</body>
</html>
