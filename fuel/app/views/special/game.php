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
.footer-help  {
    width: 980px !important;
    overflow: hidden !important;
}
</style>
<div class="game-hd">

</div>
<div class="game-bd">
    <div class="game-column">
        <ul>
            <?php
                $where = ['opentime' => 0, 'is_delete' => 0, 'cate_id'=>5];
                $select= ['id', 'title', 'cost', 'image'];
                $games = Model_Phase::find('all', ['where' => $where, 'orderBy'=>['item_id'=>'asc']]);
            ?>
            <?php foreach($games as $row) { ?>
            <li>
                <div class="imgBox">
                    <?php echo Html::anchor('m/'.$row->id, Html::img(\Helper\Image::showImage($row->image)));?>
                </div>
                <div class="tit"><?php echo $row->title;?></div>
                <div class="fd-col">
                    <span class="money">参考价：<?php echo sprintf('%.2f', $row->cost/100);?></span>
                    <?php echo Html::anchor('m/'.$row->id, '',['class'=>'lol-btn-sm']);?>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
