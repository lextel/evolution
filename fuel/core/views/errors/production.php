<!DOCTYPE html>
<html>
    <head>
        <title>500</title>
        <meta charset="utf-8">
        <?php echo Asset::css(['common.css', 'style.css']); ?>
    </head>
    <body>
        <div class="w">
            <div class="error-box">
                <img src="<?php echo Uri::base(); ?>assets/img/500.png" alt=""/>
                <p>服务器在打瞌睡了</p>
                <p>1、您可以 <a href="<?php echo Uri::base(); ?>">返回首页</a></p>
                <p>2、您可以 <a href="<?php echo Uri::current()?>">尝试刷新</a></p>
                <p>如你浏览本站时，多次出现此页面，请与管理员联系，QQ：2698744419</p>
            </div>
        </div>
    </body>
</html>
