<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://www.llt.com/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://www.llt.com/assets/css/comme.css">
    <link rel="stylesheet" href="http://www.llt.com/assets/css/font-awesome.min.css">
    <script src="http://www.llt.com/assets/js/bootstrap.min.js"></script>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.10.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->

</head>
<body>
<div class="container">
    <div class="row">
        <h2>logo</h2>
    </div>
    <div class="row">
        <form class="form-horizontal col-md-6 col-md-offset-2 register" action="/signup" role="form" method="POST">
            <h3>用户注册</h3>
            
            <div class="form-group">
                <lable class="col-md-2 control-label">用户名</lable>
                <div class="col-md-5">
                    <input name="username" class="form-control" type="text" placeholder=""/>
                </div>
            </div>
            <div class="form-group">
                <lable class="col-md-2 control-label">密码</lable>
                <div class="col-md-5">
                    <input name="password" class="form-control" type="password" placeholder=""/>
                </div>
            </div>
            <div class="form-group">
                <lable class="col-md-2 control-label">确认密码</lable>
                <div class="col-md-5">
                    <input class="form-control" type="password" placeholder=""/>
                </div>
            </div>
            <div class="form-group">
                <lable class="col-md-2 control-label">性别</lable>
                <div class="col-md-5">
                        <lable  class="radio-inline">
                            <input type="radio" name="optionsRadios" value="option1" checked/>男
                        </lable>
                        <lable  class="radio-inline">
                            <input type="radio" name="optionsRadios" value="option1" checked/>女
                        </lable>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-2">
                    <button class="btn btn-success">立即注册</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
