$(function() {
    var xiaoyu = 1;
    var dayu = $(".btn-menu  >input").attr("amount");;


        $(".add").click(function (){
             var num  = 0;
            if($(this).html() =="+" || $(this).val() =="+" ){
                //alert(dayu);
                  if(isScope(getLastValue($(this)) , 1 , dayu) ==false){
                       return alert("Oh, can not be greater than "+dayu);
                   }
                    num = getLastValue($(this)).val();
                    getLastValue($(this)).val(parseInt(num)+1);
            }

            if($(this).html() =="-" || $(this).val() =="-" ){
                    if(isScope(getNextValue($(this)) , 0, xiaoyu) ==false){
                        return alert("Oh, can not be less than "+xiaoyu);
                    }
                    num = getNextValue($(this) ).val();
                    getNextValue($(this)).val(parseInt(num -1));
            }
         });


        $(".btn-menu  >input").change(function (){
            isNum($(this));
            //alert($(this).val());
        });



});


function isScope(obj,Compare,num){
    //xiaoyu
    if(Compare == 0){
          if(parseInt(obj.val()) <= parseInt(num ) ){
            return false;
         }
    }
    //dayu
     if(Compare == 1){
         if(parseInt(obj.val()) >= parseInt(num ) ){
            return false;
         }
    }
   return true;
}

function getLastValue(obj){
    return obj.prev();
}

function getNextValue(obj){
    return obj.next();
}


function isNum(obj){
     var re = /^[0-9]+.?[0-9]*$/;   //判断字符串是否为数字     //判断正整数 /^[1-9]+[0-9]*]*$/  

     if (!re.test(obj.val()))
    {
        alert("请输入数字(例:0.02)");
        obj.rate.focus();
        return false;
     }
     return true;
}