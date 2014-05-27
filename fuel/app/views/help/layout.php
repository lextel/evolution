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
    <div class="wrapper w">
        <div class="help-side fl">
            <h2 class="title">帮助中心</h2>
           <dl class="help-center">
               <dt>新手指南</dt>
               <dd><?php echo Html::anchor('h/new', '了解乐淘');?></dd>
               <dd><?php echo Html::anchor('h/question', '常见问题');?></dd>
               <dd><?php echo Html::anchor('h/serve', '服务协议');?></dd>
               <dt>乐淘保障</dt>
               <dd><?php echo Html::anchor('h/safeguard', '乐淘保障体系');?></dd>
               <dd><?php echo Html::anchor('h/promise', '正品承诺');?></dd>
               <dd><?php echo Html::anchor('h/pay', '安全支付');?></dd>
               <dd><?php echo Html::anchor('h/shipping', '配送费用');?></dd>
               <dd><?php echo Html::anchor('h/suggest', '投诉建议');?></dd>
               <dt>商品问题</dt>
               <dd><?php echo Html::anchor('h/expressinfo', '商品配送');?></dd>
               <dd><?php echo Html::anchor('h/examine', '商品验货与签收');?></dd>
               <dd><?php echo Html::anchor('h/longTime', '未收到商品问题');?></dd>
               <dt>关于乐乐淘</dt>
               <dd>联系我们</dd>
               <dd>商务合作</dd>
               <dd>市场推广</dd>
           </dl>
        </div>
        <?php echo $content;?>
        </div>
     </div>
