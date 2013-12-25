$(function () {

    // 文件上传
    'use strict';
    $('#fileupload').fileupload({
        url: UPLOAD_URL,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p style="margin:5px; float: left" />').html('<img width="80px" height="80px" src="'+IMAGE_URL+file.link+'" alt="'+file.name+'"/><input type="hidden" name="images[]" value="'+file.link+'">').appendTo('#files');
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    //实例化编辑器
    var ue = new UE.ui.Editor();
    ue.render("desc");
});
