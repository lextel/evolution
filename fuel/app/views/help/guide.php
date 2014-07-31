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
<div class="guide_bg">
    <div class="guide-banner"><img src="../assets/images/novice_banner.png" alt=""/></div>
    <div class="guide-content">
        <div class="guide-col01">
            <div class="img-box"><img src="../assets/images/novice01.png" alt="" style="max-height: none;"/></div>
            <div class="intro">
                <div class="tit"></div>
                <p>注册属于你的乐乐淘帐号</p>
            </div>
        </div>
        <div class="guide-col02">
            <div class="img-box"><img src="../assets/images/novice02.png" alt="" style="max-height: none;"/></div>
            <div class="intro">
                <div class="tit"></div>
                <p>选择一款你喜欢的虚拟道具与实体商品，点击“立即乐淘”</p>
            </div>
        </div>
        <div class="guide-col03">
            <div class="img-box"><img src="../assets/images/novice03.png" alt="" style="max-height: none;"/></div>
            <div class="intro_box">
                <div class="intro">
                    <div class="tit"></div>
                    <p>支付一元宝  支付100银币(1元宝=100银币)购买乐淘包，获得乐淘包的“幸运乐淘码” 1元宝/次</p>
                </div>
                <p><img src="../assets/images/novice05.png" alt="" style="max-height: none;"/></p>
            </div>
        </div>
        <div class="guide-col04">
            <div class="img-box"><img src="../assets/images/novice04.png" alt="" style="max-height: none;"/></div>
        </div>
        <div class="guide-col05">
            <a href="<?php echo Uri::create('/');?>" class="btn"></a>
        </div>

    </div>
</div>
<div class="guide-info">
            <dl>
                <dt>乐淘规则</dt>
                <dd><s class="icon">1</s>每一个乐淘包中包含一件商品</dd>
                <dd><s class="icon">2</s>所出售的每组乐淘包中，只有一个乐淘包包含实物商品，剩余乐淘包包含一个虚拟商品。</dd>
                <dd><s class="icon">3</s>乐友购买乐淘包之后，可以获得所购乐淘包的编号“乐淘码”</dd>
                <dd><s class="icon">4</s>包含实物商品的乐淘包的“乐淘码”将会按照公开算法计算得出</dd>
                <dd><s class="icon">5</s>等价等值的虚拟商品将随机发放。(<a class="b" href="<?php echo Uri::create('/h/expressinfo'); ?>">虚拟商品领取方式</a>)</dd>
                <dd><s class="icon">6</s>实物商品将送到您所指定的送货地址，全国免费配送（港澳台地区除外）</dd>
            </dl>
            <dl>
                <dt>乐淘码计算方式</dt>
                <dd><s class="icon">1</s>取该商品最后购买时间前网站所有商品100条购买时间记录（即时揭晓商品取截止时间前网站所有商品100条购买记录）</dd>
                <dd><s class="icon">2</s>时间按时、分、秒、毫秒依次排列组成一组数值。</dd>
                <dd><s class="icon">3</s>将这100组数值之和除以商品总需参与人次后取余数，余数加上10,000,001即为“幸运乐淘码”。</dd>
            </dl>
    </div>
