$(function(){

    if($('.jqzoom').lenght > 0) {
        $('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens:true,
            preloadImages: false,
            alwaysOn:false
        });
    }

        $(".btn-jia").click(function (){
            alert(1);
            //$(this).val();
         });

});




