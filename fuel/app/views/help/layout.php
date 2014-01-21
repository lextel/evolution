<?php echo Asset::css(['style.css']);?>
    <div class="wrapper w">
        <div class="help-side fl">
            <h2 class="title">帮助中心</h2>
           <dl class="help-center">
               <dt>新手指南</dt>
               <dd><?php echo Html::anchor('h/new', '了解乐拍');?></dd>
               <dd><?php echo Html::anchor('h/question', '常见问题');?></dd>
               <dd><?php echo Html::anchor('h/serve', '服务协议');?></dd>
               <dt>乐拍保障</dt>
               <dd><?php echo Html::anchor('h/safeguard', '乐拍保障体系');?></dd>
               <dd><?php echo Html::anchor('h/promise', '正品承诺');?></dd>
               <dd><?php echo Html::anchor('h/pay', '安全支付');?></dd>
               <dd><?php echo Html::anchor('h/shipping', '配送费用');?></dd>
               <dd><?php echo Html::anchor('h/suggest', '投诉建议');?></dd>
               <dt>新手指南</dt>
               <dd><?php echo Html::anchor('h/expressinfo', '商品配送');?></dd>
               <dd><?php echo Html::anchor('h/examine', '商品验货与签收');?></dd>
               <dd><?php echo Html::anchor('h/longTime', '未收到商品问题');?></dd>
           </dl>
        </div>
        
        <?php echo $content;?>
        </div>
    </div>
