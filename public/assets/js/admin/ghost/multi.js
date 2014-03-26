
$(function() {

     // 广告图上传
    UPLOAD_URL = "/v2admin/ghost/multiUpload";
    IMAGE_URL  = "/";


    $('#csvUpload').fileupload({
        url: '/v2admin/ghost/csvUpload',
        dataType: 'json',
        send: function (e, data) {
            $(".csvloader").show();
        },
        done: function (e, data) {
            $(".csvloader").hide();
            alert(data.result.msg);
        },
        fail:function(e, data){
            $(".csvloader").hide();
            alert('上传失败');        
        }
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    
    
    
    $("#multipleupload").fileupload({
        url:UPLOAD_URL,
        multiple:true,
        fileName:"myfile",
        send: function (e, data) {
            $(".jpgloader").show();
        },
        done: function (e, data) {
            $(".jpgloader").hide();
            $.each(data.result.files, function (index, file) {                
                var text = '<tr><td><img style="margin:5px; float: left; width:30px;" src="'+IMAGE_URL+file.link+'"></td><td>'+file.name+'</td><td><d class="close"></d></td></tr>';
                $('.avatarfiles').append(text);
            });
        },
        fail:function(e, data){
            $(".jpgloader").hide();
            alert('图片上传失败');
        }
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    // 删除图片
    $(document).on('click', '.close', function(){
        $(this).parent().remove();
    });


});
