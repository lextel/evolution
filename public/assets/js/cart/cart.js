$(function(){

    // 批量删除
    $('button[action="batchDelete"]').click(function(){
        $('#cartForm').submit();

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

    // 支付
    $('#doPay').click(function() {
        // 修改跳转页面
        var url = $(this).attr('url');
        url = url + '?bank=autoPay';
        window.open(url, '_blank');

        // 显示弹出窗口
        $('#payModal').modal('show');
    });

    // 支付弹出跳转
    // 遇到问题
    $('#problem').click(function(){
        $('#payModal').modal('hide');
    });

    // 支付成功
    $('#complete').click(function(){
        location.href = COMPLETE_URL;
    });



});
