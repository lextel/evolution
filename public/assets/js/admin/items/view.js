$(function(){

   // 参与者拉取
    $('a[href="#buylog"]').click(function() {
        joined(1);
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
// 渲染参与记录
function handleJoined(data) {
    if(!jQuery.isEmptyObject(data.orders)) {
        var html = '<table class="table table-striped"><thead><tr><th>会员帐号</th><th>数量/人次</th><th>时间</th><tr></thead><tbody>';
        for(var i in data.orders) {
            html += '<tr>' +
                    '    <td>'+
                    '        <span class="head-sm fl"><a href="'+data.orders[i].link+'"><img style="width: 40px;height:40px" src="'+data.orders[i].avatar+'" alt=""/></a></span>'+
                    '        <span class="username fl">'+data.orders[i].nickname+'</span>'+
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


