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
    var imgs = $(".postimg dd").length;
    if (imgs >= 5){
        alert('您上传的图片超过了5张');
        return false;
    }
    $('#postUpload').fileupload({
        url: UPLOAD_URL,
        dataType: 'json',
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
                <?php echo Form::open(['action' => 'u/posts/edit/'.$post->id, 'class'=>'demoform']);?>
                <ul class="edit-data">
                    <li>
                        <label for="">标题：</label>
                        <?php echo Form::input('title', $post->title, ['class' =>'txt', 'name'=>'', 'datatype'=>'*', 'nullmsg'=>'请输入标题内容', 'sucmsg'=>'已填写']);?>
                    </li>
                    <li>
                        <label for="" class="body-label">正文：</label>
                        <?php echo Form::textarea('desc', $post->desc, ['class' => 'txt', 'name'=>'',
                                           'datatype'=>'*', 'rows'=>'15', 'cols'=>'20', 'nullmsg'=>'请输入', 'sucmsg'=>'已填写']);?>
                        <span class="Validform_checktip"></span>
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
                            <?php foreach(unserialize($post->images) as $img) { ?>
                            <dd class="img-box">
                                <?php echo Html::img($img);?>
                                <input type="hidden" name="images[]" value="<?php echo $img;?>">
                                <a href="javascript:;" class="delete"></a>
                            </dd>
                            <?php } ?>
                        </dl>
                        </div>
                    </li>             
                    <li>
                        <button class="btn-red  btn-address">发布</button>
                        <a href="/u/posts" class="btn-sx btn-cancel">返回</a>
                    </li>
                </ul>
                <?php echo Form::close();?>
        </div>
</div>
<script>
$(function(){
	$(".demoform").Validform({
	tiptype:4,
	});
});
</script>
