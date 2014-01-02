/**
 * Created by ui-1 on 13-12-23.
 */
$(function(){
    $(".sub-nav ul li a").click(function(){
        $(".sub-nav ul li a").removeClass("active");
        $(this).addClass("active");
        $(".product-side>div").addClass("d-n");
        $(".product-side>div").eq($(".sub-nav ul li a").index($(this))).removeClass("d-n");
    });
});
/*用户中心折叠效果*/
$(function(){
    $(".dropdown>a").click(function(){
        var menu=$(this).next("ul");
        if(menu.css("display")=="none")
        {
            menu.css({"display":"block"});
            $(this).parent("li").find("span").addClass("icon-arrow-down");
        }
        else{
            menu.css({"display":"none"});
            $(this).parent("li").find("span").removeClass("icon-arrow-down");
        }
    });
});
/*弹出登录框*/
$(function(){
    var screenwidth,screenheight,mytop,getPosLeft,getPosTop;
     screenwidth = $(window).width();
     screenheight = $(window).height();
     mytop = $(document).scrollTop();
     getPosLeft = screenwidth/2 - 260;
     getPosTop = screenheight/2 - 150;
     $(".login2").css({"left":getPosLeft,"top":getPosTop});
     $(window).resize(function(){
        screenwidth = $(window).width();
        screenheight = $(window).height();
         mytop = $(document).scrollTop();
        getPosLeft = screenwidth/2 - 260;
        getPosTop = screenheight/2 - 150;
        $(".login2").css({"left":getPosLeft,"top":getPosTop+mytop});
     });
    $(window).scroll(function(){
        screenwidth = $(window).width();
        screenheight = $(window).height();
        mytop = $(document).scrollTop;
        getPosLeft = screenwidth/2 - 260;
        getPosTop = screenheight/2 - 150;
        $(".login2").css({"left":getPosLeft,"top":getPosTop+mytop});
    });
    $("#popup").click(open_login);
    function open_login(){
        $(".login2").fadeIn("fast");
        $("body").append("<div id='greybackground'></div>");
        var documentheight = $(document).height();
        $("#greybackground").css({"opacity":"0.5","height":documentheight});
        return false;
    }
    $("#close").click(function() {
        $(".login2").hide();
        $("#greybackground").remove();
        return false;
    });
});

/*今日热门图片切换*/
$(function(){
    var page=1;
    var i=5;
    var content=$(".img-show");
    var content_list=$(".img-show ul");;
    var v_width=content.width();
    var len=content_list.length;
    var page_cont=Math.ceil(len/i);
    $(".next").click(function(){
        if(!content_list.is(":animated")){
            if(page==page_cont){
                content_list.animate({left:'0px'},'show');
                page=1;
            }
            else{
                content_list.animate({left:'-='+v_width},'show');
                page++;
            }
        }
    });
    $(".prev").click(function(){
        if(!content_list.is(":animated")){
            if(page==1){
                content_list.animate({left:'-='+v_width*(page_cont-1)},'show');
                page=1;
            }
            else{
                content_list.animate({left:'+='+v_width},'show');
                page--;
            }
        }
    });
});

$(function(){
    // 搜索
    $('#doSearch').click(function(){
        var val = $(this).prev().val();
        if(val != '') {
            location.href = BASE_URL + 'm/search/' + val;
        }
    });

    // 数量输入框选中
    $('input[name="qty"]').hover(function(){
        $(this).select();
    });

    // 数量被直接修改
    $('input[name="qty"]').keyup(function(){
        var val = $(this).val();

        var reNum = /^\d*$/;
        if(!reNum.test(val) || val == '') {
            val = 1;
        }

        val = parseInt(val);
        if(val < 1) {
            alert('数量不能小于1。');
            val = 1;
            $(this).select();
        }

        var remain = $(this).attr('remain');
        if(val > parseInt(remain)) {
            alert('数量不能大于剩余人次');
            val = remain;
            $(this).select();
        }

        countPercent(val, $(this));

        $(this).val(val);
    });

    

    // 数量增加
    $('.btn-jia').click(function(){
        var $this = $(this);
        var input = $this.prev();
        var max = input.attr('remain');
        var val = parseInt(input.val());
        if(val + 1 > parseInt(max)) {
            alert('购买数量不能大于剩余数量');
        } else {
            val = val + 1;
            countPercent(val, input);
            input.val(val);
        }
    });

    // 数量减少
    $('.btn-jian').click(function(){
        var $this = $(this);
        var input = $this.next();
        var min = 1;
        var val = parseInt(input.val());

        if(val -1 < parseInt(min)) {
            alert('购买数量不能小于1');
        } else {
            val = val - 1;
            countPercent(val, input);
            input.val(val);
        }
    });
});

function countPercent(val, input) {
    if($('#percent').length > 0) {
        var total = input.attr('amount');
        var percent =val/parseInt(total)*100;
        $('#percent').html(percent.toFixed(2) + '%');
    }
}
/**
 * 购物车下拉效果
 */
$(function(){
    $(".shopping-cart").mouseover(function(){
          $(this).find(".dropdown-list").css({"display":"block"})
        });
    $(".shopping-cart").mouseout(function(){
            $(this).find(".dropdown-list").css({"display":"none"})
        });
});
/**
 * 评论交互效果
 */
$(function(){
    var text=$(".comment-box>textarea");
    //最大输入字数
    var word=$(".comment-footer>span>s");
    var max_num=200;
    var scr_num=0;
    var abc_num=0;
    var ie = jQuery.support.htmlSerialize;

    text.focus(function(){
        if(ie){
            text[0].oninput = changeNum;
        }else{
            text[0].onpropertychange  = changeNum;
        }
        function changeNum(){
            scr_num= $(this).val().replace(/\w/g,"").length;
            abc_num=$(this).val().length-scr_num;
            var total=scr_num+abc_num;
            var word_num=max_num-total
            word.text(word_num);
            if(total>=max_num){
                word.css({color:"red"});
            }
            if(total<=0){
                $(this).next("div").children(".btn-comment").attr('disabled', 'disabled')
                $(this).next("div").children(".btn-comment").css({background:"#fff",color:"#333"})
            }
            else{
                $(this).next("div").children(".btn-comment").removeAttr("disabled");
                $(this).next("div").children(".btn-comment").css({background:"#D9534F",color:"#fff"})
            }
        }
    })
});