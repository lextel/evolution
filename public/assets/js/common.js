/**
 * 往期晒单滚动效果
 */
(function($){
    $.fn.extend({
        Scroll:function(opt,callback){
            //参数初始化
            if(!opt) var opt={};
            var _btnUp = $("#"+ opt.up);//Shawphy:向上按钮
            var _btnDown = $("#"+ opt.down);//Shawphy:向下按钮
            var timerID;
            var _this=this.eq(0).find("ul:first");
            var     lineH=_this.find("li:first").height(), //获取行高
                line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10), //每次滚动的行数，默认为一屏，即父容器高度
                speed=opt.speed?parseInt(opt.speed,10):500; //卷动速度，数值越大，速度越慢（毫秒）
            timer=opt.timer //?parseInt(opt.timer,10):3000; //滚动的时间间隔（毫秒）
            if(line==0) line=1;
            var upHeight=0-line*lineH;
            //滚动函数
            var scrollUp=function(){
                _btnUp.unbind("click",scrollUp); //Shawphy:取消向上按钮的函数绑定
                _this.animate({
                    marginTop:upHeight
                },speed,function(){
                    for(i=1;i<=line;i++){
                        _this.find("li:first").appendTo(_this);
                    }
                    _this.css({marginTop:0});
                    _btnUp.bind("click",scrollUp); //Shawphy:绑定向上按钮的点击事件
                });


            }
            //Shawphy:向下翻页函数
            var scrollDown=function(){
                _btnDown.unbind("click",scrollDown);
                for(i=1;i<=line;i++){
                    _this.find("li:last").show().prependTo(_this);
                }
                _this.css({marginTop:upHeight});
                _this.animate({
                    marginTop:0
                },speed,function(){
                    _btnDown.bind("click",scrollDown);
                });
            }
            //Shawphy:自动播放
            var autoPlay = function(){
                if(timer)timerID = window.setInterval(scrollUp,timer);
            };
            var autoStop = function(){
                if(timer)window.clearInterval(timerID);
            };
            //鼠标事件绑定
            _this.hover(autoStop,autoPlay).mouseout();
            _btnUp.css("cursor","pointer").click( scrollUp ).hover(autoStop,autoPlay);//Shawphy:向上向下鼠标事件绑定
            _btnDown.css("cursor","pointer").click( scrollDown ).hover(autoStop,autoPlay);
        }
    })
})(jQuery);
$(document).ready(function(){
    $("#scrollDiv").Scroll({line:1,speed:500,timer:3000,up:"prev",down:"next"});
});

/**
 *顶部设置鼠标滑过效果
 */
$(function(){

    $(".info-wide .info-user").hover(
        function(){
            $(".info-user a").toggleClass("open");
            //$(".info-user .x").css("color","#C10101");
            $(this).children(".head-set").css({display:"block"})},
        function(){
            $(".info-user a").toggleClass("open")
            //$(".info-user .x").css("color","#666");
            $(this).children(".head-set").css({display:"none"})}
    );
});
/**
 *返回顶部--侧边浮动快捷栏
 */
