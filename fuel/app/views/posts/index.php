<?php echo Asset::css(['product.css', 'style.css']);?>
<div class="wrapper w">
    <div class="title">
        <h2>晒单分享<span>（截止目前共 <b class="red"><?php echo $postscount; ?></b> 个幸运者晒单）</span></h2>
    </div>
    <div class="list_sort">
        <span>排序</span>
        <?php echo Html::anchor('', '最新晒单', array('class' => 'btn btn-default btn-sx'));?>
        <?php echo Html::anchor('', '人气晒单', array('class' => 'btn btn-default btn-sx'));?>
        <?php echo Html::anchor('', '评论最多', array('class' => 'btn btn-default btn-sx'));?>
    </div>
    <div class="content w">
        <ul class="share-list">
        <?php if ($posts): ?>
        <?php foreach ([1,2,3,0] as $li):?>
        <li>
        <?php foreach ($posts as $v=>$item): ?>
            <?php if ($v % 4 == $li):?>
                <div class="product-item">
                    <div class="img-box">
                        <?php echo Html::anchor('', Html::img('assets/img/96515277.jpg'));?>
                    </div>
                    <div class="info-side">
                        <div class="head-img fl">
                            <?php echo Html::anchor('', Html::img('assets/img/96515277.jpg'));?>
                        </div>
                        <div class="info fl">
                            <span class="name"><a href="" class="blue"><?php echo $item->member_id; ?></a></span>
                            <span class="datetime"><?php echo $item->created_at; ?></span>
                            <span class="text-title blue"><?php echo $item->title; ?></span>
                        </div>
                        <div class="text-content">
                            <?php echo $item->desc; ?>
                        </div>
                    </div>
                    <div class="btn-group">
                        <?php echo Html::anchor('', '喜欢<s>('.$item->up.')</s>', array('class'=>'btn btn-link'));?>
                        <?php echo Html::anchor('', '评论<s>('.$item->comment_count.')</s>', array('class'=>'btn btn-link'));?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        </li>
        <?php endforeach; ?>
        <?php else: ?>

        <?php endif; ?>
        </ul>
        <!--分页-->
        <?php echo Pagination::instance('postspage')->render(); ?>
        <div class="pagination fr">
            <span><a href="" class="previous-inactive">上一页&lt;</a></span>
            <span><a href="" class="active">1</a></span>
            <span><a href="">2</a></span>
            <span><a href="">3</a></span>
            <span><a href="">4</a></span>
            <span><a href="" class="next">下一页&gt;</a></span>
        </div>
    </div>
</div>
