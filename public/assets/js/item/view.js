$(function(){

    // 放大镜
    if($('.jqzoom').length > 0) {

	    $('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens:true,
            preloadImages: false,
            alwaysOn:false
        });
    }

    // 滚动到描点
    $(document).on('click', '#bigNav > ul > li, .pagination > span > a', function() {
        var obj = $('#bigNav');
        scrollToAnchor(obj);
    });

    // 添加购物车效果
    $('.doAddCart').click(function () {
        var cart = $('.item-cart');
        var imgtodrag = $('.jqzoom').eq(0);
        var id = $(this).attr('phaseId');
        var qty = $(this).parent().prev().find('input').val();
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top - 195,
                left: imgtodrag.offset().left
            })
            .css({
                'opacity': '0.7',
                'position': 'absolute',
                'height': '400px',
                'width': '340px',
                'z-index': '100'
            })
            .appendTo($('body'))
            .animate({
                'top': cart.offset().top,
                'left': cart.offset().left,
                'width': 59,
                'height':59 
            }, 1000);
            imgclone.animate({
                'opacity': '0',
                'width': 59,
                'height': 59 
            }, function () {
                $(this).detach()
                $.ajax({
                    url: BASE_URL + 'cart/new',
                    data: {id:id, qty:qty},
                    type: 'post',
                    dataType: 'json',
                    success: function(data) {
                        if(data.status == 'success') {
                            $('.item-cart').find('s').html(data.msg);
                        }
                    }
                });

            });
        }
    });

});

// 滚动到相应描点
function scrollToAnchor(obj) {
    $("html,body").animate({scrollTop: obj.offset().top}, 200);
}
