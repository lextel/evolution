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
        //var text = $('.showForm').html();
        $("#postid").val(id);
        //$("#showForm" + id).html(text);
        $("#showForm" + id).show();
    });
    //取消晒单
    $(".chance").click(function(){
        var id = $(this).attr('id');
        $("#postid").val('');
        $(".showForm").hide();
    });
    //删除图片
    $("body").on('click', '.delete', function(){
        $(this).parent().remove();
    });
    //上传图片
    $("body").on('click', '#postUpload', function(){
    var imgs = $(".postimg dd").length;
    if (imgs >= 10){
        alert('您上传的图片超过了10张');
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
        <div class="remind ">
             乐拍提醒：你总共晒单<s class="red"><?php echo $postscount;?></s>
             件商品，还有<s class="red"> <?php echo $nopostscount;?></s>件商品等待您晒单。
        </div>
        <div class="toggles">
           <?php echo Html::anchor('u/posts', '已晒单', ['class'=>'first-child']); ?>
           <?php echo Html::anchor('u/noposts', '未晒单', ['class'=>'last-child active']); ?>
        </div>
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
                        <td><a href="/u/posts/getadd/<?php echo $phase->id;?>" class="btn btn-sx btn-red btn-addpost">去晒单</a></td>
                        
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="showForm" style="display:none">
                <?php echo Form::open(['action' => 'u/posts/add', 'method' => 'post', 'class'=>'demoform']);?>
                    <ul class="edit-data showForm" >
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
                           <div class="destItem" >
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
                            <input id="postid" name="phase_id" type="hidden" value="" />
                        </li>
                        <li><button type="text" class="btn btn-red tj">发布</button><a href="javascript:;" class="btn  chance">取消</a></li>
                    </ul>
                    <?php echo Form::close();?>
                </div>               
                <button class="icon-close"></button>
            <?php echo Pagination::instance('postspage')->render(); ?>
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
