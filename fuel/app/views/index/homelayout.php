<?php echo Asset::css('style.css'); ?>
<div class="wrapper w">
        <div class="left-sidebar fl">
            <div class="img-box">
                  <a href="<?php echo Uri::create('u/'.$member->id); ?>">
                    <img src="<?php echo \Helper\Image::showImage($member->avatar, '160x160');?>"/>
                  </a>
            </div>
            <div class="home-mu">
                <div class="name"><?php echo Html::anchor('u/'.$member->id, $member->nickname);?></div>
                <div class="signature">
                    个性签名:
                    <?php echo $member->bio;?>
                </div>
            </div>
        </div>
        <div class="home-wrap fr">
        <?php echo $content; ?>
        </div>
</div>


