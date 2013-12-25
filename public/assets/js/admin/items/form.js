$(function () {

    // 文件上传
    'use strict';
    $('#fileupload').fileupload({
        url: UPLOAD_URL,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p style="margin:5px; float: left" />').html('<img width="80px" height="80px" src="'+IMAGE_URL+file.link+'" alt="'+file.name+'"/><d class="close">&times;</d><input type="hidden" name="images[]" value="'+file.link+'">').appendTo('#files');
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    // 实例化编辑器
    var ue = new UE.ui.Editor();
    ue.render("desc");

    // 分类品牌联动
    $('#form_cate_id').change(function(){
        var id = $(this).val();
        var options = '<option value="0">--请选择品牌--</option>';

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

    // 删除图片
    $(document).on('click', '.close', function(){
        console.log('ok');
        $(this).parent().remove();
    });


});
