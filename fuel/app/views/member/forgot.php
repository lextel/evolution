<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>找回密码</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <?php echo Asset::css('/member/bootstrap.min.css');?>
    <?php echo Asset::css('member/comme.css');?>
    <?php echo Asset::css('member/font-awesome.min.css');?>
    <?php echo Asset::js(array('jquery.min.js', 'bootstrap.min.js', 'common.js', 'holder.js'));?>
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
<div class="navbar navbar-default " role="navigation">
    <div class="container">
        <div class="nav-header">
            <a class="navbar-brand" href="">logo</a>
            <a class="navbar-brand" href="">用户中心</a>
        </div>
        <div class="collapse navbar-collapse ">
            <ul class="nav navbar-nav">
                <li><a href="">首页</a></li>
                <li class="active"><a href="">个人主页</a></li>
                <li><a href="">晒单</a></li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">设置
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="">安全设置</a></li>
                        <li><a href="">资料修改</a></li>
                        <li><a href="">好友管理</a></li>
                        <li><a href="">收货地址</a></li>
                        <li><a href="">充值</a></li>
                    </ul>
                </li>
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
                <li><a href="longin.html">登录</a></li>
                <li><a href="register.html">注册</a></li>
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
            </ul>
        </div>
    </div>
</div>
<!--导航结束-->
<!--中间内容开始-->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary ">
                <div class="panel-heading">找回密码</div>
                <div class="panel-body">
                    <form action="" class="col-md-5 col-md-offset-3">
                        <div class="form-group">
                            <label for="" class="control-label">请输入您要找回密码的通行证帐号</label>
                            <input type="text" type="text" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">请输入您绑定的邮箱</label>
                            <input type="text" type="text" class="form-control"/>
                        </div>
                        <button class="btn btn-primary">发送邮件</button>
                    </form>
                </div>
                <div class="panel-body">
                    <div for="" class="col-md-offset-3">发送成功！<a href="">点击查看邮箱</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--中间内容结束-->
</body>
</html>
