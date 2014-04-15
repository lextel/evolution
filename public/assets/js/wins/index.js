$(function() {

    // 人气切换效果
    $('.shortItem').hover(function(){
        $('.longItem').hide();
        $('.shortItem').show();
        $(this).hide();
        $(this).next().show();
    });

    // 倒计时渲染函数
    var render = function(min, sec, msec, obj) {
        var html = '<dt>揭晓倒计时:</dt>';
        html += '<dd class="num">' + min + '</dd>';
        html += '<dd>:</dd>';
        html += '<dd class="num">' + sec + '</dd>';
        html += '<dd>:</dd>';
        html += '<dd class="num">' + msec + '</dd>';
        obj.html(html);
    }

    // 倒计时渲染结果
    var renderDiv = function(id, data) {
        $('#win' + id + ' .item-body').remove();
        $('#win' + id + ' .item-footer').remove();
        var html = '<div class="item-body">';
        html += '<div class="img-box img-md fl">';
        html += '<a href="'+data.link+'" rel="nofollow"><img src="'+data.image+'"></a>';
        html += '</div>';
        html += '<div class="info-side fr">';
        html += ' <div class="h-info">';
        html += '    <div class="head-img fl">';
        html += '    <a href="'+data.userlink+'"><img src="'+data.avatar+'"></a>';
        html += '    </div>';
        html += '    <div class="user-info fl">';
        html += '       <div class="username">获奖者：<b><a href="'+data.userlink+'">'+data.nickname+'</a></b></div>';
        html += '       <div class="ip">来自：'+data.area+'</div>';
        html += '    </div>';       
        html += ' </div>';
        html += ' <div class="p-info">';
        html += '   <div class="number">当前乐淘:<b>'+data.count+'</b>人次</div>';
        html += '   <div class="datetime">揭晓时间：'+data.opentime+'</div>';
        html += ' </div>';
        html += '</div></div>';
        html += '<div class="item-footer"><div class="lucky-code fl">';
        html += '<b>幸运乐淘码:</b><s class="r">'+data.code+'</></div>';
        html += '<a class="btn btn-red latest-btn fr" href="'+data.link+'">查看详情</a></div>';

        $('#win' + id).removeClass('active');
        $('#win' + id + ' .item-head').after(html);
    }

    // 倒计时效果
    $('.countdown').each(function() {
        var obj = $(this);
        var t = obj.attr('endtime');
        var id = obj.attr('phaseId');
        
        var timer = setInterval(function() {
            var endtime = new Date(t);  
            var nowtime = new Date();  
            var second = parseInt((endtime.getTime()-nowtime.getTime())/1000);  
            var min = parseInt((second/60)%60);  
            var sec = parseInt(second%60);  
            var msec = nowtime.getMilliseconds();

            if(min < 10) {
                min = '0' + min.toString();
            }

            if(sec < 10) {
                sec = '0' + sec.toString();
            }

            msec = (msec/10).toFixed(0);
            if(msec < 10) {
                msec = '0' + msec.toString();
            } else if(msec == 100) {
                msec = 10;
            }

            if(second <= 0) {
                clearInterval(timer);
                // 切换计算中
                obj.hide();
                obj.parent().next().show();

                var loadTimer = setInterval(function() {
                   // 获取揭晓结果
                   $.ajax({
                        url: RESULT_URL,
                        type: 'get',
                        data: {id:id},
                        dataType:'json',
                        success: function(data) {
                            if(data.status == 'fail') {
                                clearInterval(loadTimer);
                            } else {
                                if(typeof(data.data) != 'undefined') {
                                    renderDiv(id, data.data);
                                    clearInterval(loadTimer);
                                }
                            }
                        }
                   });
                }, 3000);
            } else {
                render(min, sec, msec, obj);
            }

        }, 40);
    });
});
