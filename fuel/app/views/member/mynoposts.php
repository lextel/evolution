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
    $(".btn-avatarUpload").click(function(){
        $(".form-avatarUpload").submit();
    });
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
    $(".delete").click(function(){
        console.log(11111);
    });
    //上传图片
    $('#postUpload').fileupload({
        url: UPLOAD_URL,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                console.log(file.link);
                //$('#newavatar').attr('src', IMAGE_URL+file.link);
                var text = '<dd class="img-box"><img src="/'+file.link+'" alt="" /><input type="hidden" name="images[]" value="'+file.link+'"><a href="javascript:;" class="delete"></a></dd>';
                //$('#avatar').val(file.link);
                $(".postimg").append(text);
            });
            
        },
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    
});
</script>


<div class="content-inner">
    <!--晒单开始-->
    <div class="show-box">
        <div class="toggles">
           <?php echo Html::anchor('u/posts', '已晒单', ['class'=>'first-child']); ?>
           <?php echo Html::anchor('u/noposts', '未晒单', ['class'=>'last-child active']); ?>
        </div>

        <div class="show-c">

            <table>
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>商品图片</th>
                        <th>商品信息</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($noposts as $post) { ?>
                    <tr>
                        
                        <td><?php echo $post->id;?></td>
                        <td><div class="img-box"><a href=""><img src="img/54359.jpg" alt=""/></a></div></td>
                        <td>
                            <div class="text-title">（第539期）苹果Iphone 5s 16G版 3G手机</div>
                            <div class="number">幸运乐拍码：10000121</div>
                            <div class="datetime">揭晓时间：2013-12-33 10:00:00</div>
                        </td>
                        <td><a href="javascript:;" class="btn btn-default btn-sx btn-addpost" id=<?php echo $post->id;?>>晒单</a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <ul class="show-form" style="display:none">
                    <?php echo Form::open(['action' => 'u/posts/add', 'method' => 'post']);?>
                    <li>
                        <label for="">标题</label>
                        <input name="title" type="text"/><span></span>
                        <label for="" class="error"></label>
                    </li>
                    <li>
                        <label for="" class="body-label">正文</label>
                        <textarea name="desc" id="" cols="70" rows="6"></textarea>
                        <label for="" class="error"></label>
                    </li>
                    <li>
                        <label for="" class="body-label">图片</label>
                        <dl class="postimg">
                         
                        </dl>
                        <!--<button class="btn btn-default">上传图片</button>-->
                        <input id="postUpload" type="file" name="post" multiple class="btn btn-default">
                        <label for="" class="error"></label>
                    </li>
                    <li>
                        <input id="postid" name="phase_id" type="hidden" value="" />
                    </li>
                    <li><button type="text" class="btn btn-red tj">发布</button><a href="javascript:;" class="btn btn-red chance">取消</a></li>
                    <?php echo Form::close();?>
                </ul>
                <br />
            <?php echo Pagination::instance('postspage')->render(); ?>
        </div>
    </div>
    <!--获晒单结束-->
</div>
