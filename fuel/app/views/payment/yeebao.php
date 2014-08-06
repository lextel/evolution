<html>
<head>
<title>跳转到易宝支付页面</title>
</head>
<body onLoad="document.yeepay.submit();">
<?php Config::load('common');?>
<form name='yeepay' action="<?php echo Config::get('yeebao.requrl'); ?>" method='post'>
<?php foreach($params as $k=>$v) { ?>
<input type='hidden' name='<?php echo $k?>'                  value='<?php echo $v; ?>'>
<?php } ?>
</form>
</body>
</html>
