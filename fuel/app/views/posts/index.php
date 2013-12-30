<?php echo Asset::css(['product.css', 'style.css']);?>
<?php echo Asset::js(['jquery.cookie.js']);?>
<script type="text/javascript">
    $(function(){
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
         //点击刷新
         $('.btn-up').click(function(){
            var postid =  this.id;
            var up =  $(this).find("s").html();
            var c = $.cookie('postup');
            if (c == null || c == "") {
                c = ","
            }
            
            if (c.indexOf("," + postid + ",") >= 0) {
                $(this).html("已喜欢(<s>"+up+"</s>)");
            } else {
                //getData
                c = c + postid + ",";
                $.cookie('postup', c);                
                $(this).html("已喜欢(<s>" + (parseInt(up) + 1) + "<s>)");
            }
         });
         
         upcookie();
    });
</script>
<div class="wrapper w">
    <div class="title">
        <h2>晒单分享<span>（截止目前共 <b class="red"><?php echo $postscount; ?></b> 个幸运者晒单）</span></h2>
    </div>
    <div class="list_sort">
        <span>排序</span>
        <?php echo Html::anchor('/p/s/sortnew', '最新晒单', array('class' => 'btn btn-default btn-sx'));?>
        <?php echo Html::anchor('/p/s/sortup', '人气晒单', array('class' => 'btn btn-default btn-sx'));?>
        <?php echo Html::anchor('/p/s/sortcomment', '评论最多', array('class' => 'btn btn-default btn-sx'));?>
    </div>
    <div class="content w">
        <ul class="share-list">
        <?php if ($posts): ?>
        <?php foreach ([0,1,2,3] as $li){?>
        <li>
        <?php foreach ($posts as $v=>$item){ ?>
            <?php if (array_search($v, array_keys($posts)) % 4 == $li){?>
                <div class="product-item">
                    <div class="img-box">
                        <?php echo Html::anchor('/p/'.$item->id, Html::img('assets/img/96515277.jpg'));?>
                    </div>
                    <div class="info-side">
                        <div class="head-img fl">
                            <?php echo Html::anchor('u/'.$item->member_id, Html::img($getUser($item->member_id)->avatar));?>
                        </div>
                        <div class="info fl">
                            <span class="name"><?php echo Html::anchor('u/'.$item->member_id, $getUser($item->member_id)->username, ['class'=>'blue']);?></span>
                            <span class="datetime"><?php echo date('Y-m-d H:i:s', $item->created_at); ?></span>
                            <span class="text-title blue"><?php echo Html::anchor('/p/'.$item->id, $item->title);?></span>
                        </div>
                        <div class="text-content">
                            <?php echo mb_substr($item->desc, 0, 42,'utf-8'); ?>
                        </div>
                    </div>
                    <div class="btn-group">
                        <?php echo Html::anchor('javascript:;', '喜欢(<s>'.$item->up.'</s>)', array('class'=>'btn btn-link btn-up', 'id'=>$item->id));?>
                        <?php echo Html::anchor('/p/'.$item->id, '评论(<s>'.$item->comment_count.'</s>)', array('class'=>'btn btn-link'));?>
                    </div>
                </div>
            <?php }; ?>

        <?php }; ?>
        </li>
        <?php }; ?>
        <?php else: ?>

        <?php endif; ?>
        </ul>
        <!--分页-->
        <?php echo Pagination::instance('postspage')->render(); ?>
        <!--<div class="pagination fr">
            <span><a href="" class="previous-inactive">上一页&lt;</a></span>
            <span><a href="" class="active">1</a></span>
            <span><a href="">2</a></span>
            <span><a href="">3</a></span>
            <span><a href="">4</a></span>
            <span><a href="" class="next">下一页&gt;</a></span>
        </div>-->
    </div>
</div>
