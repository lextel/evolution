
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
                $('#files').append('<div class="ad-img withclose"><img src="'+IMAGE_URL+file.link+'"/><input type="hidden" name="images" value="'+file.link+'"><d class="close">&times;</d></div>');
                initAd();
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    // 改变投放区域
    $('#form_zone').change(function() {
        initAd();
    });

    // 删除图片
    $(document).on('click', '.close', function(){
        $(this).parent().remove();
    });

    initAd();
});

// 定义广告图片显示大小
function initAd() {
    var val = $('#form_zone').val();
    if(val == 1) {
        $('#files').find('div').attr('style', 'width: 200px; height: 74px;');
        $('#files').find('div>img').attr('style', 'width: 196px; height: 70px;');
    } else {
        $('#files').find('div').attr('style', 'width: 94px; height: 54px;');
        $('#files').find('div>img').attr('style', 'width: 90px; height: 50px;');
    }
}
