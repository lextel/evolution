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
    'use strict';
    $('#fileupload').fileupload({
        url: UPLOAD_URL,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#files').html($('<p/>').html('<img src="'+IMAGE_URL+file.link+'" alt="'+file.name+'"/><d class="close">&times;</d><input type="hidden" name="image" value="'+file.link+'">'));
                initAd();
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    // 改变投放区域
    $('#form_zone').change(function() {
        initAd();
    });

    initAd();
});

// 定义广告图片显示大小
function initAd() {
    var val = $('#form_zone').val();
    if(val == 1) {
        $('#files').find('p > img').attr('style', 'width: 196px; height: 70px; margin: 5px;');
    } else {
        $('#files').find('p > img').attr('style', 'width: 90px; height: 50px; margin: 5px');
    }
}
