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
function loginAdmin(){
var id = [];
    id[0] = $("input[name='nama']").eq(0).val();
    id[1] = $("input[name='sandi']").eq(0).val();
    jQuery.ajax({
        url     : "controller/proses.php",
        type    : "post",
        data    : {user : "admin", data : id},
        success : function(s){
            if(s == "berhasil")
                window.location.href = "view/admin/index.php";
            else if(s == "data_tidak_benar")
                gagalLogin();
            else
                masalah_kueri();
        }
    });
}
//LOGIN SEBAGAI ADMINISTRATOR

//event ketika admin menekan tombol enter keyboard
//ketika pointer berada di input field nama
$(".admin-form input[name='nama']").keypress(function(k){
    if(k.which == 13)
        loginAdmin();
});
//ketika pointer berada di input field sandi
$(".admin-form input[name='sandi']").keypress(function(k){
    if(k.which == 13)
        loginAdmin();
});
//event ketika admin menekan tombol "Masuk"
$("#admin").click(function(){
    loginAdmin();
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
//popup pemberitahuan Kesalahan pada kueri
function masalah_kueri(){
    bootbox.dialog({
        closeButton : false,
        message     : "Terjadi kesalahan perintah(Query-SQL)",
        title       : "Query Problem",
        buttons: {
            main: {
                label: "Okay",
                className: "konfirmasi-batal btn-danger"
            }
        }
    });
}