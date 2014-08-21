<?php
echo Asset::css(
    [
        'jquery.fileupload.css',
        'admin/items/form.css',
        ]
    );
echo Asset::js(
        [
            // 'jquery.ui.widget.js',
            // 'jquery.iframe-transport.js',
            // 'jquery.fileupload.js',
            'md5.js',
            'qiniu.js',
            'jquery.validate.js'
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
    // $("body").on('click', '#postUpload', function(){

    // $('#postUpload').fileupload({
    //     url: UPLOAD_URL,
    //     dataType: 'json',
    //     add: function (e, data) {
    //         // 限制5张图片
    //         var num = $(".postimg dd img").length + data.originalFiles.length;
    //         if(10 < data.originalFiles.length || 10 < num){
    //             alert("不能超过10张图片");
    //             return false;
    //         }
    //         data.submit();
    //     },
    //     done: function (e, data) {
    //         $.each(data.result.files, function (index, file) {
    //             var text = '<dd class="img-box"><img src="/'+file.link+'" alt="" /><input type="hidden" name="images[]" value="'+file.link+'"><a href="javascript:;" class="delete"></a></dd>';
    //             $(".postimg").append(text);
    //         });

    //     },
    //   }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    // });

    // 七牛上传图片
    QINIU_HOST = '<?php echo \Helper\Qiniu::getHost('shares'); ?>';
    ITEMS_URL = '<?php echo \Helper\Qiniu::getHost('shares'); ?>';
    $('#postUpload').change(function() {

        var $this = $(this);

        $.get('/token', {bucket:'shares'}, function(data) {
            if(data.status == 'success') {
                var token = data.token;
                //check IE6-IE8
                if ($.support.leadingWhitespace){
                    var files = $this.target.files;
                    var f = files[0];
                }else{
                    var f = $this.prop("files")[0];
                }
                //var f = $this[0].files[0];
                var res = Qiniu_upload(f, token).success(function(data) {
                    var link = data.key;
                    var text = '<dd class="img-box"><img src="'+ITEMS_URL+link+'" alt="" /><input type="hidden" name="images[]" value="'+link+'"><a href="javascript:;" class="delete"></a></dd>';
                    $(".postimg").append(text);
                });
            }
        }, 'json');

    });
});
</script>
<div class="content-inner">
        <!--晒单开始-->
        <div class="show-box">

            <!--查看晒单详情-->
                <?php echo Form::open(['action' => 'u/posts/add/', 'class'=>'postsform']);?>
                <ul class="edit-data">
                    <li>
                        <label for=""></label>
                        <p style="font-size:14px"><?php echo Html::anchor("/w/".$phase->id, "第(".$phase->phase_id.")期".$phase->title);?>
                        </p>
                    </li>
                    <li>
                        <label for=""></label>
                        <p style="font-size:14px"><?php echo Html::img(\Helper\Image::showImage($phase->image, '160x160', 'items'), ['style'=>'width:80px']);?>
                        </p>
                    </li>
                    <li>
                        <label for="">标题：</label>
                        <?php echo Form::input('title', Input::get('title'), ['class' =>'txt', 'name'=>'']);?>
                    </li>
                    <li>
                        <label for="" class="body-label">正文：</label>
                        <?php echo Form::textarea('desc', Input::get('desc'), ['class' => 'txt', 'id'=>'desc', 'rows'=>'15', 'cols'=>'20']);?>

                    </li>
                    <li style="height:23px;margin-top:-14px;">
                        <label for="" class="body-label"></label><span id="descmsg" style="margin-top:-1px;"></span>
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
                        <button class="btn-red  btn-address" type="submit" style="margin-left:150px">发布</button>
                        <a href="/u/noposts" class="btn-sx btn-cancel">返回</a>
                    </li>
                </ul>
                <?php echo Form::close();?>
        </div>
</div>
<script>
$(function(){
    $(".postsform").validate({
        rules:{
            title:{
                required:true
            },
            desc:{
                required:true
            }
        },
        messages:{
            title:{
                required:"请输入标题内容"
            },
            desc:{
                required:"请输入正文"
            }
        },
        errorPlacement: function(error, element) {
            if(element[0].id=="desc"){
                $("#descmsg").append(error);
            }else
                error.appendTo(element.parent());
        }
    });
});
</script>
