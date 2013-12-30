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

    // 参与者拉取
    $('a[href="#buylog"]').click(function() {
        joined(1);
    });

    $(".btn-jia").click(function (){
        alert(1);
        //$(this).val();
     });

});

// 拉去参与记录
function joined(page) {
    var phaseId = $('a[href="#buylog"]').attr('phaseId');

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

// 渲染参与记录
function handleJoined(data) {
    if(data.orders) {
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
