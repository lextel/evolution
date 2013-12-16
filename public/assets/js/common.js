/**
 * Created by ui-1 on 13-12-13.
 */
/*导航菜单*/
$(function(){
    $(".nav-menu dl:first dd").click(function(){
        $(".nav-menu dl:first dd").removeClass("active");
        $(this).addClass("active");
        $(".main div.panel-body").addClass("d_n");
        $(".main div.panel-body").eq($(".nav-menu dl:first dd").index($(this))).removeClass("d_n");
    });
});
/*晒单--晒单状态*/
$(function(){
    $(".bask-menu .btn-group button").click(function(){
        $(".bask-menu .btn-group button").removeClass("btn-danger");
        $(this).addClass("btn-danger");
        $(".bask-menu .table").addClass("d_n");
        $(".bask-menu .table").eq($(".bask-menu .btn-group button").index($(this))).removeClass("d_n");
    });
});