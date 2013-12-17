<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <?php echo Asset::css('bootstrap.min.css');?>
    <?php echo Asset::css('member/comme.css');?>
    <?php echo Asset::js('bootstrap.min.js');?>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?php echo Asset::js('jquery.min.js');?>
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
            <div class="col-md-6">
                <?php echo Asset::img('login_bg3.jpg');?>
            </div>
            <div class="col-lg-4">
                <form method="POST" action="/signin" role="form" class="loginForm">
                    <h3>用户登录</h3>
                    <div class="form-group">
                        <input name="username" class="form-control" type="text" placeholder="用户名"/>
                        <span class="fa-user"></span>
                    </div>
                    <div class="form-group">
                        <input name="password" class="form-control" type="password" placeholder="密码"/>
                        <span class="fa-lock"></span>
                    </div>
                    <div class="form-group">
                        <?php echo Html::anchor('u/passwd/forgot', '忘记密码？', array('class' => 'btn-link'));?>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block">登录</button>
                    </div>
                    <div class="form-group registering">
                        <span  class=" help-block">可以用其他登录方式</span>
                        <?php echo Html::anchor('signup', 'QQ登录', array('class' => 'btn-link'));?>
                        <?php echo Html::anchor('signup', '新浪登录', array('class' => 'btn-link'));?>
                        <?php echo Html::anchor('signup', '马上注册', array('class' => 'btn-link'));?>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>
</html>
