//拉取评论列表
function getCommentList(page){
     if (page == "#"){
         return false;
     }
     
     $.get(page+"?callback="+new Date().getTime(), function(data){
            if (data.code==0){
               $('.comment-list').html('');
               $('.comment-list').append('<dt><h4>全部评论</h4></dt>');
               $.each(data.list, function(index, li) {
                 var text = comment(li.member);
                 $('.comment-list').append(text);
               });
               var page = data.page;             
               $('.comment-list').append(page);
               $('.pagination').addClass('comment');
            }
            });
}

//总增加评论区
function comment(member){
    var text = '<dd>'
    text += '<div class="head-img fl"><a href="/u/'+member.userid+'"><img src="'+member.avatar+'" alt=""/></a></div>'
    text += '<div class="info-side"><span><a href="/u/'+member.userid+'" class="username">'+member.nickname+'</a>' +
     '&nbsp;&nbsp;<s class="datetime">'+member.date+'</s></span>'
    text += '<div class="comment-text">'+member.text+'</div>'
    return text;
}
//评论数 + 1 效果
function comment_countup(){
    var count =  $(".btn-comment").find("s").html();
    $(".btn-comment").find("s").html(parseInt(count) + 1);
}

//JS AJAX调用
function getDataUp(postid, v){

     $.get("/p/up/"+postid+"?callback=" + new Date().getTime(), function(data){
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
    $.fn.extend({
        addOne: function(options) {
            options = $.extend({
                str: "+1",
                startSize: "14px",
                endSize: "40px",
                interval: 500,
                color: "red",
                style: "",
                callback: function() {}
            }, options);

            $("body").append("<span class='tips_box' style='"+ options.style +"'>"+ options.str +"</span>");
            var box = $(".tips_box");
            var self = $(this);
            var top = self.offset().top;
            var left = self.offset().left + self.width() / 2 - box.width() / 2;
            //alert(layer.width());
            box.css({
                "position": "absolute",
                "top": top,
                "left": left,
                "font-size": options.startSize,
                //"font-weight": "bold",
                "color": options.color
            });
            box.animate({
                "top": top - self.height() / 2,
                "opacity": 0,
                "font-size": options.endSize
            }, options.interval, function() {
                box.remove();
                options.callback();
            });
        }
    });
});

$(function(){
    var screenwidth,screenheight,mytop,getPosLeft,getPosTop;
    screenwidth = $(document).width();
    screenheight = $(document).height();
    mytop = $(document).scrollTop();
    getPosLeft = screenwidth/2 - 260;
    getPosTop = (screenheight-mytop)/4;
    $(".login2").css({"left":getPosLeft,"top":getPosTop});
    $(window).resize(function(){
        screenwidth = $(window).width();
        screenheight = $(window).height();
        mytop = $(document).scrollTop();
        getPosLeft = screenwidth/2 - 260;
        getPosTop = (screenheight-mytop)/2-200;
        $(".login2").css({"left":getPosLeft,"top":getPosTop+mytop});
    });
    $(window).scroll(function(){
        screenwidth = $(window).width();
        screenheight = $(document).height();
        mytop = $(document).scrollTop();
        getPosLeft = screenwidth/2 - 260;
        getPosTop = (screenheight-mytop)/4;
        $(".login2").css({"left":getPosLeft,"top":getPosTop+mytop});
    });
     //点击刷新喜欢
     $('.sns-love').click(function(){
        var postid =  this.id;
        var up =  $(this).find("s").html();
        var w = $(this);
        var c = $.cookie('postup');
        if (c == null || c == "") {
            c = ",";
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
         var c = $.cookie('userlogin');
         var ccomment = $.cookie('comment');
         if(c==true) {  
            if (ccomment == null || ccomment == ""){
               ccomment = ",";
            }
            var postid = $(".postid").attr("id");
            if (ccomment.indexOf("," + postid + ",") >= 0) {
                alert("你今天已经评论过了");
                return false;
            }
            var url = "/comment/"+postid+"/add";
            var text = $("#comment").val();
            $.post(url ,{text:text},function(data){
             if (data.code==0){
                 var text = comment(data.member);
                 $('.comment-list dt').after(text);
                 comment_countup();
                 $("#comment").val('');
                 $(".btn-commentcount").find("s").html(200);
                 ccomment += postid + ",";
                 $.cookie('comment', ccomment, {
                                  expires:1,
                                  path:"/"
                 });

                 if ($(".comment-list dd").length > 4){
                    getCommentList('/comment/'+postid+'/p/1');
                 }
             }
           });
           return true;
         } else {
             $(".login2").fadeIn("fast");
             $("body").append("<div id='greybackground'></div>");
             var documentheight = $(document).height();
             $("#greybackground").css({"opacity":"0.5","height":documentheight});
             return false;
        }
     });
     upcookie();
     
     var postid = $(".postid").attr("id");
     if (postid!=undefined){
         getCommentList('/comment/'+postid+'/p/1');
     }
});

