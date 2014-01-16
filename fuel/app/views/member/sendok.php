<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>邮件发送成功</title>
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
<!--导航结束-->
<!--中间内容开始-->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary ">
                <div class="panel-heading">邮件发送成功</div>
                <div class="panel-body">
                    
                </div>
                <div class="panel-body">
                    <div for="" class="col-md-offset-3">发送成功！<a href="<?php echo \Classes\Email::toemail($email) ? 'http://'.\Classes\Email::toemail($email) : '';?>">点击查看邮箱</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--中间内容结束-->
</body>
</html>
