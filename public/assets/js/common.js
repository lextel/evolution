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
/**
 *返回顶部--侧边浮动快捷栏
 */
$(function(){
    var w_width=$(window).width();
    var w_height=$(window).height();
    $(".weiXin").css({right:(w_width-980)/2-150,top:w_height/4});
    var getRight=(w_width-980)/2-80
    $(".short-cut").show();
    $(".short-cut").css({right:getRight});
    $(window).resize(function(){
        var screenWidth = $(window).width();
        var screenHeight = $(window).height();
        var getRight=(screenWidth-980)/2-80
        $(".short-cut").css({right:getRight});
        $(".weiXin").css({right:(screenWidth-980)/2-150,top:screenHeight/4});
    });
    $(".weiXin-img button").click(function(){
        $(this).parents(".weiXin").fadeOut(1000);
    });
    /*返回顶部*/
    $(".item-gotTop").click(function(){
        $("body,html").animate({scrollTop:0},300)
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
    $("#popup").click(function(){
        $(".login2").fadeIn("fast");
        $("body").append("<div id='greybackground'></div>");
        var documentheight = $(document).height();
        $("#greybackground").css({"opacity":"0.5","height":documentheight});
        return false;
    });
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

function doSearch(){
    var val = $('#txtSearch').val();
    if(val != '') {
        location.href = BASE_URL + 'm/search/' + val;
    }
}

$(function(){
    // 搜索
    $('#doSearch').click(function(){
        doSearch();
    });

    $("#txtSearch").keyup(function(){
        if(event.keyCode == 13) {
            doSearch();
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
        updateCart(val, $(this), val);

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
            var qty = val + 1;
            countPercent(qty, input);
            updateCart(qty, input, val);
            input.val(qty);
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
            var qty = val - 1;
            countPercent(qty, input);
            updateCart(qty, input, val);
            input.val(qty);
        }
    });

   // 参与者拉取
    $('a[href="#buylog"]').click(function() {
        joined(1);
    });

    // 晒单拉取
    $('a[href="#posts"]').click(function() {
        posts(1);
    });

    // 拉取期数
    $('a[href="#phase"]').click(function() {
        phases(1);
    });


    // 当前nav标识
    var location_url = window.location.href;
    if(location_url == BASE_URL) {
        $('.navbar>ul>li').eq(0).find('a').addClass('active');
    }
    $('.navbar > ul > li').each(function() {

        if($(this).index() != 0) {
            var target = $(this).find('a');

            var navlink = target.attr('href').replace(/\//g,'\\/');
            navlink = eval('/'+navlink.replace(/\./g,'\\.') + '/');

            if(navlink.test(location_url)) {
                match = true;
                $('.navbar > ul > li').find('a').removeClass('active');
                target.addClass('active');
            }
        }
    });

});
/**
 * 选择充值方式
 */
$(function(){
    $('.else input').focus(function(){
       $(this).closest("dl").children("dd").find("input:radio").attr({checked:false});
    });
});
/**
 * 计算中奖几率
 *
 * @param val   数量
 * @param input 数量输入框对象
 *
 * @return void
 */
function countPercent(val, input) {
    if($('#percent').length > 0) {
        var total = input.attr('amount');
        var percent =val/parseInt(total)*100;
        $('#percent').html(percent.toFixed(2) + '%');
    }
}

/**
 * 更新购物车
 *
 * @param qty        数量
 * @param input      数量输入框对象
 * @param beforeQty  改变前的数量
 *
 * @return void
 */
function updateCart(qty, input, beforeQty) {
    if($('.cart-list').length > 0) {
        var id = input.attr('rowId');
        $.ajax({
            url: BASE_URL + 'cart/modify',
            data: {id:id, qty:qty},
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if(data.status == 'success') {
                    input.val(qty);
                } else {
                    input.val(beforeQty);
                }
            }
        });
    }
}

/**
 * 购物车下拉效果
 */
$(function(){
    $(".shopping-cart").hover(function(){
        var $this = $(this);
        $.ajax({
            url: BASE_URL + 'cart/info',
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
                $this.find('.dropdown-list').html('<li>加载中...</li>');
            },
            success: function(data) {
                var html = '';
                if(data.length > 0) {
                    for(var i in data) {
                        html += '<li><div class="img-box img-sm fl">';
                        html += '<a href="'+BASE_URL + 'm/' + data[i].id +'"><img src="'+BASE_URL + data[i].image+'" alt=""></a>';
                        html += '</div><div class="info-side fl"><div class="title-md">';
                        html += '<a href="'+BASE_URL + 'm/' + data[i].id +'">'+data[i].title+'</a>';
                        html += '</div><div class="price tl">'+data[i].point+ data[i].unit +' x <b class="y">'+data[i].qty+'</b></div>';
                        html += '<a href="javascript:void(0);" class="cartRemove btn-delete" rowId="'+data[i].rowId+'">删除</a></div></li>';
                    }
                    html += '<div class="btn-group tr"><a href="'+BASE_URL + 'cart/list' + '" class="btn-red  btn">查看购物车</a></div>';
                } else {
                    html = '<li>购物车是空的</li>';
                }
                $this.find('.dropdown-list').html(html);
            }
        });
        $(this).addClass("shp-c-h");
        $(this).find(".dropdown-list").css({"display":"block"})

    }, function(){
        $(this).removeClass("shp-c-h");
        $(this).find(".dropdown-list").css({"display":"none"})
    });

    // 购物车删除
    $(document).on('click', '.cartRemove', function() {
        var $this = $(this);
        var id = $this.attr('rowId');
        $.ajax({
            url: BASE_URL + 'cart/del',
            data: {id:id},
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if(data.status == 'success') {
                    $this.parent().parent().remove();
                    if($('.dropdown-list').find('li').length == 0) {
                        $('.dropdown-list').html('<li>购物车是空的</li>');
                    }

                    var count = $('.item-cart').find('s').html();
                    count = parseInt(count);
                    $('.item-cart').find('s').html(count-1);
                }
            }
        });
    });

    // 添加购物车效果
    $('.doCart').click(function () {
        var cart = $('.item-cart');
        var imgtodrag = $(this).parent().prev().prev().prev().find("a").eq(0);

        var id = $(this).attr('phaseId');
        var qty = $(this).parent().prev().find('input').val();
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top-90,
                left: imgtodrag.offset().left
            })
            .css({
                'opacity': '0.7',
                'position': 'absolute',
                'height': '200px',
                'width': '200px',
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
                // 提交到后台
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

// 初始化ajax分页
INIT_PAGE = 1;

// 拉取参与记录
function joined(page) {

    var phaseId = $('a[href="#buylog"]').attr('phaseId');

    // 上一页
    if(page === '-1') {
        page = INIT_PAGE - 1;
    }
    // 下一页
    if(page === '+1') {
        page = INIT_PAGE +1;
    }

    INIT_PAGE = page;

    $.ajax({
        url: BUYLOG_URL,
        data: {phaseId:phaseId, page:page},
        type: 'get',
        dataType: 'json',
        success: function(data) {
            handleJoined(data);
        }
    });
}


// 拉取晒单信息
function posts(page) {
    var itemId = $('a[href="#posts"]').attr('itemId');

    // 上一页
    if(page === '-1') {
        page = INIT_PAGE - 1;
    }
    // 下一页
    if(page === '+1') {
        page = INIT_PAGE +1;
    }

    INIT_PAGE = page;

    $.ajax({
        url: POSTLOG_URL,
        data: {itemId:itemId, page:page},
        type: 'get',
        dataType: 'json',
        success: function(data) {
            handlePosts(data);
        }
    });
}

// 拉取期数信息
function phases(page) {

    var itemId = $('a[href="#phase"]').attr('itemId');

    // 上一页
    if(page === '-1') {
        page = INIT_PAGE - 1;
    }
    // 下一页
    if(page === '+1') {
        page = INIT_PAGE +1;
    }

    INIT_PAGE = page;

    $.ajax({
        url: PHASELOG_URL,
        data: {itemId:itemId, page:page},
        type: 'get',
        dataType: 'json',
        success: function(data) {
            handlePhases(data);
        }
    });
}

// 渲染参与记录
function handleJoined(data) {
    if(!jQuery.isEmptyObject(data.orders)) {
        var html = '<table><thead><tr><th>会员帐号</th><th>数量/人次</th><th>时间</th><tr></thead><tbody>';
        for(var i in data.orders) {
            html += '<tr>' +
                    '    <td>'+
                    '        <span class="head-sm fl"><a href="'+data.orders[i].link+'"><img src="'+data.orders[i].avatar+'" alt=""/></a></span>'+
                    '        <span class="username fl"><a href="'+data.orders[i].link+'">'+data.orders[i].nickname+'</a></span>'+
                    '        <span class="ip fl">来自：'+data.orders[i].area+'（IP:'+data.orders[i].ip+'）</span>'+
                    '    </td>'+
                    '    <td>'+data.orders[i].count+'</td>'+
                    '    <td>'+data.orders[i].created_at+'</td>'+
                    '<tr>';
        }

        html += '</tbody></table>';

        $('#buylog').html(html).append(data.page);
    }
}

// 渲染晒单记录
function handlePosts(data) {
    if(!jQuery.isEmptyObject(data.posts)) {
        var html = '<ul>';

        var images = '';
        for(var i in data.posts) {
            images = '';
            for(var j in data.posts[i].images) {
                images += '<dd class="img-box img-md"><a href="'+BASE_URL+ data.posts[i].images[j]+'" target="_blank"><img src="'+BASE_URL+ data.posts[i].images[j]+'" alt=""></a></dd>';
            }

            html += '<li>' +
                    '<div class="fl">'+
                         '<div class="head-img">' +
                             '<a href="'+BASE_URL + 'u/' + data.posts[i].member_id+'"><img src="'+data.posts[i].avatar+'" alt=""></a>'+
                         '</div>'+
                         '<div class="username"><a href="'+BASE_URL + 'u/' + data.posts[i].member_id+'">'+data.posts[i].nickname+'</a></div>'+
                    '</div>'+
                    '<div class="bask-list fr">'+
                    '    <h4 class="text-title"><a href="'+BASE_URL+ 'p/' + data.posts[i].id+'">'+data.posts[i].title+'</a></h4>'+
                    '    <div class="datetime">'+data.posts[i].created_at+'</div>'+
                    '    <div class="bask-text">'+data.posts[i].desc+'</div>'+
                    '    <dl class="bask-imgBox">' + images + '</dl>'+
                    '    <div class="btn-group sns-bar tl">'+
                    '        <span class="sns-love">喜欢<s>('+data.posts[i].up+')</s></span'+
                    '        <span class="sns-comment">评论<s>('+data.posts[i].count+')</s></span>'+
                    '    </div>'+
                    '    <div class="bask-number">'+'第'+data.posts[i].phase+'期晒单'+'</div>'+
                    '</div>'+
                    '</li>';
        }

        html += '</ul>';

        $('#posts').html(html).append(data.page);
    }
}

// 渲染期数记录
function handlePhases(data) {

    if(!jQuery.isEmptyObject(data.phases)) {
        var html = '<table><thead><tr><th>期数</th><th>幸运乐拍码</th><th>幸运获奖者</th><th>揭晓时间</th><th>购买数量</th><tr></thead><tbody>';
        for(var i in data.phases) {
            var code = typeof(data.phases[i].code) == 'undefined' ? '进行中...' : data.phases[i].code;
            var member = typeof(data.phases[i].member) == 'undefined' ? '' : data.phases[i].member;
            var opentime = typeof(data.phases[i].opentime) == 'undefined' ? '' : data.phases[i].opentime;
            var total = typeof(data.phases[i].total) == 'undefined' ? '' : data.phases[i].total;
            if(opentime && code =='进行中...') {
                opentime = '';
                code = '即将揭晓';
            }
            html += '<tr>' +
                    '   <td>' + data.phases[i].phase + '</td>'+
                    '   <td>'+code+'</td>'+
                    '   <td>'+member+'</td>'+
                    '   <td>'+opentime+'</td>'+
                    '   <td>'+total+'</td>'+
                    '<tr>';
        }

        html += '</tbody></table>';

        $('#phase').html(html).append(data.page);
    }
}

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
        var c = $.cookie('userlogin');
        if (c!=true){
             $(".login2").fadeIn("fast");
             $("body").append("<div id='greybackground'></div>");
             var documentheight = $(document).height();
             $("#greybackground").css({"opacity":"0.5","height":documentheight});
             return false;
        }
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


$(function(){
        // 向下滚动
        var _BuyList=$(".buyList");
        var Trundle = function () {
            _BuyList.prepend(_BuyList.find("li:last")).css('marginTop', '-100px');
            _BuyList.animate({ 'marginTop': '0px' }, 800);
        }
        var setTrundle = setInterval(Trundle, 3000);
        _BuyList.hover(function () {
            clearInterval(setTrundle);
            setTrundle = null;
        },function () {
            setTrundle = setInterval(Trundle, 3000);
        });

    //左右滚动
    if($(".scrollleft").length > 0){
        //二、左右切换：最后一个显示在最右侧;
        $(".scrollleft").Xslider({
            unitdisplayed:5,
            numtoMove:1
        });

        $("a").focus(function(){this.blur();});
    }
})
/**/
$(function(){
    $(".tooltip").click(function(){
          var num_list=$(this).next(".num-list");
           if(num_list.css("display")=="none"){
              num_list.css({display:"block"});
           }
           else{
              num_list.css({display:"none"});
           }
      });
});

// 收藏
function addFavorite(sURL, sTitle)
{
    try
    {
        window.external.addFavorite(sURL, sTitle);
    }
    catch (e)
    {
        try
        {
            window.sidebar.addPanel(sTitle, sURL, "");
        }
        catch (e)
        {
            alert("加入收藏失败，请使用Ctrl+D进行添加");
        }
    }
}

