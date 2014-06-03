<?php echo Asset::js(['provincesdata.js','jquery.provincesCity.js'],"utf-8"); ?>
<?php echo Asset::js(['jquery.validate.js', 'additional-methods.min.js','address/index.js']); ?>


<div class="set-wrap">
        <div class="lead">个人设置</div>
        <div class="navbar-inner">
            <ul>
                <li><?php echo Html::anchor('u/getprofile', '个人资料'); ?></li>
                <li><?php echo Html::anchor('u/getavatar', '更换头像'); ?></li>
                <li class="active"><?php echo Html::anchor('u/address', '收货地址'); ?></li>
                <li><?php echo Html::anchor('u/passwd', '修改密码'); ?></li>
            </ul>
        </div>
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
                              <td><?php echo Html::anchor('javascript:;', $address->rate == 100 ? '<font color="#f00">默认地址</font>': '设为默认',
                              ['class'=>'setFlag', 'data'=>$address->id, 'rate'=>$address->rate]); ?>
                              <?php echo Html::anchor('javascript:;', '修改', ['onclick'=>'modifyAddress('.$address->id.')']); ?></td>
                          </tr>
                     <?php } ?>
                  </tbody>
        </table>
        <!--修改地址-->
        <div class="editAddress">
            <div class="row"><button class="btn btn-red btn-sx" id="editAddress">添加新地址</button></div>
              <ul class="edit-data">
                <form class="edit-datafrom">
                        <li id="province">
                            <label>*所在地区：</label>
                            <div id="datas" class="fl"></div>
                            <span id='provinceerror' class="error" style='font-size:14px;display:none;width:80px'><label style="color:red;text-align:left;">请选择地区</label></span>
                        </li>
                        <li>
                            <label class="align">*街道地址：</label>
                            <input name="address" id="address" class="txt" style="width:380px;" />
                        </li>
                        <li>
                            <label>*收货人：</label>
                            <input value="" class="txt" id="name" name="name" />
                        </li>
                        <li>
                            <label>*联系电话：</label>
                            <input value="" class="txt" id="phone" name="phone" />
                        </li>
                        <li>
                             <label>邮政编码：</label>
                             <input value="" class="txt" name="postcode" id="postcode"/>
                        </li>
                        <li>
                            <input name="addressid" id="addressid" type="hidden" val=""/>
                            <button class="btn-red  btn-address fl" style="margin-left:150px">保存</button>
                            <button class="btn-sx btn-cancel fl" />取消</button>
                        </li>
                        <button class="icon-close"></button>
                        </form>
            </ul>
          </div>
</div>
