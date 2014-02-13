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
    <div class="lead">晒单</div>
    <div class="show-box">
        <div class="toggles">
           <?php echo Html::anchor('u/posts', '已晒单', ['class'=>'first-child']); ?>
           <?php echo Html::anchor('u/noposts', '未晒单', ['class'=>'last-child active']); ?>
        </div>

        <div class="show-c">

            <table>
                    <thead>
                    <tr>
                        <th>商品图片</th>
                        <th>商品信息</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($noposts)) {
                        echo '<tr><td colspan="5" style="text-align:center">亲，您没有未晒单的哦！</td></tr>';
                    }?>
                    <?php foreach($noposts as $phase) { ?>
                    <tr>
                        
                        <td><div class="img-box img-sm"><?php echo Html::anchor('/w/'.$phase->id, Html::img($getItem($phase->item_id)->image));?></div></td>
                        <td>
                            <div class="text-title">（第<?php echo $phase->phase_id;?>期）<?php echo $phase->title;?></div>
                            <div class="number">幸运乐拍码：<span class="r"><?php echo $phase->code;?></span></div>
                            <div class="datetime">揭晓时间：<?php echo Date("Y-m-d H:i:s", $phase->opentime);?></div>
                        </td>
                        <td><a href="#add1" class="btn btn-sx btn-red btn-addpost" id=<?php echo $phase->id;?>>去晒单</a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                     
                </table>
                
                <ul class="show-form" style="display:none"><a name="add1"></a>
                    <?php echo Form::open(['action' => 'u/posts/add', 'method' => 'post', 'class'=>'demoform']);?>
                    <li>
                        <label for="">标题</label>
                        <?php echo Form::input('title', '', ['class' =>'form-control', 'name'=>'', 'datatype'=>'*', 'nullmsg'=>'请输入标题内容', 'sucmsg'=>'已填写']);?>
                        <span class="Validform_checktip"></span>
                    </li>
                    <li>
                        <label for="" class="body-label">正文</label>
                        <?php echo Form::textarea('desc', '', ['class' => 'form-control', 'name'=>'', 
                                           'datatype'=>'*', 'rows'=>'6', 'cols'=>'70', 'nullmsg'=>'请输入', 'sucmsg'=>'已填写']);?>
                        <span class="Validform_checktip"></span>
                    </li>
                    <li>
                        <label for="" class="body-label">图片</label>
                        <div class="destItem" style="margin: 0 10px;">
                        <dl class="postimg">
                         
                        </dl>
                        <span class="add-images" title="上传图片">
                           <input id="postUpload" type="file" name="post" multiple class="add-images2">
                         </span>
                         </div>
                    </li>
                    <li>
                        <input id="postid" name="phase_id" type="hidden" value="" />
                    </li>
                    <li><button type="text" class="btn btn-red tj">发布</button><a href="javascript:;" class="btn  chance">取消</a></li>
                    <?php echo Form::close();?>
                    <span class="icon-upward"></span>
                    <button class="icon-close"></button>
                </ul>
            <?php echo Pagination::instance('postspage')->render(); ?>
        </div>
    </div>
    <!--获晒单结束-->
</div>
<script>
$(function(){
	$(".demoform").Validform({
	tiptype:4,
	});
});
</script>
