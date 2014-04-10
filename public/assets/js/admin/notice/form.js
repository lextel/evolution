$(function () {

    // 实例化编辑器
    var ue = new UE.ui.Editor();
    ue.render("form_desc");

    // 预览功能修改
    $(document).on('click', '#edui173', function() {
        $('.navbar-fixed-top').hide();
    });

    // 关闭预览
    $(document).on('click', '#edui172', function() {
        $('.navbar-fixed-top').show();
    });
});
