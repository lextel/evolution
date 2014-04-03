<?php echo Asset::css(['style.css']);?>
<style>
.w {
    width: 100%;
    overflow: visible;
}
.navbar {
    margin-bottom: 0;
}
.column-skin dd {
    margin-right: 37px;
}
</style>
<div class="lol-hd">
    <div class="lol-nav">
        <ul class="one">
            <li><a id="hero" href="javascript:;" class="hero"></a></li>
            <li><a id="skin" href="javascript:;" class="skin"></a></li>
        </ul>
        <ul class="two">
            <li><a id="peri" href="javascript:;" class="peri"></a></li>
            <li><a href="<?php echo Uri::create('/'); ?>" class="buy"></a></li>
        </ul>
    </div>
</div>
<?php
    $heroImgs = [
        '60' => '/assets/img/yingxiong01.jpg',
        '63' => '/assets/img/yingxiong03.jpg',
        '64' => '/assets/img/yingxiong06.jpg',
        '65' => '/assets/img/yingxiong02.jpg',
        '66' => '/assets/img/yingxiong05.jpg',
        '67' => '/assets/img/yingxiong04.jpg',
    ];

    $where = ['opentime' => 0, 'is_delete' => 0, ['title', 'like', '%LOL英雄%']];
    $select= ['item_id', 'id', 'title', 'cost'];
    $heros = Model_Phase::find('all', ['where' => $where, 'orderBy'=>['item_id'=>'asc'], 'limit' => count($heroImgs)]);
?>
<a id="herodiv"></a>
<div class="lol-bd">
    <div class="column-hero">
        <dl>
            <dt></dt>
            <?php foreach($heros as $hero): ?>
            <dd>
                <div class="imgBox">
                    <a target="_blank" href="<?php echo Uri::create('m/'.$hero->id)?>"><img src="<?php echo $heroImgs[$hero->item_id];?>" alt="<?php echo $hero->title; ?><"/></a>
                </div>
                <div class="fd-col">
                    <div class="tit"><?php echo $hero->title; ?><span>价值:<s>￥<?php echo sprintf('%.2f', $hero->cost/100);?></s></span></div>
                    <a target="_blank" href="<?php echo Uri::create('m/'.$hero->id)?>" class="lol-btn-sm"></a>
                </div>
            </dd>
            <?php endforeach;?>
        </dl>
    </div>
<?php
    $where = ['opentime' => 0, 'is_delete' => 0, ['title', 'like', '%LOL皮肤%']];
    $select= ['id', 'title', 'cost', 'image'];
    $skins = Model_Phase::find('all', ['where' => $where, 'orderBy'=>['item_id'=>'asc']]);
?>
    <a id="skindiv"></a>
    <div class="column-skin">
        <dl>
            <dt></dt>
            <?php foreach($skins as $skin): ?>
            <dd>
                <div class="imgBox">
                    <a target="_blank" href="<?php echo Uri::create('m/'.$hero->id)?>"><img style="width: 296px; height: 296px" src="<?php echo \Helper\Image::showImage($skin->image);?>" alt=""/></a>
                </div>
                <div class="tit"><?php echo $skin->title; ?></div>
                <div class="fd-col">
                     <span class="money">￥<s><?php echo sprintf('%.2f', $skin->cost/100);?></s>封顶</span>
                     <a target="_blank" href="<?php echo Uri::create('m/'.$skin->id)?>" class="lol-btn-sm"></a>
                </div>
            </dd>
            <?php endforeach;?>
        </dl>
    </div>
    <?php
    $itemIds = [52, 70, 58, 53];
    $where = ['opentime' => 0, 'is_delete' => 0, ['item_id', 'in', $itemIds]];
    $select= ['id'];
    $peris = Model_Phase::find('all', ['where' => $where]);
    ?>
    <a id="peridiv"></a>
    <div class="column-peri">
        <dl>
            <dt></dt>
            <?php 
            $i = 1;
            foreach($peris as $peri): 
            ?>
            <dd class="per_0<?php echo $i;?>"><a target="_blank" href="<?php echo Uri::create('m/'.$peri->id)?>"><img src="/assets/img/per_0<?php echo $i;?>.png"></a></dd>
            <?php 
            $i++;
            endforeach;
            ?>

        </dl>
        <div style="clear:both"></div>
    </div>
</div>
<script>
    $(function(){
        $('#hero').click(function(){
            $("html,body").animate({scrollTop: $('#herodiv').offset().top+10}, 300);
        });

        $('#skin').click(function(){
            $("html,body").animate({scrollTop: $('#skindiv').offset().top+10}, 800);
        });

        $('#peri').click(function(){
            $("html,body").animate({scrollTop: $('#peridiv').offset().top+10}, 1200);
        });

    });
</script>
