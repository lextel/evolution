<?php echo Asset::js(['friends/my.js']);?>
<script>UNFOLLOW_URL = '<?php echo Uri::create('u/unfollow'); ?>';</script>
<ul class="focus-sade">
    <?php foreach($friends as $friend) { ?>
    <li>
        <a href="<?php echo Uri::create('u/'.$friend['mid']);?>" class="pull-left head_portrait">
          <img src="<?php echo $getAvatar($friend['mid']); ?>" alt="">
        </a>
        <div class="pull-right">
            <h4><?php echo $getUserName($friend['mid']); ?></h4>
            <p>已关注</p>
            <a href="javascript:void(0);" data-mid="<?php echo $friend['mid'];?>" class="btn btn-xs btn-default unfollow">取消关注</a>
            <!--a href="#" class="btn btn-xs btn-primary">马上关注</a-->
        </div>
    </li>
    <?php } ?>
    <?php
    if(empty($friends)) {
        echo '<li>还没有好友</li>';
    }
    ?>
</ul>
