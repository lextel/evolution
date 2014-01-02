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
        var html = '<dt>倒计时</dt>';
        html += '<dd>' + min + '</dd>';
        html += '<dt>:</dt>';
        html += '<dd>' + sec + '</dd>';
        html += '<dt>:</dt>';
        html += '<dd>' + msec + '</dd>';
        obj.html(html);
    }

    // 倒计时效果
    $('.countdown').each(function() {
        var obj = $(this);
        var t = obj.attr('endtime');

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
                // TODO 请求后端获取计算结果
                render('00','00', '00', obj);
            } else {
                render(min, sec, msec, obj);
            }

        }, 1000);
    });
});
