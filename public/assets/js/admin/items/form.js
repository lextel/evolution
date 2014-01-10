$(function () {

    // 文件上传
    'use strict';
    $('#fileupload').fileupload({
        url: UPLOAD_URL,
        dataType: 'json',
        limitMultiFileUploads: 5,
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                var idx = $('#files').find('a').length;
                var topClass = ''
                if(idx == 0) {
                    topClass = ' top';
                    $('#top').html('<div><img src="'+BASE_URL + 'image/80x80/' + file.link+'"/><p style="font-size: 10px; text-align: center;width:80px">当前首图</p></div>');
                }
                $('<a href="javascript:void(0)" index="'+idx+'" />').html('<div class="col-xs-1 item-img-list'+topClass+'"><img src="'+BASE_URL+'image/80x80/'+file.link+'"/><d class="close">&times;</d><input type="hidden" name="images[]" value="'+file.link+'"></div>').appendTo('#files');
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    // 实例化编辑器
    var ue = new UE.ui.Editor();
    ue.render("desc");

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

    // 删除图片
    $(document).on('click', '.close', function(){

        // 如果删除的是首图
        var isTop = false;
        if($(this).parent().hasClass('top')) {
            isTop = true;
        }

        // 删除
        $(this).parent().parent().remove();

        // 重排索引
        var i = 0;
        $('#files').find('a').each(function() {
            $(this).attr('index', i);
            i++;
        });

        if(isTop) {
            $('#files').find('a').eq(0).find('div').addClass('top');
            $('#index').val(0);
        }

        // 找首图
        $('#files').find('a').each(function() {
            if($(this).find('div').hasClass('top')) {
                var link = $(this).find('div>img').attr('src');
                $('#top > div').find('img').attr('src', link);
            }
        });
    });

    // 选择首图
    $(document).on('click', '#files>a', function() {
        $(this).parent().find('a>div').removeClass('top');
        var target = $(this).find('div');
        if(target.hasClass('top')) {
            target.removeClass('top');
        } else {
            target.addClass('top');
            var idx = target.parent().attr('index');
            var link = $(this).find('img').attr('src');
            $('#index').val(idx);
            $('#top > div').find('img').attr('src', link);
        }
    });


});
