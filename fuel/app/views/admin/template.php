<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <?php echo Asset::css(['bootstrap.min.css', 'admin.css']); ?>
    <style>
        body { margin: 50px; }
    </style>
    <?php echo Asset::js(array(
        'jquery.min.js',
        'bootstrap.min.js'
    )); ?>
    <script>
        $(function(){ $('.topbar').dropdown(); });
    </script>
</head>
<body>
    <?php if ($current_user): ?>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo Uri::base(); ?>" target="_blank">乐乐淘</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="<?php echo Uri::segment(2) == '' ? 'active' : '' ?>">
                        <?php echo Html::anchor('admin', '管理首页') ?>
                    </li>
                    <?php
                        Config::load('admin');
                        $navs = Config::get('navs');
                        foreach($navs as $key => $nav) {
                            if($key != 'admin') {
                                if(isset($nav['childs'])) {
                                    $subli = '';
                                    foreach($nav['childs'] as $child) {
                                        $subli .= "<li><a href='{$child['href']}'>{$child['name']}</a></li>";
                                    }
                                    echo '<li class="dropdown">'.
                                            '<a data-toggle="dropdown" class="dropdown-toggle"  href="javascript:void(0);">'.$nav['name'].'<b class="caret"></b></a>'.
                                            '<ul class="dropdown-menu">'. $subli . '</ul>'.
                                         '</li>';
                                } else {
                                    echo '<li class=""><a href="'.$nav['href'].'">'.$nav['name'].'</a></li>';
                                }
                            }
                        }
                    ?>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);"><?php echo $current_user->username ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><?php echo Html::anchor('admin/logout', '登出') ?></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="container">
        <?php if(isset($breadcrumb)): ?>
        <ol class="breadcrumb">
            <?php echo $breadcrumb; ?>
        </ol>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <?php if (Session::get_flash('success')): ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>
                    <?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
                    </p>
                </div>
                <?php endif; ?>
                <?php if (Session::get_flash('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>
                    <?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
                    </p>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-md-12">
            <?php echo $content; ?>
            </div>
        </div>
        <hr/>
        <footer>
            <p class="pull-right">执行时间 {exec_time}s 消耗内存{mem_usage}mb.</p>
            <p>
                <br>
                <small>Version: 2.0</small>
            </p>
        </footer>
    </div>
    <script>
        BASE_URL = '<?php echo Uri::base(); ?>';
    </script>
</body>
</html>
