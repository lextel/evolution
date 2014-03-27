<div class="content-inner">
    <!--晒单开始-->
    <div class="lead">晒单</div>
    <div class="show-box">
        <div class="remind ">
            乐淘提醒：你总共晒单<s class="red"><?php echo $postscount;?></s>
            件商品，还有<s class="red"> <?php echo $nopostscount;?></s>件商品等待您晒单。
        </div>
        <div class="toggles">
            <?php echo Html::anchor('u/posts', '已晒单', ['class'=>'first-child active']); ?>
            <?php echo Html::anchor('u/noposts', '未晒单', ['class'=>'last-child']); ?>
        </div>

        <div class="show-c">
            <table>
                <thead>
                <tr>
                    <th>晒单图片</th>
                    <th>晒单信息</th>
                    <th>晒单状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(empty($posts)) {
                        echo '<tr><td colspan="5" style="text-align:center">亲，您还没有晒单哦！</td></tr>';
                  }?>
                <?php foreach($posts as $post) { ?>
                <tr>
                    <td><div class="img-box img-sm">
                    <?php if ($post->status == 1) { ?>
                        <a href="<?php echo Uri::create('p/'.$post->id)?>">
                            <img src="<?php echo \Helper\Image::showImage($post->topimage, '70x70');?>"/>
                        </a>
                    <?php } else { ?>
                        <img src="<?php echo \Helper\Image::showImage($post->topimage, '70x70');?>"/>
                    <?php }?>
                    </div></td>
                    <td>
                        <div class="text-title"><?php echo $post->title;?></div>
                        <div class="text-time"><?php echo date("Y-m-d H:i:s", $post->created_at);?></div>
                        <div class="text-content"><?php echo mb_substr($post->desc, 0,90,'utf-8'); ?>...</div>
                    </td>
                    <td><?php echo $getType($post->status); ?></td>
                    <td>
                        <?php if ($post->status == 1) { ?>
                        <?php echo Html::anchor('p/'.$post->id, '查看'); ?> |
                        <?php echo Html::anchor('u/posts/getedit/'.$post->id, '编辑'); ?> |
                        <?php echo Html::anchor('u/posts/delete/'.$post->id, '删除', array('onclick' => "return confirm('你确定需要删除该晒单吗?')") ); ?>
                        <?php }else{ ?>
                        <?php echo Html::anchor('u/posts/getedit/'.$post->id, '编辑'); ?>                       
                        <?php } ?>
                    </td>
                </tr>
               <?php };?>
                </tbody>
            </table>
            <?php echo Pagination::instance('postspage')->render(); ?>
        </div>
    </div>
    <!--获晒单结束-->
</div>
