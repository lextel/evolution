function setDefaultFlag(url){
  $.get(url, function(data){
     window.location.href = "/u/address";
  });
}

function modifyAddress(id){
  $(".edit-data").show();
      $.get('/u/address/'+id, function(data){
         if (data.code == 0){
             var address = data.address;
             $("#datas").html('');
             $("#datas").ProvinceCity(address.address[0], address.address[1]);
             $("#datas select").eq(0).val(address.address[0]);
             $("#datas select").eq(1).val(address.address[1]);
             $("#datas select").eq(2).val(address.address[2]);
             $("input[name='address']").val(address.address[3]);
             $("input[name='postcode']").val(address.postcode);
             $("input[name='name']").val(address.name);
             $("input[name='phone']").val(address.mobile);
             $("input[name='addressid']").val(id);
         }
      });
    }

function toAddress(url){
    var province = $("#datas select").eq(0).val();
    var city = $("#datas select").eq(1).val();
    var county = $("#datas select").eq(2).val();
    var address = $("input[name='address']").val();
    var postcode = $("input[name='postcode']").val();
    var name = $("input[name='name']").val();
    var phone = $("input[name='phone']").val();
    if ((province != '请选择' && province != '') && (city != '请选择' && city != '') && (county != '请选择' && county != '')){
          if (address !='' && name !='' && phone !=''){
             $.post(url,
             {province:province, city:city, county:county, address:address, postcode:postcode, name:name, phone:phone},
             function( data ){
               window.location.href = "/u/address";
             },
             'html'
             );
          }
    }else{
       $("#provinceerror").css("display","block");
    }
}

$(function(){
    $(".btn-address").click(function(){
        
        var id = $("input[name='addressid']").val();
        if (id){
           toAddress('/u/address/'+id+'/update');
           $("input[name='addressid']").val('');
        }else{
           toAddress('/u/address/add');
        }
    });

    $("#editAddress").click(function(){
        $(this).parents(".row").next(".edit-data").show();
        $("#datas").html('');
        $("#datas").ProvinceCity('', '');
    });

    $(".btn-cancel").click(function(){
        $(this).parents(".edit-data").hide();
        $("#datas select").eq(0).val('请选择');
        $("#datas select").eq(1).val('请选择');
        $("#datas select").eq(2).val('请选择');
        $("input[name='address']").val('');
        $("input[name='postcode']").val('');
        $("input[name='name']").val('');
        $("input[name='phone']").val('');
    });
    jQuery.validator.addMethod("call", function(value,element) {
      var call = /^1[3,4,5,7,8][0-9]{9}$/;
      if(call.test(value))
        return true;
      return false;
    },"error call");
    
    jQuery.validator.addMethod("code", function(value,element) {
      var code = /^[0-9]{6}$/;
      if("" == value || code.test(value))
        return true;
      return false;
    },"error code");

    jQuery.validator.addMethod("zh", function(value,element) {
      var zh = /^[\u4e00-\u9fa5]{2,6}$/;
      if( zh.test(jQuery.trim(value)))
        return true;
      return false;
    },"error zh");

    $(".edit-datafrom").validate({
        rules:{
          address:{
            required:true
          },
          name:{
            required:true,
            rangelength:[2,6],
            zh:true
          },
          phone:{
            required:true,
            call:true
          },
          postcode:{
            code:true
          }
        },
        messages:{
          address:{
            required:"请输入街道地址"
          },
          name:{
            required:"请输入收货人",
            rangelength:"请输入2到6个中文字符",
            zh:"请输入2到6个中文字符"
          },
          phone:{
            required:"请输入联系电话",
            call:"请输入正确的联系电话"
          },
          postcode:{
            code:"邮政编码格式错误"
          }
        }
    });
    /*
    var from = $(".edit-data").Validform({
       btnSubmit:".btn-address",
       tiptype:4,
       showAllError:true
       //ajaxPost:true
    });
    
        from.addRule([
            {
              ele:"#name",
              datatype:/^[\u4e00-\u9fa5]{2,6}$/ ,
              nullmsg:"请输入收货人!",
              errormsg:"请输入2到6个中文字符!"
            }
        ]);*/

    $(".setFlag").click(function(){
       var data = $(this).attr('data');
       var rate = $(this).attr('rate');
       if (rate == 100) {
           url = "/u/address/"+data+"/undefault";
           setDefaultFlag(url);
       }else{
           url = "/u/address/"+data+"/default";
           setDefaultFlag(url);
       }
    });
});
