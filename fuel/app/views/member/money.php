<script type="text/javascript">
$(function() {
   $(".buy").click(function(){
       var money = $('#money').val();
       $.post( '/u/recharge',
           {money:money, source:'网银'}, 
           function(data) {
           },
           'html' 
       );
   });
})
</script>

<div class="content-inner">
        <!--充值开始-->
        <div class="prepaid-box">
            <dl class="pay-money">
                <dt>请选择充值金额</dt>
                <dd>
                    <label for="">
                        <input type="radio" name="money" id="money" value="10" />
                        <span>10元</span>
                    </label>
                </dd>
                <dd>
                    <label for="">
                        <input type="radio" name="money" id="money" value="50"/>
                        <span>50元</span>
                    </label>
                </dd>
                <dd>
                    <label for="">
                        <input type="radio" name="money" id="money" value="100"/>
                        <span>100元</span>
                    </label>
                </dd>
                <dd>
                    <span class="else">其他金额<input type="text" name="money" id="money" value="" />元</span>
                </dd>
            </dl>
            <!--选择支付方式开始-->
            <div class="pay-way">
                <div class="title"><h4>选择付款方式</h4></div>
                <dl>
                    <dt>第三方平台</dt>
                    <dd>
                        <input type="radio" name="account"/>
                        <label for="">
                            <span class="zhf"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" name="account"/>
                        <label for="">
                            <span class="cft"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" name="account"/>
                        <label for="">
                            <span class="kq"></span>
                        </label>
                    </dd>
                    <dt>网银支付</dt>
                    <dd>
                        <input type="radio" name="account"/>
                        <label for="">
                            <span class="zhs"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" name="account"/>
                        <label for="">
                            <span class="jt"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" name="account"/>
                        <label for="">
                            <span class="gsh"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" name="account"/>
                        <label for="">
                            <span class="zhg"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" name="account"/>
                        <label for="">
                            <span class="zhx"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" name="account"/>
                        <label for="">
                            <span class="jsh"></span>
                        </label>
                    </dd>
                    <dd>
                        <input type="radio" name="account"/>
                        <label for="">
                            <span class="ny"></span>
                        </label>
                    </dd>
                </dl>
                <button class="buy fr">确认支付</button>
            </div>
            <!--选择支付方式结束-->
        </div>
</div>
