$(function(){
    $('.operate').on('click', function(){
        var $this = $(this);
        var id = $this.attr('data-id');
        var operate = $this.attr('data-operate');
        $.ajax({
            url: OPERATE_URL,
            type: 'post',
            dataType: 'json',
            data: {id: id, operate:operate},
            success: function(data) {
                if(data.status == 'success') {
                  $this.attr('data-id', data.id);
                  $this.attr('data-operate', data.operate);
                  var text = data.operate == 'up' ? '上架' : '下架';
                  $this.html(text);
                }
            }
        });
    });
});
