<?php echo Asset::js('jquery.provincesCity.js',"utf-8"); ?>
<?php echo Asset::css(['member/validfrom_style.css']); ?>
<?php echo Asset::js(['provincesdata.js','Validform_v5.3.2_min.js', 'address/index.js']); ?>

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
        <ul class="edit-data registerform">
            <li>
                <table>
                    <thead>
                    <tr>
                        <th>详细地址</th>
                        <th>邮编</th>
                        <th>收货人</th>
                        <th>电话</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($list)) {
                           echo '<tr><td colspan="6" style="text-align:center">亲，您还没有添加收货地址哦！</td></tr>';
                    }?>
                    <?php foreach($list as $address) { ?>
                        <tr>
                            <td><?php echo $getAddress($address->address); ?></td>
                            <td><?php echo $address->postcode; ?></td>
                            <td><?php echo $address->name; ?></td>
                            <td><?php echo $address->mobile; ?></td>
                            <td><?php echo Html::anchor('javascript:;', $address->rate == 100 ? '默认地址': '设为默认地址', 
                                      ['class'=>'setFlag', 'data'=>$address->id, 'rate'=>$address->rate]); ?>
                            <?php echo Html::anchor('javascript:;', '修改', ['onclick'=>'modifyAddress('.$address->id.')']); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </li>
            <button class="btn btn-red btn-addAddress">添加新地址</button>
            <br />
            <ol class="address" style="display:none">
            <li>
                <label>所在地区：</label>
                <div id="datas"></div>
                <span for="" class=""></span>
            </li>
            <li>
                <label class="align">街道地址：</label>
                <textarea name="address"  cols="50" rows="3" datatype="*"  sucmsg="验证通过！" errormsg="请输入街道地址！" ></textarea>
                <span class="Validform_checktip align"></span>
            </li>
            <li>
                <label>邮政编码：</label>
                <input type="text" value="" name="postcode" datatype="p"  sucmsg="验证通过！" errormsg="请输入邮政编码！"  />
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <label>收货人：</label>
                <input type="text" value="" name="name" datatype="*2-6"  sucmsg="验证通过！" errormsg="请输入2到6个中文字符！！"  />
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <label>联系电话：</label>
                <input type="text" value="" name="phone" datatype="m"  sucmsg="验证通过！" errormsg="请输入收货人手机号码！"  />
                <span class="Validform_checktip"></span>
            </li>
            <li>
                <input name="addressid" id="addressid" type="hidden" val=""/>
                <input class="btn btn-red btn-address" type="submit" value="保存"/>
                <input class="btn btn-red btn-addressChance" type="submit" value="取消"/>
            </li>
            </ol>
        </ul>
</div>
