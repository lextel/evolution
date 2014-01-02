$(function(){

    // 放大镜
    if($('.jqzoom').lenght > 0) {
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
});

// 滚动到相应描点
function scrollToAnchor(obj) {
    $("html,body").animate({scrollTop: obj.offset().top}, 200);
}
