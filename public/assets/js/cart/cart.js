$(function(){
    var screenwidth,screenheight,mytop,getPosLeft,getPosTop;
    screenwidth = $(document).width();
    screenheight = $(document).height();
    mytop = $(document).scrollTop();
    getPosLeft = screenwidth/2 - 260;
    getPosTop = (screenheight-mytop)/4;
    $(".payuse").css({"left":getPosLeft,"top":getPosTop});
    $(window).resize(function(){
        screenwidth = $(window).width();
        screenheight = $(window).height();
        mytop = $(document).scrollTop();
        getPosLeft = screenwidth/2 - 260;
        getPosTop = (screenheight-mytop)/2-200;
        $(".payuse").css({"left":getPosLeft,"top":getPosTop+mytop});
    });
    $(window).scroll(function(){
        screenwidth = $(window).width();
        screenheight = $(document).height();
        mytop = $(document).scrollTop();
        getPosLeft = screenwidth/2 - 260;
        getPosTop = (screenheight-mytop)/4;
        $(".payuse").css({"left":getPosLeft,"top":getPosTop+mytop});
    });

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
    $('a[action="delete"]').click(function(){

        var rowId = $(this).attr('rowId');;
        window.location.href = BASE_URL + 'cart/remove/' + rowId;
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
            $("body").append("<div id='greybackground'></div>");
            var documentheight = $(document).height();
            $("#greybackground").css({"opacity":"0.5","backgroundColor":"#000000","height":documentheight});

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

        // 如果是元宝支付
        if($('#goldPay').is(':checked')) {
            var money = $('#money').attr('money');
            var total = $('#total').attr('total');
            if(parseInt(money) < parseInt(total)) {
                $('#payModal').modal('show');
            } else {
                window.location.href=BASE_URL+"/cart/complete";
            }
        } else {
            // 是否选择银行
            if($('input:radio[name="account"]').is(':checked')) {
                var source = $('input:radio[name="account"]:checked').val();

                window.open('/payment/pay' + '?source=' + source, '_blank');

                //$('#thirdPartyModal').modal('show');
                $(".payuse").show();
                $(".payuse").fadeIn("fast");
                $("body").append("<div id='greybackground'></div>");
                var documentheight = $(document).height();
                $("#greybackground").css({"opacity":"0.5","height":documentheight});
                return false;
            } else {
                alert('请选择支付方式');
            }

        }
    });

    $('#payFinish, #payFail').click(function() {
        $('#thirdPartyModal').modal('hide');
    });

    // 选择元宝
    $('#goldPay').click(function(){
        if($(this).is(':checked')) {
            $('input:radio[name="account"]').attr('checked', false);
        }
    });

    // 选择银行
    $('input:radio[name="account"]').click(function() {
        if($(this).is(':checked')) {
            $('#goldPay').attr('checked', false);
        }
    });

});

/**
 * 更新总金额
 */
function updateTotal() {
    var total = 0;
    $('.qty').each(function(){
        total = total + parseInt($(this).val()) * parseInt($(this).attr('price'));
    });


    $('#total').html(showCoins(total));
}

/**
 * 更新小计
 */
function updateSubtotal(obj) {
    var val = obj.val();
    var target = obj.parent().parent().next();

    var subtotal = parseInt(val) * parseInt(obj.attr('price'));
    target.html('<span class="price"><b>' +showCoins(subtotal)+'</b></span>');
}
