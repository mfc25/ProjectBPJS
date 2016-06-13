//ganti menjadi formulir untuk login sebagai admin
$(".admin").click(function(){
    $(".admin-form").css("display","block");
    $(".user-form").css("display","none");
});
//ganti menjadi formulir untuk login sebagai user biasa
$(".user").click(function(){
    $(".user-form").css("display","block");
    $(".admin-form").css("display","none");
});
//masuk sebagai user
$("#user").click(function(){
    jQuery.ajax({
        url     : "controller/proses.php",
        type    : "post",
        data    : {user : "user"},
        success : function(s){
            if(s == "berhasil")
                window.location.href = "view/user/index.php";
        }
    });
});
//masuk sebagai admin
$("#admin").click(function(){
    var id = [];
    id[0] = $("input[name='nama']").eq(0).val();
    id[1] = $("input[name='sandi']").eq(0).val();
    jQuery.ajax({
        url     : "controller/proses.php",
        type    : "post",
        data    : {user : "admin", data : id},
        success : function(s){
            if(s == "berhasil"){
                window.location.href = "view/admin/index.php";
            }
            else if(s == "data_tidak_benar")
                gagalLogin();
        }
    });
});
//popup pemberitahuan gagal masuk sebagai admin
function gagalLogin(){
    bootbox.dialog({
        closeButton : false,
        message     : "Username atau password Salah",
        title       : "Gagal Login",
        buttons: {
            main: {
                label: "Okay",
                className: "konfirmasi-batal btn-danger"
            }
        }
    });
}