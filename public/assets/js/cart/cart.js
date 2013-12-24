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


});
