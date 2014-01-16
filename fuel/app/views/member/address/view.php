<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "add" ); ?>'><?php echo Html::anchor('member/posts/add','Add');?></li>
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('member/posts/index','Index');?></li>
	<li class='<?php echo Arr::get($subnav, "delete" ); ?>'><?php echo Html::anchor('member/posts/delete','Delete');?></li>
	<li class='<?php echo Arr::get($subnav, "edit" ); ?>'><?php echo Html::anchor('member/posts/edit','Edit');?></li>
	<li class='<?php echo Arr::get($subnav, "view" ); ?>'><?php echo Html::anchor('member/posts/view','View');?></li>

</ul>
<p>View</p>