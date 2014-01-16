<!DOCTYPE html>
<html>
    <head>
        <title>404</title>
        <meta charset="utf-8">
        <?php echo Asset::css(['common.css', 'style.css']); ?>
    </head>
    <body>
        <div class="w">
            <div class="error-box">
                <img src="<?php echo Uri::base(); ?>assets/img/404.png" alt=""/>
                <p>您请求的页面不存在</p>
                <p>您可以 <a href="<?php echo Uri::base(); ?>">返回首页</a></p>
                <p>如你浏览本站时，多次出现此页面，请与管理员联系，QQ：888888</p>
            </div>
        </div>
    </body>
</html>
