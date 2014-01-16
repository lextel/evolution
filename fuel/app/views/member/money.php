<script type="text/javascript">
$(function() {
   $(".buy-btn").click(function(){  
   
       money = $("input[name='money1']:checked").val();
       if (!money){
          money = $("input[name='money2']").val();
       } 
       $("input[name='money']").val(money);
       data = $('#addmoney').serialize();
       $.post( '/u/recharge',
           data,
           function(data) {
              if (data.code==0){
                 alert("充值成功");
                 window.location.href="/u";
              }
           },
           'json' 
       );
   });
})
</script>

<div class="content-inner">
        <!--充值开始-->
        <form id="addmoney">
        <input type="hidden" name="money" id="money" value="" />
        <input type="hidden" name="source" id="source" value="网银" />
        </form>
        <div class="prepaid-box">
            <dl class="pay-money">
                <dt>请选择充值金额</dt>
                <dd>
                    <label for="">
                        <input type="radio" name="money1" id="money1" value="10" />
                        <span>10元</span>
                    </label>
                </dd>
                <dd>
                    <label for="">
                        <input type="radio" name="money1" id="money1" value="50"/>
                        <span>50元</span>
                    </label>
                </dd>
                <dd>
                    <label for="">
                        <input type="radio" name="money1" id="money1" value="100"/>
                        <span>100元</span>
                    </label>
                </dd>
                <dd>
                    <span class="else">其他金额<input type="text" name="money2" id="money2" value="" />元</span>
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
                <button class="buy-btn buy fr">确认支付</button>
            </div>
            <!--选择支付方式结束-->
        </div>
</div>
