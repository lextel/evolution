<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "list" ); ?>'><?php echo Html::anchor('friend/list','List');?></li>
	<li class='<?php echo Arr::get($subnav, "follow" ); ?>'><?php echo Html::anchor('friend/follow','Follow');?></li>
	<li class='<?php echo Arr::get($subnav, "unfollow" ); ?>'><?php echo Html::anchor('friend/unfollow','Unfollow');?></li>

</ul>
<p><?php echo $content; ?></p>