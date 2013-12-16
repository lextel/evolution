<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
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
            <a class="navbar-brand" href="">乐乐淘</a>
            <a class="navbar-brand" href="">用户中心</a>
        </div>
        <div class="collapse navbar-collapse ">
            <ul class="nav navbar-nav">
                <li><a href="">首页</a></li>
                <li class="active"><a href="">我的主页</a></li>
                <li><a href="">晒单</a></li>
            </ul>
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
                    <div class="portrait-side">
                        <a href="" class="top-portrait"><img src="img/login_bg3.jpg"/>火枪中路必胜</a>
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
                    <dt><i class="fa fa-cog"></i><a href="javascript:void(0);">个人资料</a></dt>
                    <dd class="active"><a href="javascript:void(0);">基本资料</a></dd>
                    <dd><a href="javascript:void(0);">修改头像</a></dd>
                    <dd><a href="javascript:void(0);">密码修改</a></dd>
                    <dd><a href="javascript:void(0);">收货地址</a></dd>
                    <dd><?php echo Html::anchor('u/friends', '好友管理');?></dd>
                </dl>
                <dl>
                    <dt><i class="fa fa-credit-card"></i><a href="">其他</a></dt>
                    <dd><?php echo Html::anchor('u/orders', '购买记录');?></dd>
                    <dd><a href="javascript:void(0);">中奖记录</a></dd>
                    <dd><a href="javascript:void(0);">晒单</a></dd>
                    <dd><a href="javascript:void(0);">充值</a></dd>
                </dl>
            </div>

        </div>
        <div class="col-md-9" role="main">
            <div class="panel panel-default main">
                <div class="panel-body">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--中间内容结束-->
</body>
</html>
