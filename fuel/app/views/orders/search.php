<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('orders/index','Index');?></li>
	<li class='<?php echo Arr::get($subnav, "my" ); ?>'><?php echo Html::anchor('orders/my','My');?></li>
	<li class='<?php echo Arr::get($subnav, "search" ); ?>'><?php echo Html::anchor('orders/search','Search');?></li>

</ul>
<p><?php echo $content; ?></p>