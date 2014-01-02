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

});

/**
 * 计算中奖记录
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
                    '        <span class="head-img-sm fl"><a href="'+data.orders[i].link+'"><img src="'+data.orders[i].avatar+'" alt=""/></a></span>'+
                    '        <span class="name fl">'+data.orders[i].nickname+'</span>'+
                    '        <span class="ip fl">（IP:'+data.orders[i].ip+'）</span>'+
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

        for(var i in data.posts) {
            html += '<li>' +
                    '<div class="head-img fl">' +
                    '    <a href=""><img src="'+data.posts[i].avatar+'" alt=""></a>'+
                    '    <div class="name"><a href="">'+data.posts[i].nickname+'</a></div>'+
                    '</div>'+
                    '<div class="bask-list fr">'+
                    '    <h4 class="text-title">'+data.posts[i].title+'</h4>'+
                    '    <div class="datetime">'+data.posts[i].created_at+'</div>'+
                    '    <div class="bask-text">'+data.posts[i].desc+'</div>'+
                    '    <dl class="bask-imgBox">'+
                    '        <dd class="img-box">'+
                    '            <a href=""><img src="img/54359.jpg" alt=""></a>'+
                    '        </dd>'+
                    '        <dd class="img-box">'+
                    '            <a href=""><img src="img/54359.jpg" alt=""></a>'+
                    '        </dd>'+
                    '        <dd class="img-box">'+
                    '            <a href=""><img src="img/54359.jpg" alt=""></a>'+
                    '        </dd>'+
                    '    </dl>'+
                    '    <div class="btn-group tl">'+
                    '        <span>喜欢<s>('+data.posts[i].up+')</s></span'+
                    '        <span>评论<s>('+data.posts[i].count+')</s></span>'+
                    '    </div>'+
                    '    <div class="bask-number">'+'第1期晒单'+'</div>'+
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

