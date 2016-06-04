$(".admin").click(function(){
    $(".admin-form").css("display","block");
    $(".user-form").css("display","none");
});
$(".user").click(function(){
    $(".user-form").css("display","block");
    $(".admin-form").css("display","none");
});