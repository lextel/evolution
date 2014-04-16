<?php 
echo Asset::css(
    [
        'jquery.fileupload.css', 
        'admin/items/form.css', 
        ]
    );
echo Asset::js(
        [
            'jquery.ui.widget.js',
            'jquery.iframe-transport.js',
            'jquery.fileupload.js',
            ]
        ); 
?>
<script type="text/javascript">
$(function(){
    UPLOAD_URL = "<?php echo Uri::create('u/posts/upload'); ?>";
    IMAGE_URL  = "<?php echo Uri::create('/'); ?>";
    
    //进入提交晒单
    $(".btn-addpost").click(function(){
        var id = $(this).attr('id');
        $("#postid").val(id);
        $(".show-form").show();
    });
    //取消晒单
    $(".chance").click(function(){
        var id = $(this).attr('id');
        $("#postid").val('');
        $(".show-form").hide();
    });
    //删除图片
    $("body").on('click', '.delete', function(){
        $(this).parent().remove();
    });
    //上传图片
    $("body").on('click', '#postUpload', function(){
    
    $('#postUpload').fileupload({
        url: UPLOAD_URL,
        dataType: 'json',
        add: function (e, data) {
            // 限制5张图片
            var num = $(".postimg dd img").length + data.originalFiles.length;
            if(10 < data.originalFiles.length || 10 < num){
                alert("不能超过10张图片");
                return false;
            }
            data.submit();
        },
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                var text = '<dd class="img-box"><img src="/'+file.link+'" alt="" /><input type="hidden" name="images[]" value="'+file.link+'"><a href="javascript:;" class="delete"></a></dd>';
                $(".postimg").append(text);
            });
            
        },
      }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
});
</script>
<div class="content-inner">
        <!--晒单开始-->
        <div class="show-box">
            
            <!--查看晒单详情-->
                <?php echo Form::open(['action' => 'u/posts/add/', 'class'=>'demoform']);?>
                <ul class="edit-data">
                    <li>
                        <label for=""></label>
                        <p style="font-size:14px"><?php echo Html::anchor("/w/".$phase->id, "第(".$phase->phase_id.")期".$phase->title);?>
                        </p>
                    </li>
                    <li>
                        <label for=""></label>
                        <p style="font-size:14px"><?php echo Html::img(\Helper\Image::showImage($phase->image, '160x160'), ['style'=>'width:80px']);?>
                        </p>
                    </li>
                    <li>
                        <label for="">标题：</label>
                        <?php echo Form::input('title', Input::get('title'), ['class' =>'txt', 'name'=>'', 'datatype'=>'title', 'nullmsg'=>'请输入标题内容', 'sucmsg'=>' ']);?>
                        <span id="titlemsg" class="Validform_checktip"></span>
                    </li>
                    <li>
                        <label for="" class="body-label">正文：</label>
                        <?php echo Form::textarea('desc', Input::get('desc'), ['class' => 'txt', 'name'=>'',
                                           'datatype'=>'desc', 'rows'=>'15', 'cols'=>'20', 'nullmsg'=>'请输入正文', 'sucmsg'=>' ']);?>
                        
                    </li>
                    <li style="height:23px;margin-top:-14px;">
                        <label for="" class="body-label"></label><span id="descmsg" class="Validform_checktip" style="margin-top:-1px;"></span>
                    </li>
                    <li>
                       <div class="destItem">
                        <div class="title">
                             <h4 class="fl">晒单图片，可以上传<s class="red">10</s>张</h4>
                             <div class="add-images" title="上传图片">
                                    上传图片
                                   <input id="postUpload" type="file" name="post" multiple="上传图片" class="add-images2">
                              </div>
                         </div>
                        <dl class="postimg">
                            
                        </dl>
                        </div>
                    </li>
                    <li>
                        <input id="postid" name="phase_id" type="hidden" value="<?php echo $phase->id;?>" />
                    </li>             
                    <li>
                        <button class="btn-red  btn-address">发布</button>
                        <a href="/u/noposts" class="btn-sx btn-cancel">返回</a>
                    </li>
                </ul>
                <?php echo Form::close();?>
        </div>
</div>
<script>
$(function(){
	$(".demoform").Validform({
        btnSubmit: ".btn-address",
        tiptype:function(msg,o,cssctl){
            if(o.obj.attr("id") =="form_title"){
                var objtip=$("#titlemsg");
                cssctl(objtip,o.type);
                objtip.text(msg);
            }
            if(o.obj.attr("id") =="form_desc"){
                var objtip=$("#descmsg");
                cssctl(objtip,o.type);
                objtip.text(msg);
            }
        },
        datatype:{
           'title':function (gets,obj,curform,regxp){
                if(0!=gets.length){
                    obj.next().css("display","none");
                    return true;
                }
                obj.next().css("display","");
                return false;
           },
           'desc':function (gets,obj,curform,regxp){
                if(0!=gets.length){
                    obj.parent().next().find("span").css("display","none");
                    return true;
                }
                obj.parent().next().find("span").css("display","");
                return false;
           }
        }
	});
});
</script>
