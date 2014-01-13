$(function(){

    // 批量删除
    $('button[action="batchDelete"]').click(function(){

        var len = $('input[name="ids[]"]:checked').length;

        if(len > 0) {
            $('#cartForm').submit();
        } else {
            alert('请先选择商品。');
        }

        return false;
    });

    // 单个删除
    $('button[action="delete"]').click(function(){
        var tr = $(this).parent().parent();
        tr.eq(0).find('input').attr('checked', true);
        $('#cartForm').submit();

        return false;
    });

    // 全选/反选
    $('input[action="selectAll"]').click(function () {
        if (this.checked) {//全选
            $('input[name="ids[]"]').prop('checked', true);
        } else {
            $('input[name="ids[]"]').prop('checked', false);
        }
    });

    // 提交订单要求登陆
    $('#doOrder').click(function(){
        if(IS_LOGIN) {
            return true;
        } else {
            $('.login2').show();
            return false;
        }
    });

    // 总额 小计
    $('.btn-jian, .btn-jia').click(function() {

        if($(this).hasClass('btn-jian')) {
            var obj = $(this).next();
        } else {
            var obj = $(this).prev();
        }

        updateSubtotal(obj);
        updateTotal();
    });
    $('input[name="qty"]').keyup(function() {
        updateSubtotal($(this));
        updateTotal();
    });

    // 购买 
    $('#doBuy').click(function() {

        var money = $('#money').attr('money');
        var total = $('#total').attr('total');
        if(parseInt(money) < parseInt(total)) {
            $('#payModal').modal('show');
            return false;
        }

        return true;
    });
});

/**
 * 更新总金额
 */
function updateTotal() {
    var total = 0;
    $('.qty').each(function(){
        total = total + parseInt($(this).val());
    });

    $('#total').html(total*POINT + UNIT);
}

/**
 * 更新小计
 */
function updateSubtotal(obj) {
    var val = obj.val();
    var target = obj.parent().parent().next().find('s');

    var subtotal = parseInt(val) * parseInt(POINT);
    target.html(subtotal + UNIT);
}
