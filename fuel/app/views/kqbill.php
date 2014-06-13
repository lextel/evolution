<div style="display:none;">
<form name="kqPay" action="https://www.99bill.com/gateway/recvMerchantInfoAction.htm" method="post">
<?php foreach($BillRequest as $key => $val):?>
    <input type="hidden" name="<?php echo $key;?>" value="<?php echo $val;?>"/>
<?php endforeach;?>
    <input type="submit" name="submit" value="提交到快钱" id="kqPay">
</form>
</div>
<script>
document.getElementById('kqPay').click();
</script>
