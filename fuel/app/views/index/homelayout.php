<?php echo Asset::css('style.css'); ?>
<div class="wrapper w">
        <div class="left-sidebar fl">
            <div class="img-box">
                <?php echo Html::anchor('u/'.$member->id, Html::img($member->avatar));?>
            </div>
            <div class="winner"><?php echo Html::anchor('u/'.$member->id, $member->nickname);?></div>
            <div class="signature">
                个性签名:
                <?php echo $member->bio;?>
            </div>
        </div>
        <br />
        
        <?php echo $content; ?>
</div>
            
            
