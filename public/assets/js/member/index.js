$(function() {
    $( "#datepicker" ).datepicker({
      showWeek: true,
      firstDay: 1
    });
    $( "#datepicker1" ).datepicker({
      showWeek: true,
      firstDay: 1
    });

    function getDateSearch(url){
        var action = url;
        var form = $("<form></form>")
        form.attr('action',action)
        form.attr('method','get')
        var input1 = $("#datepicker").val();
        var input2 = $("#datepicker1").val();
        if (input1 && input2){
           form.append("<input type='hidden' name='date1' value="+input1+">");
           form.append("<input type='hidden' name='date2' value="+input2+">");
           form.submit()
        }
    }

    function getWordSearch(url){
        var action = url;
        var form = $("<form></form>")
        form.attr('action',action)
        form.attr('method','get')
        var input1 = $("#word").val();
        form.append("<input type='hidden' name='word' value="+input1+">");
        form.submit()
    }

    $(".wins-date-search").click(function (){
        var url = '/u/wins';
        getDateSearch(url);
    });

    $(".wins-search").click(function (){
        var url = "/u/wins";
        getWordSearch(url);
    });

    $(".order-word-search").click(function (){
        var url = "/u/orders";
        getWordSearch(url);
    });

    $(".order-date-search").click(function (){
        var url = '/u/orders';
        getDateSearch(url);
    });

    $(".buylog-date-search").click(function (){
        var url = '/u/moneylog/b';
        getDateSearch(url);
    });

    $(".rechargelog-date-search").click(function (){
        var url = '/u/moneylog';
        getDateSearch(url);
    });

    $(".allorders-date-search").click(function (){
        var url = '/l';
        getDateSearch(url);
    });

});
