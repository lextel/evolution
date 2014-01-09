$(function(){
    // 分类品牌联动
    $('#form_cate_id').change(function(){
        var id = $(this).val();
        var options = '<option value="">--请选择品牌--</option>';

        if(id != 0) {
            $.ajax({
                url: CATE_URL,
                dataType: 'json',
                data: {id:id},
                type: 'post',
                success: function(data) {
                    for(var i in data) {
                        options += '<option value="' + i + '">' + data[i] + '</option>';
                    }
                    $('#form_brand_id').html(options);
                }
            });
        } else {
            $('#form_brand_id').html(options);
        }
    });
});
