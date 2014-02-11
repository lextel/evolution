<script type="text/javascript">
$(function() {
   $(".buy-btn").click(function(){  
   
       money = $("input[name='money1']:checked").val();
       if (!money){
          money = $("input[name='money2']").val();
       }
       if (!money){
          alert('请填写金额');
          return false;
       }
       $("input[name='money']").val(money);
       data = $('#addmoney').serialize();
       $.post( '/u/recharge',
           data,
           function(data) {
              if (data.code==0){
                 $(".moneysuss").show();
                 $(".login2").fadeIn("fast");
                 $("body").append("<div id='greybackground'></div>");
                 var documentheight = $(document).height();
                 $("#greybackground").css({"opacity":"0.5","height":documentheight});
                 return false;
              }
              else{
                 alert('充值失败');
              }
           },
           'json' 
       );
   });
   $("#money2").keyup(function(){   
    var value = $("#money2").val();   
    if((/^[1-9]{1}\d*$/.test(value))|| value<0)   
    {     
      return true;     
    }   
    else
    {    
      $("#money2").val("1");     
      return false;     
    }     
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
                <button class="buy-btn btn btn-red fl">确认支付</button>
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
                             <?php echo Html::anchor('/u/moneylog', '查看充值记录', ['class'=>'btn btn-red']);?>
                             <?php echo Html::anchor('/u/getrecharge', '返回充值页面', ['class'=>'btn']);?>
                          </div>
                    </div>
                 </ul>

        </div>