$(function(){
    var w_width=$(window).width();
    var w_height=$(window).height();
    $(".weiXin").css({right:(w_width-980)/2-142,top:w_height/4});
    var getRight=(w_width-980)/2-70
    $(".short-cut").show();
    $(".short-cut").css({right:getRight});
    $(window).resize(function(){
        var screenWidth = $(window).width();
        var screenHeight = $(window).height();
        var getRight=(screenWidth-980)/2-77
        $(".short-cut").css({right:getRight});
        $(".weiXin").css({right:(screenWidth-980)/2-148,top:screenHeight/4});
    });
    $(".weiXin-img button").click(function(){
        $(this).parents(".weiXin").fadeOut(1000);
    });
    /*返回顶部*/
    $(".item-gotTop").click(function(){
        $("body,html").animate({scrollTop:0},300)
    });
});
/*关闭按钮*/
$(function(){
    $(".show-form .icon-close").click(function(){
        $(this).parents(".show-form").fadeOut();
    });
    $(".num-list .icon-close").click(function(){
        $(this).parents(".num-list").fadeOut();
    });
    $(".edit-data .icon-close").click(function(){
        $(this).parents(".edit-data").fadeOut();
    });
});
/*用户中心折叠效果*/
$(function(){
    $(".dropdown a").click(function(){
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
        $("#greybackground").css({"opacity":"0.5","backgroundColor":"#000000","height":documentheight});
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
            alert('数量不能小于1元宝');
            val = 1;
            $(this).select();
        }

        var remain = $(this).attr('remain');
        if(val > parseInt(remain)) {
            alert('数量不能大于还需元宝');
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
            alert('购买数量不能大于还需元宝');
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
            alert('购买数量不能小于1元宝');
        } else {
            var qty = val - 1;
            countPercent(qty, input);
            updateCart(qty, input, val);
            input.val(qty);
        }
    });


    //商品详情字体颜色
    $('a[href="#desc"]').click(function() {
        $(".fl").find("a").css("color","#666");
        $(this).css("color","#af2812");
    });

    // 是否是初次加载详情页，如果是拉取参与者和晒单否则copy参与者和晒单到页尾
    if($("#tab-content").length > 0) {
        initDesc();
    }

    // 参与者拉取
    $('a[href="#buylog"]').click(function() {
        $(".fl").find("a").css("color","#666");
        $(this).css("color","#af2812");
        joined(1);
    });

    // 晒单拉取
    $('a[href="#posts"]').click(function() {
        $(".fl").find("a").css("color","#666");
        $(this).css("color","#af2812");
        posts(1);
    });

    // 拉取期数
    $('a[href="#phase"]').click(function() {
        $(".fl").find("a").css("color","#666");
        $(this).css("color","#af2812");
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



// 初始化ajax分页
INIT_PAGE = 1;

// 初始化商品详情参与者和晒单
function initDesc() {

    var addtion = '';

    // 获取参与者队列
    $(document).queue("ajaxRequests", function(){
        var phaseId = $('a[href="#buylog"]').attr('phaseId');
        $.ajax({
            url: BUYLOG_URL,
            data: {phaseId:phaseId, page:1},
            type: 'get',
            dataType: 'json',
            success: function(data) {
                addtion = '<div style="background:#f5f7fa;height: 10px;"></div>'+
                          '<div id="descJoined" style="border-top:2px solid #AF2812;min-height: 80px;">'+
                          '<div style="border-bottom:1px dashed #E4E4E4;" class="title"><h3>所有参与者记录</h3></div>';
                var html = handleJoined(data, true);
                if(html) {
                    addtion += html;
                } else {
                    addtion += '<p style="text-align: center;font-size:16px;margin-top: 10px;">暂无参与记录</p>';
                }
                addtion += data.page.replace(/joined/g, 'descJoined');
                addtion += '<div style="clear:both"></div></div>';
                $(document).dequeue("ajaxRequests");
            }
        });
    });

    // 获取晒单队列
    $(document).queue("ajaxRequests", function(){
        var itemId = $('a[href="#posts"]').attr('itemId');
        $.ajax({
            url: POSTLOG_URL,
            data: {itemId:itemId, page:1},
            type: 'get',
            dataType: 'json',
            success: function(data) {
                addtion += '<div style="background:#f5f7fa;height: 10px"></div>'+
                          '<div id="descPosts" class="product-bask" style="border-top:2px solid #AF2812;min-height: 80px;">'+
                          '<div style="border-bottom:1px dashed #E4E4E4;" class="title"><h3>晒单</h3></div>';
                var html = handlePosts(data, true);
                if(html) {
                    addtion += html;
                } else {
                    addtion += '<p style="text-align: center;font-size:16px;margin-top: 10px;">暂无晒单记录</p>';
                }
                addtion += data.page.replace(/posts/g, 'descPosts');
                addtion += '<div style="clear:both"></div></div>';
                $('#desc').append(addtion);
            }
        });
    });

    $(document).dequeue("ajaxRequests");
}

// 详情参与者切页
function descJoined(page) {
    $(".fl").find("a").css("color","#666");
    $('#bigNav li:eq(1) a').tab('show').css("color", '#af2812');
    joined(page);
}
// 详情晒单切页
function descPosts(page) {
    $(".fl").find("a").css("color","#666");
    $('#bigNav li:eq(2) a').tab('show').css("color", '#af2812');
    posts(page);
}

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
            handleJoined(data, false);
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
            handlePosts(data, false);
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

//
function handleJoined(data, needReturn) {
    var bool = !jQuery.isEmptyObject(data.orders);
    if(bool) {
        var html = "<table id='handleJoineds'><thead><tr><th>会员帐号</th><th>购买数量</th><th>时间</th><tr></thead><tbody>";
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
    }

    if(!needReturn && bool) {
        $('#buylog').html(html).append(data.page);
    } else {
        return bool ? html : bool;
    }
}

// 渲染晒单记录
function handlePosts(data, needReturn) {
    var bool = !jQuery.isEmptyObject(data.posts);
    if(bool) {
        var html = "<ul>";
        var images = '';
        for(var i in data.posts) {
            images = '';
            for(var j in data.posts[i].images) {
                var oimage = data.posts[i].images[j].replace('120x120/', '');
                oimage = oimage.replace('post', 'upload/post');
                images += '<dd class="img-box img-md"><a href="'+oimage+'" target="_blank"><img src="'+data.posts[i].images[j]+'" alt=""></a></dd>';
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
                    '        <span class="sns-love">喜欢<s>('+data.posts[i].up+')</s></span>'+
                    '        <span class="sns-comment">评论<s>('+data.posts[i].count+')</s></span>'+
                    '    </div>'+
                    '    <div class="bask-number">'+'第'+data.posts[i].phase+'期晒单'+'</div>'+
                    '</div>'+
                    '</li>';
        }
        html += '</ul>';
    }

    if(!needReturn && bool) {
        $('#posts').html(html).append(data.page);
    } else {
        return bool ? html : bool;
    }
}
// 渲染期数记录
function handlePhases(data) {
    var bool = !jQuery.isEmptyObject(data.phases);
    if(bool) {
        var html = "<div class='tab-content' style='margin-top:10px;color:#848484' id='phasetwo'><div style='width:100%;height:26px;background:#F8F8F8;padding:10px;font-size:14px;color:#666;'>往期回顾</div><table><thead><tr><th>期数</th><th>幸运乐淘码</th><th>幸运获奖者</th><th>揭晓时间</th><th>购买数量</th><tr></thead><tbody>";
        for(var i in data.phases) {
            var code = typeof(data.phases[i].code) == 'undefined' ? '<span class="r">进行中...</span>' : data.phases[i].code;
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
        html += '</tbody></table></div>';
    }

    $('#phase').html(html).append(data.page);
}

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
                        html += '<a href="'+BASE_URL + 'm/' + data[i].id +'"><img src="'+ data[i].image+'" alt=""></a>';
                        html += '</div><div class="info-side fl"><div class="title-md">';
                        html += '<a href="'+BASE_URL + 'm/' + data[i].id +'">'+data[i].title+'</a>';
                        html += '</div><div class="price tl">'+showCoins(100) +' x <b class="y">'+data[i].qty+'</b></div>';
                        html += '<a href="javascript:void(0);" class="cartRemove btn-delete" rowId="'+data[i].rowId+'">删除</a></div></li>';
                    }
                    html += '<div class="btn-group tr"><a href="'+BASE_URL + 'cart/list' + '" class="btn-red underway fr btn">查看购物车</a></div>';
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
        var imgtodrag = $(this).parent().prev().prev().prev().find("a img");
        //console.log(imgtodrag);
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
                'width': 57,
                'height':57
            }, 1000);
            imgclone.animate({
                'opacity': '0',
                'width': 57,
                'height': 57
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
                            $(".item-cart s").css("display","");
                        }
                    }
                });
            });
        }
    });
});

