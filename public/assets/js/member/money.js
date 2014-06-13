$(function() {
    var screenwidth,screenheight,mytop,getPosLeft,getPosTop;
    screenwidth = $(document).width();
    screenheight = $(document).height();
    mytop = $(document).scrollTop();
    getPosLeft = screenwidth/2 - 260;
    getPosTop = (screenheight-mytop)/4;
    $(".login2").css({"left":getPosLeft,"top":getPosTop});
    $(window).resize(function(){
        screenwidth = $(window).width();
        screenheight = $(window).height();
        mytop = $(document).scrollTop();
        getPosLeft = screenwidth/2 - 260;
        getPosTop = (screenheight-mytop)/2-200;
        $(".login2").css({"left":getPosLeft,"top":getPosTop+mytop});
    });
    $(window).scroll(function(){
        screenwidth = $(window).width();
        screenheight = $(document).height();
        mytop = $(document).scrollTop();
        getPosLeft = screenwidth/2 - 260;
        getPosTop = (screenheight-mytop)/4;
        $(".login2").css({"left":getPosLeft,"top":getPosTop+mytop});
    });
   $(".buy-btn").click(function(){
       var money = $("input[name='money1']:checked").val();
       var source = $("input[name='account']:checked").val();
       $("input[name='source']").val(source);
       if (!money){
          money = $("input[name='money2']").val();
       }
       if (!money){
          alert('请填写金额');
          return false;
       }
       $("input[name='money']").val(money);
       data = $('#addmoney').serialize();
       if($('input:radio[name="account"]').is(':checked')) {
               var url = '/u/recharge';
               url += '?' + data;
               window.open(url);

               $(".login2").show();
               $(".login2").fadeIn("fast");
               $("body").append("<div id='greybackground'></div>");
               var documentheight = $(document).height();
               $("#greybackground").css({"opacity":"0.5","height":documentheight});
               return false;
        } else {
              alert('请选择支付方式');
        }

   });
   $("#money2").keyup(function(){
    var value = $("#money2").val();
    if((/^[1-9]{1}[0-9]*$/.test(value))|| value<0)
    {
      $(".moneytotal").html(value);
      return true;
    }
    else
    {
      $("#money2").val("1");
      $(".moneytotal").html(1);
      return false;
    }
   });
   $("input[name='money1']").change(function(){
      var value = $("input[name='money1']:checked").val();
      $(".moneytotal").html(value);
   });

})
