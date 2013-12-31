
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
                <?php if(empty($list)) {
                        echo '<tr><td colspan="5" style="text-align:center">亲，您还没有晒单哦！</td></tr>';
                  }?>
                <?php foreach($list as $post) { ?>
                <tr>
                    <td><?php echo $post->id;?></td>
                    <td><div class="img-box"><?php echo Html::anchor('u/posts/view/'.$post->id, Html::img($post->topimage)); ?></div></td>
                    <td>
                        <div class="text-title"><?php $post->title;?></div>
                        <div class="text-content"><?php echo mb_substr($post->desc, 0, 42,'utf-8'); ?></div>
                    </td>
                    <td><?php echo $post->status; ?></td>
                    <td>
                        <?php echo Html::anchor('u/posts/view/'.$post->id, '查看详情'); ?> |
                        <?php echo Html::anchor('u/posts/edit/'.$post->id, '编辑'); ?> |
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
