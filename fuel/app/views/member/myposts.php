

<div class="content-inner">
    <!--晒单开始-->
    <div class="show-box">
        <div class="toggles">
            <?php echo Html::anchor('u/posts', '已晒单', ['class'=>'first-child active']); ?>
            <?php echo Html::anchor('u/noposts', '未晒单', ['class'=>'last-child']); ?>
        </div>

        <div class="show-c">

            <table>
                <thead>
                <tr>
                    <th>编号</th>
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
                    <td><?php echo $post->id;?></td>
                    
                    <td><div class="img-box">
                    <?php if ($post->status == 1) { ?>
                    <?php echo Html::anchor('u/p'.$post->id, Html::img($post->topimage)); ?>
                    <?php } else { ?>
                    <?php echo Html::img($post->topimage); ?>
                    <?php }?>
                    </div></td>
                    <td>
                        <div class="text-title"><?php $post->title;?></div>
                        <div class="text-content"><?php echo mb_substr($post->desc, 0, 32,'utf-8'); ?></div>
                    </td>
                    <td><?php echo $getType($post->status); ?></td>
                    <td>
                        <?php if ($post->status == 1) { ?>
                        <?php echo Html::anchor('p/'.$post->id, '查看'); ?> |
                        <?php } ?>
                        <?php echo Html::anchor('u/posts/getedit/'.$post->id, '编辑'); ?> |
                        <?php echo Html::anchor('u/posts/delete/'.$post->id, '删除', array('onclick' => "return confirm('你确定需要删除该晒单吗?')") ); ?>
                    </td>
                </tr>
               <?php };?>
                </tbody>

            </table>
            <br />
            <?php echo Pagination::instance('postspage')->render(); ?>
        </div>
    </div>
    <!--获晒单结束-->
</div>
