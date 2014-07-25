$(function() {
   // 开始结束时间
    var dates = $("#start,#end");
    dates.datepicker({
        dateFormat: "yy-mm-dd",
        minDate: new Date(),
        onSelect: function(selectedDate){
           var option = this.id == "start" ? "minDate" : "maxDate";
           dates.not(this).datepicker("option", option, selectedDate);
        }
    });

     // 广告图上传
    UPLOAD_URL = "/v2admin/ghost/avatarUpload";
    IMAGE_URL  = "/";
    $('#avatarUpload').fileupload({
        url: UPLOAD_URL,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#files').html('');
                var text = '<p><img style="margin:5px; float: left; width=80px;" src="'+IMAGE_URL+file.link+'"><d class="close"></d><input type="hidden" name="avatar" value="'+file.link+'"></p>';
                $('#files').append(text);
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');


    // 删除图片
    $(document).on('click', '.close', function(){
        $(this).parent().remove();
    });


    /*var UPLOAD_PATH = "upload/avatar/";
    var WH = '?imageView2/1/w/80/h/80';//缩略
    $("#avatarUpload").change(function(){
        var f = $(this).prop("files")[0];
        var token = $("#token").val();
        var res = Qiniu_upload(f, token, '', UPLOAD_PATH);
        res.done(function( msg ) {
            console && console.log(msg);
            //$('#files').html('');
            //var link = msg['x:album'];
            //var text = '<p><img style="margin:5px; float: left; width:80px;" src="'+link+WH+'"><d class="close"></d><input type="hidden" name="avatar" value="'+msg.key+'"></p>';
            //$('#files').append(text);
        });
        res.fail(function( jqXHR, textStatus ) {
            alert("图片上传失败，请刷新页面再上传");
        });
    });*/


});
