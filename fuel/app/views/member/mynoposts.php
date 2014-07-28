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
             乐淘提醒：你总共晒单<s class="red"><?php echo $postscount;?></s>
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
                        
                        <td>
                            <div class="img-box img-sm">

                                <a href="<?php echo Uri::create('w/'.$phase->id)?>">
                                    <img src="<?php echo \Helper\Image::showImage($getItem($phase->item_id)->image, '70x70', 'items');?>"/>
                                </a>
                            </div></td>
                        <td>
                            <div class="text-title">（第<?php echo $phase->phase_id;?>期）<?php echo $phase->title;?></div>
                            <div class="number">幸运乐淘码：<span class="r"><?php echo $phase->code;?></span></div>
                            <div class="datetime">揭晓时间：<?php echo Date("Y-m-d H:i:s", $phase->opentime);?></div>
                        </td>
                        <td><a href="/u/posts/getadd/<?php echo $phase->id;?>" class="btn btn-sx btn-red btn-addpost">去晒单</a></td>
                        
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <button class="icon-close"></button>
            <?php echo Pagination::instance('postspage')->render(); ?>
    </div>
    <!--获晒单结束-->
</div>
