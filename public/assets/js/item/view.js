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

    $(".btn-jia").click(function (){
        alert(1);
        //$(this).val();
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

    // 滚动到描点
    $(document).on('click', '#bigNav > ul > li, .pagination > span > a', function() {
        var obj = $('#bigNav');
        scrollToAnchor(obj);
    });
});

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

// 滚动到相应描点
function scrollToAnchor(obj) {
    $("html,body").animate({scrollTop: obj.offset().top}, 200);
}
