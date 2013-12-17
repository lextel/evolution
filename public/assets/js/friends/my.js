$(function() {

    // 取消关注
    $('.unfollow').click(function() {
        var mid = $(this).attr('data-mid');
        $.ajax({
          url: UNFOLLOW_URL,
          data: {mid:mid},
          type: 'post',
          datatype: 'json',
          success: function(data){
            if(data.status == 'success') {

            } else {

            }
          },
          error: function() {

          }
        });
    });
});
