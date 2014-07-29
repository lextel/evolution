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
                    <span>(1元=1元宝)</span>
                </dd>
            </dl>

            <!--选择支付方式开始-->
            <div class="pay-way">
                <div class="title"><h4>选择付款方式</h4></div>
                <dl>
                <dt>网银支付</dt>
                            <dd>
                                <input type="radio" id="gsh" name="account"  value="1002">
                                <label for="gsh">
                                    <span class="gsh"></span>
                                </label>
                            </dd>
                             <dd>
                                <input type="radio" id="zhs" name="account" value="1001">
                                <label for="zhs">
                                    <span class="zhs"></span>
                                </label>
                            </dd>
                            <dd>
                                <input type="radio" id="jsh" name="account" value="1003">
                                <label for="jsh">
                                    <span class="jsh"></span>
                                </label>
                            </dd>
                            <dd>
                                <input type="radio" id="ny" name="account" value="1005">
                                <label for="ny">
                                    <span class="ny"></span>
                                </label>
                            </dd>
                            <dd>
                                <input type="radio" id="pd" name="account" value="1004">
                                <label for="pd">
                                    <span class="pd"></span>
                                </label>
                            </dd>
                             <dd>
                                <input type="radio" id="xy" name="account" value="1009">
                                <label for="xy">
                                    <span class="xy"></span>
                                </label>
                            </dd>
                             <dd>
                                <input type="radio" id="bj" name="account" value="1032">
                                <label for="bj">
                                    <span class="bj"></span>
                                </label>
                            </dd>
                             <dd>
                                <input type="radio" id="gda" name="account" value="1022">
                                <label for="gda">
                                    <span class="gda"></span>
                                </label>
                            </dd>
                             <dd>
                                <input type="radio" id="ms" name="account" value="1006">
                                <label for="ms">
                                    <span class="ms"></span>
                                </label>
                            </dd>
                             <dd>
                                <input type="radio" id="zhx" name="account" value="1021">
                                <label for="zhx">
                                    <span class="zhx"></span>
                                </label>
                            </dd>
                             <dd>
                                <input type="radio" id="gf" name="account" value="1027">
                                <label for="gf">
                                    <span class="gf"></span>
                                </label>
                            </dd>
                             <dd>
                                <input type="radio" id="pingan" name="account" value="1010">
                                <label for="pingan">
                                    <span class="pingan"></span>
                                </label>
                            </dd>
                            <dd>
                                <input type="radio" id="zgh" name="account" value="1052">
                                <label for="zgh">
                                    <span class="zgh"></span>
                                </label>
                            </dd>
                            <dd>
                                <input type="radio" id="jt" name="account" value="1020">
                                <label for="jt">
                                    <span class="jt"></span>
                                </label>
                            </dd>
                        </dt>
                    <dt>第三方平台</dt>
                    <!--<dd>
                        <input type="radio" id="zhf" name="account" value="alipay"/>
                        <label for="zhf">
                            <span class="zhf"></span>
                        </label>
                    </dd>-->
                    <dd>
                        <input type="radio" id="kq" name="account" value="99bill"/>
                        <label for="kq">
                            <span class="kq"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" id="cft" name="account" value="tenpay"/>
                        <label for="cft">
                            <span class="cft"></span>
                        </label>
                    </dd>
                    <?php if (0) { ?>
                    <dd>
                        <input type="radio" id="bfb" name="account" value="bfb"/>
                        <label for="bfb">
                            <span class="bfb"></span>
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
