
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
    /*$('#avatarUpload').fileupload({
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
    */

    // 删除图片
    $(document).on('click', '.close', function(){
        $(this).parent().remove();
    });
    

    
    $("#avatarUpload").change(function(){
       var f = $("#avatarUpload").prop("files")[0];
       var token = $("#token").val();    
       var res = Qiniu_upload(f, token);
        //console.log(res);
        res.done(function( msg ) {
          console.log(msg);
        });
        res.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + jqXHR.status );
        });
    });


});
