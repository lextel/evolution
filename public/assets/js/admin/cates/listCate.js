$(function(){

    // 添加商品分类表单验证
    $('#addCate').validate({
        rules: {
            name: "required",
        },
        messages: {
            name: "请输入分类名称",
        },
        ignore: [],
        submitHandler: function(form) {
            form.submit();
        },
        errorPlacement: function(error, element) {
            alert(error.html());
        }
    });

    // 添加商品品牌表单验证
    $('#addBrand').validate({
        rules: {
            parent_id: "required",
            name: "required",
        },
        messages: {
            parent_id: "请输入分类名称",
            name: "请输入品牌名称",
        },
        ignore: [],
        submitHandler: function(form) {
            form.submit();
        },
        errorPlacement: function(error, element) {
            alert(error.html());
        }

    });

    // 分类上传图标
    'use strict';
    $(document).on('click', '.uploadField', function() {
        $(this).fileupload({
            url: UPLOAD_URL,
            dataType: 'json',
            limitMultiFileUploads: 1,
            add: function (e, data) {
                $(this).parent().parent().children('span.withclose').remove();

                // 限制1张图片
                var num = $(this).parent().next().length + data.originalFiles.length;
                if(1 < data.originalFiles.length || 1 < num){
                    alert("不能超过1张图片");
                    return false;
                }
                data.submit();
            },
            done: function (e, data) {
                var dom = $(this);
                $.each(data.result.files, function (index, file) {
                    dom.parent().after('<span class="withclose" style="position: relative;"><img src="'+IMAGE_URL+file.link+'" style="width: 34px; height: 34px; margin-left: 10px"/><input type="hidden" name="icon" value="'+file.link+'"/><d class="close" style="top:-12px;right:1px">&times;</d></span>');
                });
            },
        }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    });
    
    // 删除图片
    $(document).on('click', '.close', function(){
        $(this).parent().remove();
    });


    // 隐藏编辑
    $('div[class="editing"]').each(function(){
        $(this).hide();
    });


    // 编辑分类
    $('a[action="edit"]').click(function(){
        var $this = $(this);
        var id = $this.attr('data-id');
        $this.parent().prev().show();
        $this.parent().hide();

        var tr = $this.parent().parent().parent();
        var item = tr.find('.editItem');
        var val = item.text();
        item.html('<input type="text" class="form-control" id="editItem'+id+'" placeholder="分类名称" bak="'+val+'" value="'+val+'">');

        var icon = tr.find('.editIcon');
        var iconVal = '';
        var defaultIcon = '';
        if(icon.find('img').length > 0) {
            iconVal = icon.find('img').attr('data');

            defaultIcon = '<span class="withclose" style="position: relative;"><img src="'+IMAGE_URL+iconVal+'" style="width: 34px; height: 34px; margin-left: 10px"/><input type="hidden" name="icon" value="'+iconVal+'"/><d class="close" style="top:-12px;right:1px">&times;</d></span>';
        }
        icon.html('<span class="btn btn-success fileinput-button"><i class="glyphicon glyphicon-plus"></i><span>添加图标</span><input class="uploadField" type="file" name="file"></span>' + defaultIcon);
    });

    // 保存分类
    $('a[action="save"]').click(function(){
        var $this = $(this);
        var id = $this.attr('data-id');
        var tr = $this.parent().parent().parent();
        var item = tr.find('.editItem');
        var val = item.find('input').val();
        var icon = tr.find('.editIcon');
        var iconVal = icon.find('span.withclose > input').val();

        $.ajax({
            url: EDIT_URL + '/' + id,
            data:{name:val, icon:iconVal},
            type: 'post',
            dataType: 'json',
            success: function(data){
                    if(data.status == 'success') {
                        item.html(val);
                        if(icon.find('span.withclose > input').length > 0) {
                            icon.html('<img data="'+iconVal+'" src="'+IMAGE_URL+iconVal+'" style="width: 34px; height:34px"/>');
                        } else {
                            icon.html('无');
                        }
                        $this.parent().next().show();
                        $this.parent().hide();
                    } else {
                        alert('保存失败');
                    }
                },
            error: function(){
                alert('保存失败');
            }
            });
    });
});
