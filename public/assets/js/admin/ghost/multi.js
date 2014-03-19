
$(function() {

     // 广告图上传
    UPLOAD_URL = "/admin/ghost/multiUpload";
    IMAGE_URL  = "/";


    $('#csvUpload').fileupload({
        url: '/admin/ghost/csvUpload',
        dataType: 'json',
        done: function (e, data) {
            alert(data.result.msg);
        },
        fail:function(e, data){
            alert('上传失败');
        }
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    
    
    
    $("#multipleupload").fileupload({
        url:UPLOAD_URL,
        multiple:true,
        fileName:"myfile",
        done: function (e, data) {
            console.log(data.result);
            $.each(data.result.files, function (index, file) {                
                var text = '<tr><td><img style="margin:5px; float: left; width:30px;" src="'+IMAGE_URL+file.link+'"></td><td>'+file.name+'</td><td><d class="close"></d></td></tr>';
                $('.avatarfiles').append(text);
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    // 删除图片
    $(document).on('click', '.close', function(){
        $(this).parent().remove();
    });


});
