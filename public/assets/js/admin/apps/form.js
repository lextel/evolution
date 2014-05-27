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

     // 上传ICON
    UPLOAD_URL = "/v2admin/apps/uploadimg";
    IMAGE_URL  = "/";
    $('#iconUpload').fileupload({
        url: UPLOAD_URL,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#icon').attr('src', IMAGE_URL+file.link);
                var text = '<input type="hidden" name="icon" value="'+file.link+'">';
                $('input[name=icon]').val(file.link);
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    // 上传产品说明图
    $("body").on('click', '#imgUpload', function(){
        var imgs = $(".withclose").length;
        if (imgs >= 3){
            alert('您上传的图片超过了3张');
            return false;
        }
        $('#imgUpload').fileupload({
            url: UPLOAD_URL,
            dataType: 'json',
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    var text = '<div class="item-img-list withclose">';
                    text += '<img style="border: 1px #ccc solid; padding:5px;width:80px;height:80px" src="'+IMAGE_URL+file.link+'" alt="" />';
                    text += '<input type="hidden" name="images[]" value="'+file.link+'">'
                    text += '<d class="close">&times;</d></div>';
                    $('#imgfiles').append(text);
                });
            },
        }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
    // 删除图片
    $(document).on('click', '.close', function(){
        $(this).parent().remove();
    });
    // 尺寸大小显示
    var localSize = $('input[name=size]').val();
    var localLink = $('select[name=link]').val();
    $(".apkfile").change( function(){
       var link = $('select[name=link]').val();
       if (link == localLink){
            $('input[name=size]').val(localSize);
            return;
       }
       var size = SIZES[link];
       if (link == ''){
          size = 0;
       }
       $('input[name=size]').val(size);
    });
    
    $(".oschange").change( function(){
       var link = $('select[name=os]').val();
       if (link != '2'){
            $(".filelink2").hide();
            $(".filelink1").show();
            return;
       }
       $(".filelink1").hide();
       $(".filelink2").show();
   });
});
