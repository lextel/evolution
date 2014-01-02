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
                $('#files').html($('<p style="margin:5px; float: left" />').html('<img src="'+IMAGE_URL+file.link+'" alt="'+file.name+'"/><d class="close">&times;</d><input type="hidden" name="link" value="'+file.link+'">'));
            });
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
});