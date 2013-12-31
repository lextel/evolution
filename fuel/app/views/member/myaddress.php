<?php echo Asset::js('jquery.provincesCity.js',"utf-8"); ?>
<?php echo Asset::js('provincesdata.js'); ?>

<script>
	//调用插件
	$(function(){
		$("#datas").ProvinceCity();
	});
  </script>

<br />
<div class="set-wrap">
        <div class="navbar-inner">
            <ul>
                <li><?php echo Html::anchor('u/getprofile', '个人资料'); ?></li>
                <li><?php echo Html::anchor('u/getavatar', '更换头像'); ?></li>
                <li class="active"><?php echo Html::anchor('u/address', '收货地址'); ?></li>
                <li><?php echo Html::anchor('u/passwd', '修改密码'); ?></li>
            </ul>
        </div>
        <!--修改地址-->
        <ul class="edit-data">
            <li>
                <table>
                    <thead>
                    <tr>
                        <th>详细地址</th>
                        <th>邮编</th>
                        <th>收货人</th>
                        <th>电话</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($list)) {
                           echo '<tr><td colspan="6" style="text-align:center">亲，您还没有添加收货地址哦！</td></tr>';
                    }?>
                    <?php foreach($list as $address) { ?>
                        <tr>
                            <td><?php echo $address->address; ?></td>
                            <td><?php echo $address->postcode; ?></td>
                            <td><?php echo $address->name; ?></td>
                            <td><?php echo $address->mobile; ?></td>
                            <td><?php echo $address->rate; ?></td>
                            <td><?php echo Html::anchor('u/address/edit/'.$address->id, '修改'); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </li>
            <li>添加新地址</li>
            <li>
                <label>所在地区：</label>
                <div id="datas"></div>
                
                <span for="" class=""></span>
            </li>
            <li>
                <label class="align">街道地址：</label>
                <textarea name=""  cols="50" rows="3"></textarea>
                <span for="" class="error align"></span>
            </li>
            <li>
                <label>邮政编码：</label>
                <input type="text"/>
                <span for="" class="error"></span>
            </li>
            <li>
                <label>收货人：</label>
                <input type="text"/>
                <span for="" class="error"></span>
            </li>
            <li>
                <label>联系电话：</label>
                <input type="text"/>
                <span for="" class="error"></span>
            </li>
            <li>
                <a href="javascript:void(0);" class="btn btn-red">保存</a>
            </li>
        </ul>
</div>
