$(function(){
    $('.nivoSlider').nivoSlider({
        effect:"fold",
        animSpeed: 500,
        pauseTime: 4000,
        startSlide: 0,
        prevText:"",
        nextText:"",
        manualAdvance:false,
        controlNav: true
    });


    $('.cateNav').hover(function() {
        var idx = $(this).index();
        idx = idx-1;
        $('.cateNav').removeClass('active');
        $(this).addClass('active');
        var dom = $(this).parent().next();
        dom.find('dl').hide();
        dom.find('dl').eq(idx).show();
        var imgDom = dom.find('div');
        imgDom.find('a').hide();
        imgDom.find('a').eq(idx).show();
    });


});

