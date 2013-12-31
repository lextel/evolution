//拉取评论列表
function getCommentList(page){
     var postid = $(".postid").attr("id");
     $.get("/comment/"+postid+"/p/"+page+"?callback="+Math.floor(Math.random()*100000000), function(data){
            if (data.code==0){
               $('.comment-list').html('');
               $.each(data.list, function(index, li) {
                 console.log(li.member);
                 comment(li.member);
               });
               var page = data.page;
               //page = page.replace(/\/c\/p\/(\d+)/g, "javascript:gotoPage($1);");
               //page = page.replace(/#/g, "javascript:;");
               
               $('.comment-list').append(page);
               $('.pagination').addClass('comment');
            }
            });
}

//总增加评论区
function comment(member){
    var text = '<dd>'
    text += '<div class="head-img fl"><a href="/u/'+member.userid+'"><img src="/'+member.avatar+'" alt=""/></a></div>'
    text += '<div class="info-side"><div class="info-side-head"><span class="name blue"><a href="/u/'+member.userid+'">'+member.nickname+'</a></span>'
    text += '<span class="datetime">'+member.date+'</span></div><div class="comment-text">'+member.text+'</div>'
    $('.comment-list').append(text);
}
//评论数 + 1 效果
function comment_countup(){
    var count =  $(".btn-comment").find("s").html();
    $(".btn-comment").find("s").html(parseInt(count) + 1);
}

//JS AJAX调用
function getDataUp(postid, v){
     $.get("/p/up/"+postid+"?callback=" + Math.floor(Math.random()*100000000), function(data){
                v(data);
                });
}

//列表页喜欢列表
//刷新页面同时检测cookie里是否有喜欢数据
function upcookie(){
    var c = $.cookie('postup');
    if (c == null || c == "") {
        c = ","
    }
    var cs = c.split(",");
    for(var i= 1; i<cs.length;i++){
        var up = $("#"+cs[i]).find("s").html();

        $("#"+cs[i]).html("已喜欢(<s>"+up+"</s>)");
    }
}

function cpage(id){
    getCommentList(id);
}
$(function(){    
     //点击刷新喜欢
     $('.btn-up').click(function(){
        var postid =  this.id;
        var up =  $(this).find("s").html();
        var w = $(this);
        var c = $.cookie('postup');
        if (c == null || c == "") {
            c = ","
        }
        if (c.indexOf("," + postid + ",") >= 0) {
            w.html("已喜欢(<s>"+up+"</s>)");
        } else {
            getDataUp(postid, function(data){
                    if (data.code == 0) {
                        c = c + postid + ",";
                        $.cookie('postup', c, {
                                  expires:1,
                                  path:"/"
                             });
                        w.html("已喜欢(<s>" + (parseInt(up) + 1) + "</s>)");
                    }
                    });
        }
     });

     //添加评论
     $(".btn-comment").click(function(){
         var postid = $(".postid").attr("id");
         var url = "/comment/"+postid+"/add";
         var text = $("#comment").val();
         $.post(url ,{text:text},function(data){
             if (data.code==0){
                 comment(data.member);
                 comment_countup();
             }
         });
     });

     upcookie();
     getCommentList(1);

});

