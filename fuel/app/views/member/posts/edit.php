<?php 
echo Asset::css(
    [
        'jquery.fileupload.css', 
        'admin/items/form.css', 
        ]
    );
echo Asset::js(
        [
            //'jquery.validate.js', 
            //'additional-methods.min.js',
            'jquery.ui.widget.js',
            'jquery.iframe-transport.js',
            'jquery.fileupload.js',
            //'ueditor/ueditor.config.js',
            //'ueditor/ueditor.all.min.js',
            //'ueditor/lang/zh-cn/zh-cn.js',
            //'admin/items/form.js', 
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
    $('#postUpload').fileupload({
        url: UPLOAD_URL,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {var text = '<dd><img src="/'+file.link+'" alt="" /><input type="hidden" name="images[]" value="'+file.link+'"><a href="javascript:;" class="delete"></a></dd>';
                $(".postimg").append(text);
            });
            
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    
});
</script>
<div class="content-inner">
        <!--晒单开始-->
        <div class="show-box">
            <!--查看晒单详情-->
            <div class="show-c" >
                <?php echo Form::open(['action' => 'u/posts/edit/'.$post->id]);?>
                <ul class="show-form">
                    <li>
                        <label for="">标题</label>
                        <input type="text" name="title" value="<?php echo $post->title;?>"/><span></span>
                        <label for="" class="error"></label>
                    </li>
                    <li>
                        <label for="" class="body-label">正文</label>
                        <textarea name="desc" cols="70" rows="15"><?php echo $post->desc;?></textarea>
                        <label for="" class="error"></label>
                    </li>
                    <li>
                        <label for="" class="body-label">图片</label>
                        <div class="destItem">
                        <dl class="postimg">
                            <?php foreach(unserialize($post->images) as $img) { ?>
                            <dd class="img-box">
                                <?php echo Html::img($img);?>
                                <input type="hidden" name="images[]" value="<?php echo $img;?>">
                                <a href="javascript:;" class="delete"></a>
                            </dd>
                            <?php } ?>
                        </dl>
                        <span class="add-images" title="上传图片">
                           <input id="postUpload" type="file" name="post" multiple class="add-images2">
                         </span>
                         </div>
                    </li>             
                    <li>
                        <button class="btn btn-red tj">发布</button>
                        <a href="/u/posts" class="btn">返回</a>
                    </li>
                </ul>
                <?php echo Form::close();?>
            </div>
        </div>
</div>
