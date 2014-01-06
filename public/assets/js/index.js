$(function(){

    // 倒计时渲染函数
    var render = function(min, sec, msec, obj) {
        var html = '揭晓倒计时 :' + min + ':' + sec + ':' + msec;
        obj.html(html);
    }

    // 倒计时渲染结果
    var renderDiv = function(id, data) {
        html = '获奖者:<b><a class="bule" href="'+data.userlink+'">'+data.nickname+'</a></b>';
        var obj = $('#win' + id).removeClass('countdown');
        obj.next().hide();
        obj.html(html);
        obj.show();
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
                obj.next().show();

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

        }, 1000);
    });
});

$(function(){
          $('.bxslider').bxSlider();
});

