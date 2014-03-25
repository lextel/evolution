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
    if ((province != '请选择' || province != '') && (city != '请选择' || city != '') && (county != '请选择' || county != '')){
          if (address !='' && postcode !='' && name !='' && phone !=''){
             $.post(url,
             {province:province, city:city, county:county, address:address, postcode:postcode, name:name, phone:phone},
             function( data ){
               window.location.href = "/u/address";
             },
             'html'
             );
          }
    }else{
       $("#xperror").html("<span class='Validform_checktip Validform_wrong'>请选择地区</span>");
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

    var from = $(".editAddress>.edit-data").Validform({
       tiptype:3,
       label:".label",
       showAllError:true,
       ajaxPost:true
    });
    from.addRule([
            {
              ele:"#name",
              datatype:/^[\u4e00-\u9fa5]{2,6}$/ ,
              nullmsg:"请输入收货人!",
              errormsg:"请输入2到6个中文字符!"
            }
        ]);

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
