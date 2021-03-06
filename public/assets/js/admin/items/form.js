$(function () {

    // 文件上传
    // 'use strict';
    // $('#fileupload').fileupload({
    //     url: UPLOAD_URL,
    //     dataType: 'json',
    //     limitMultiFileUploads: 5,
    //     add: function (e, data) {
    //         // 限制5张图片
    //         var num = $("#files div a img").length + data.originalFiles.length;
    //         if(5 < data.originalFiles.length || 5 < num){
    //             alert("不能超过5张图片");
    //             return false;
    //         }
    //         data.submit();
    //     },
    //     done: function (e, data) {
    //         $.each(data.result.files, function (index, file) {
    //             var idx = $('#files').find('a').length;
    //             var topClass = ''
    //             if(idx == 0) {
    //                 topClass = ' top';
    //                 $('#top').html('<div><img src="'+BASE_URL + file.link+'" style="width: 80px;height: 80px"/><p style="font-size: 10px; text-align: center; width:80px">当前首图</p></div>');
    //             }
    //             $('#files').append('<div class="item-img-list withclose'+topClass+'"><a href="javascript:void(0);" style="display:block" index="'+idx+'"><img src="'+BASE_URL+file.link+'" style="width: 80px; height: 80px"/></a><input type="hidden" name="images[]" value="'+file.link+'"><d class="close">&times;</d></div>');
    //         });
    //     },
    // }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    // 商品图片上传七牛
    $('#fileupload').change(function() {

        var $this = $(this);

        $.get('/token', {bucket:'items'}, function(data) {
            if(data.status == 'success') {
                var token = data.token;
                var f = $this.prop("files")[0];
                var res = Qiniu_upload(f, token).success(function(data) {
                    var link = data.key;

                    var idx = $('#files').find('a').length;
                    var topClass = ''
                    if(idx == 0) {
                        topClass = ' top';
                        $('#top').html('<div><img src="'+ITEMS_URL + link+'" style="width: 80px;height: 80px"/><p style="font-size: 10px; text-align: center; width:80px">当前首图</p></div>');
                    }
                    $('#files').append('<div class="item-img-list withclose'+topClass+'"><a href="javascript:void(0);" style="display:block" index="'+idx+'"><img src="'+ITEMS_URL+link+'" style="width: 80px; height: 80px"/></a><input type="hidden" name="images[]" value="'+link+'"><d class="close">&times;</d></div>');
                });


            }
        }, 'json');

    });

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
        $(this).parent().remove();

        // 重排索引
        var i = 0;
        $('#files').find('div>a').each(function() {
            $(this).attr('index', i);
            i++;
        });

        // 删除首图选第一个
        if(isTop) {
            // 如果没有了，清空首图dom
            if($('#files').find('div').length == 0) {
                $('#top').html('');
                return false;
            }
            $('#files').find('div').eq(0).addClass('top');
            $('#index').val(0);
            var link = $('#files').find('div').eq(0).find('a>img').attr('src');
            $('#top > div').find('img').attr('src', link);
        }
    });

    // 选择首图
    $(document).on('click', '.item-img-list>a', function() {
        $(this).parent().parent().find('div').removeClass('top');
        var target = $(this).parent();
        target.addClass('top');
        var idx = $(this).attr('index');
        var link = $(this).find('img').attr('src');
        $('#index').val(idx);
        $('#top > div').find('img').attr('src', link);
    });
    

    // 预览功能修改
    $(document).on('click', '#edui173', function() {
        $('.navbar-fixed-top').hide();
    });

    // 关闭预览
    $(document).on('click', '#edui172', function() {
        $('.navbar-fixed-top').show();
    });

});
