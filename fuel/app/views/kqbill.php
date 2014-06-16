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