/**
 * 评论交互效果
 */
$(function(){
    var text=$(".comment-box>textarea");
    //最大输入字数
    var word=$(".comment-footer>span>b");
    var max_num=200;
    var scr_num=0;
    var abc_num=0;
    var ie = jQuery.support.htmlSerialize;

    text.focus(function(){
        var c = $.cookie('userlogin');
        console.log($.cookie());
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
            _BuyList.prepend(_BuyList.find("li:last")).css('marginTop', '-77px');
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
/**
* 显示所有乐淘码
**/
$(function(){
    $(".tooltip").click(function(){
          var num_list=$(this).next("#num-list");
           if(num_list.css("display")=="none"){
              num_list.css({display:"block"});
           }
           else{
              num_list.css({display:"none"});
           }
      });
});
$(function(){
    $(".icon-shut").click(function(){
        $(this).parent().hide();
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


$(function (){
    //隐藏期数
    if(24 < $(".periodList ul").find("li").length){
        var phase = $(".periodList ul").find("li").eq(23);
        phase.nextAll().hide();
        $(".btn-periods").show();

        //单击展开
    $(".btn-periods").bind("click",function (){

        //期数展开箭头切换*
        $(this).toggleClass("open");
        if("展开" == $(this).text()){
            $(this).html("收起<i></i>");
            phase.nextAll().show();
        }else{
            $(this).html("展开<i></i>");
            phase.nextAll().hide();
        }
    });
    }
});

//当前乐淘人数
$(function(){
    getTotalBuy();
    setInterval(getTotalBuy,3000);
});


function getTotalBuy(){
    $.get(BASE_URL+"totalbuycount?callback="+ new Date().getTime(), function(data){
        if (data.code==0){
            if($("#totalbuy").html() != data.num){
                $("#totalbuy").css('backgroundColor', '#af2812');
                $("#totalbuy").css('color', '#FFF');
                $("#totalbuy").animate({
                     'opacity': '0.4'
                },800,function(){
                     $("#totalbuy").css('backgroundColor', '#FFF');
                     $("#totalbuy").css('color', '#2af');
                     $("#totalbuy").html(data.num);
                });

                $("#totalbuy").animate({
                    'opacity': '1'
                },100);
            }
        }
    });
}


function cleardata(){
    if($("#copyJoinedid").length>0){
        $("#copyJoinedid").remove();
    }
    if($("#poststwo").length>0){
        $("#poststwo").remove();
    }
}
