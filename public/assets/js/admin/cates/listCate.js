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
    });

    // 保存分类
    $('a[action="save"]').click(function(){
        var $this = $(this);
        var id = $this.attr('data-id');
        var tr = $this.parent().parent().parent();
        var item = tr.find('.editItem');
        var val = item.find('input').val();

        $.ajax({
            url: EDIT_URL + '/' + id,
            data:{name:val},
            type: 'post',
            dataType: 'json',
            success: function(data){
                    if(data.status == 'success') {
                        item.html(val);
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

    // 取消保存
    $('a[action="cancel"]').click(function(){

        var $this = $(this);
        var tr = $this.parent().parent().parent();
        var item = tr.find('.editItem');
        var val = item.find('input').attr('bak');
        item.html(val);
        $this.parent().next().show();
        $this.parent().hide();
    });
});
