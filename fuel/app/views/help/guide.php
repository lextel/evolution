<?php echo Asset::css(['style.css']);?>
<div class="bread">
        <ul>
            <li><a href="<?php echo Uri::create('/')?>">首页</a></li>
            <li><em>&gt;</em></li>
            <li><a href="<?php echo Uri::create('h')?>">帮助中心</a></li>
            <?php if(isset($title)):?>
            <li><em>&gt;</em></li>
            <li><?php echo $title;?></li>
            <?php endif;?>
        </ul>
    </div>
<div class="guide-bd">

    <div class="column01">
    </div>
    <div class="column02">
    </div>
    <div class="column03">
        <a href="<?php echo Uri::create('/');?>" class="guide-btn"></a>
    </div>
</div>
<div class="guide-fd">
    <div class="column">
        <div class="rule">
            <div class="title"><img src="../assets/img/guide04_03.png"/><span><b>1元乐淘规则</b></span></div>
            <p><img src="../assets/img/guide04_07.png" /><span>每件商品参考市场价平分成相应“等份”，每份1元（100银币），一份对应一个乐淘码。</span></p>
            <p><img src="../assets/img/guide04_10.png" /><span>同一件商品可以购买多次或一次购买多份。</span></p>
            <p><img src="../assets/img/guide04_16.png" /><span>当一件商品所有“等份”全部售出后计算出的“幸运乐淘码”，拥有“幸运乐淘码“的用户者即可获得此商品。</span></p>
        </div>

        <div class="calculation">
            <div class="title"><img src="../assets/img/guide04_03.png"/><span><b>乐淘码计算方式</b></span></div>
            <p><img src="../assets/img/guide04_07.png" /><span>当一件商品所有“等份”全部售出后计算出的“幸运乐淘码”，拥有“幸运乐淘码“的用户者即可获得此商品。</span></p>
            <p><img src="../assets/img/guide04_10.png" /><span>时间按时，分，秒毫秒依次排列组成一组数值。</span></p>
            <p><img src="../assets/img/guide04_16.png" /><span>将这100组数值之和除以商品总需参与人次后取余数，余数加上10,000,001即为“幸运乐淘码”。</span></p>
        </div>
    </div>
</div>
