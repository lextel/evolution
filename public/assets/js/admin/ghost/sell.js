$(function() {
    $('.ghostOrder').click(function() {
        var id = $(this).attr('data-id');
        var num = $('.orderNum'+id).val();
        var mid = $('.orderMid'+id).val();
        $.ajax({
            url: OPERATE_URL + '?id=' + id + '&mid=' + mid + '&num=' + num,
            type: 'get',
            dataType: 'json',
            success: function(data) {
                if(data.code == 0) {
                    $('#join'+id).html('<span style="color: green">' + data.data.remain + '</span>').delay(1000).html(data.data.joined);
                }
                alert(data.msg);
            },
            error: function() {
                alert('请求失败');
            }
        });
    });
});
