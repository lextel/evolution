
$(function() {

     // 广告图上传
    UPLOAD_URL = "/admin/ghost/multiUpload";
    IMAGE_URL  = "/";
    $('#avatarUpload').fileupload({
        url: UPLOAD_URL,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#files').html('');
                var text = '<p><img style="margin:5px; float: left" src="'+IMAGE_URL+file.link+'"><d class="close"></d><input type="hidden" name="avatar" value="'+file.link+'"></p>';
                $('#files').append(text);
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    $('#csvUpload').fileupload({
        url: '/admin/ghost/csvUpload',
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                console.log(file);
            });
            var filename = $('input[type=file]').val();
            
        },
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
                    alert(1111);
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    $("#multipleupload").fileupload({
        url:UPLOAD_URL,
        multiple:true,
        fileName:"myfile",
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#files').html('');
                var text = '<p><img style="margin:5px; float: left" src="'+IMAGE_URL+file.link+'"><d class="close"></d><input type="hidden" name="avatar" value="'+file.link+'"></p>';
                $('#files').append(text);
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    // 删除图片
    $(document).on('click', '.close', function(){
        $(this).parent().remove();
    });


});
