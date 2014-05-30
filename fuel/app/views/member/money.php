<?php echo Asset::css(['product.css', 'style.css']);?>
<?php echo Asset::js(['jquery.cookie.js', 'member/money.js']);?>
<div class="content-inner">
        <!--充值开始-->
        <form id="addmoney">
        <input type="hidden" name="money" id="money" value="" />
        <input type="hidden" name="source" id="source" value="" />
        </form>
        <div class="prepaid-box">
            <dl class="pay-money">
                <dt>请选择充值金额</dt>
                <dd>
                    <label for="money3">
                        <input type="radio" name="money1" class="money" id="money3" value="10" />
                        <span>10元</span>
                    </label>
                </dd>
                <dd>
                    <label for="money4">
                        <input type="radio" name="money1" class="money" id="money4" value="50"/>
                        <span>50元</span>
                    </label>
                </dd>
                <dd>
                    <label for="money5">
                        <input type="radio" name="money1" class="money" id="money5" value="100"/>
                        <span>100元</span>
                    </label>
                </dd>
                <dd class="moneydd">
                    <span class="else">其他金额<input type="text" name="money2" id="money2" value="" />元</span>
                </dd>
            </dl>

            <!--选择支付方式开始-->
            <div class="pay-way">
                <div class="title"><h4>选择付款方式</h4></div>
                <dl>
                    <dt>第三方平台</dt>
                    <dd>
                        <input type="radio" id="zhf" name="account" checked="checked" />
                        <label for="zhf">
                            <span class="zhf"></span>
                        </label>
                    </dd>
                    <?php if (0) { ?>
                      <dd>
                        <input type="radio" id="cft" name="account"/>
                        <label for="cft">
                            <span class="cft"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" id="kq" name="account"/>
                        <label for="kq">
                            <span class="kq"></span>
                        </label>
                    </dd>
                    <dt>网银支付</dt>
                    <dd>
                        <input type="radio" id="zhs" name="account"/>
                        <label for="zhs">
                            <span class="zhs"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" id="jt" name="account"/>
                        <label for="jt">
                            <span class="jt"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" id="gsh" name="account"/>
                        <label for="gsh">
                            <span class="gsh"></span>
                        </label>
                    </dd>
                    <dd style="margin-right: 0;">
                        <input type="radio" id="zhg" name="account"/>
                        <label for="zhg">
                            <span class="zhg"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" id="zhx" name="account"/>
                        <label for="zhx">
                            <span class="zhx"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" id="jsh" name="account"/>
                        <label for="jsh">
                            <span class="jsh"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" id="ny" name="account"/>
                        <label for="ny">
                            <span class="ny"></span>
                        </label>
                    </dd>
                    <?php } ?>
                </dl>

                <div class="total-money">
                    应付金额：￥<s class="moneytotal">0</s>
                </div>
                <button class="btn btn-md btn-red fl buy-btn">确认支付</button>
            </div>
            <!--选择支付方式结束-->
        </div>
</div>
<!--弹出充值提醒-->
<div class="login2 moneysuss">

        <div class="login2-head">
          <h3>充值提醒</h3>
           <button class="close" id="close"></button>
        </div>
        <ul class="login2-body">
            <h4 class="o">请在新打开的页面上完成支付</h4>
            <p>付款完成之前，请不要关闭本窗口！ </p>
            <p>完成付款后根据您的个人情况完成此操作 </p>
            <div class="register-bar">
                <div class="btn-group">
                     <?php echo Html::anchor('/u/moneylog', '查看充值记录', ['class'=>'btn btn-red btn-sm']);?>
                     <?php echo Html::anchor('/u/getrecharge', '返回充值页面', ['class'=>'btn btn-sm btn-state']);?>
                  </div>
            </div>
         </ul>

</div>
