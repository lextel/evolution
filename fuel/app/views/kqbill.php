<!Doctype html>
<html xmlns=http://www.w3.org/1999/xhtml>
<head>
<meta http-equiv=Content-Type content="text/html;charset=utf-8">
</head>
<body>
<div style="display:none;">
<?php Config::load("common");?>
<form name="kqPay" action="<?php echo Config::get('99bill.sendUrl');?>" method="post">
<?php foreach($BillRequest as $key => $val):?>
    <input type="hidden" name="<?php echo $key;?>" value="<?php echo $val;?>"/>
<?php endforeach;?>
    <input type="submit" name="submit" value="提交到快钱" id="kqPay">
</form>
</div>
<script>
document.getElementById('kqPay').click();
</script>
</body>
</html>
