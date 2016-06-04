/*
=======================================================
| tombol toggle menu
=======================================================
| berfungsi untuk toggle buka/tutup menu sidebar di
| bagian kiri tampilan
*/
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
/*
=======================================================
| tombol "Pilih" pada kuisioner pilihan loket
=======================================================
| ketika tombol ini diklik, pengguna yang berada di
| kuisioner pilihan loket diarahkan menuju kuisioner
| selanjutnya
*/
$("#pilihanloket button").click(function(){
    var pilihan = $("input[name='pilihanloket']:checked").val();
    $("#loket").css("display","block");
    $("#pilihanloket").css("display","none");
    $("#nomorloket").html(pilihan);
});
/*
========================================================
| tombol "Pilih" atau "Selesai" pada kuisioner kepuasan
| pengguna
========================================================
| tombol ini dibuat berdasarkan dua kondisi,
| yang pertama yaitu kondisi jika pengguna sudah puas
| atas layanan BPJS, maka pengguna dapat langsung
| mengakhiri pengisian kuisioner, sementara jika tidak
| puas akan diberikan kuisioner tambahan yaitu
| detail/alasan ketidakpuasannya
*/
$("#loket button").click(function(){
    var kepuasan = $("input[name='puas']:checked").val();
    if(kepuasan == "tidak puas"){
        $("#loket button").eq(0).addClass("disabled").attr("disabled");
        $("#loket button").eq(1).addClass("disabled").attr("disabled");
        $("#tidakpuas").css("display","block");
    }
});
/*
========================================================
| buka textarea ketika klik pilihan "lain-lain"
========================================================
| fungsi akan bekerja ketika user memilih opsi lain-lain
| pada formulir "tidak puas"
*/
$("input[name='tp']").click(function(){
    var n = $("input[name='tp']:checked").val();
    if(n == "lain-lain")
        $("textarea[name='tp']").css("display","block");
    else
        $("textarea[name='tp']").css("display","none");
});
/*
=======================================================
| tombol "Pilih" ditampilkan
=======================================================
| tombol "Pilih" ditampilkan ketika Pengguna memilih
| pilihan "tidak puas" terhadap layanan
*/
$("#loket #tdkpuas").click(function(){
    $("#loket .btn-primary").css("display","inline-block");
    $("#loket .btn-success").css("display","none");
});
/*
========================================================
| tombol "Selesai" ditampilkan
========================================================
| tombol "Selesai" ditampilkan ketika pengguna memilih
| pilihan "puas" terhadap layanan
*/
$("#loket #puas").click(function(){
    $("#loket .btn-primary").css("display","none");
    $("#loket .btn-success").css("display","inline-block");
});

/*
========================================================
| fontawesome check ketika berada di pilihan tidak puas
========================================================
| fontawesome fa-check akan muncul ketika user memilih
| salah satu opsi tidak puas dari pilihan yang
| disediakan
*/
$("#tidakpuas .row label").click(function(){
    $("#tidakpuas .row i").removeClass("fa-check-square-o");
    $(this).children().addClass("fa-check-square-o");
});
function formulirsukses(){
    bootbox.dialog({
        message: "Data berhasil disimpan",
        title: "Sukses",
        buttons: {
            main: {
                label: "Selesai",
                className: "btn-success",
                callback: function() {
                    window.location.href = "masuk.php";
                }
            }
        }
    });
}
function formulirgagal(){
    bootbox.dialog({
        message: "Data gagal disimpan, beritahu Administrator",
        title: "Terjadi Kesalahan",
        buttons: {
            main: {
                label: "Selesai",
                className: "btn-danger",
                callback: function() {
                    window.location.href = "masuk.php";
                }
            }
        }
    });
}

function formulirtidaklengkap(){
    bootbox.dialog({
        message: "tuliskan alasan Anda",
        title: "Peringatan",
        buttons: {
            main: {
                label: "Kembali",
                className: "btn-default"
            }
        }
    });
}
$("#loket button").eq(1).click(function(){
    $("#loket button").remove();
    $("#loket input[type='radio']").attr("disabled",true)
});

/*
=========================================================
| tombol "Selesai" pertama pada kuisioner
=========================================================
| tombol ini muncul jika Pengguna merasa puas terhadap
| layanan yang diberikan. ketika diklik, tombol ini
| menggunakan perintah jQuery Ajax untuk mengirimkan data
| kuisioner yaitu berupa nama Pengguna, nomor loket, dan
| data kepuasannya
*/
$("#selesai1").click(function(){
    var nama, pilihanloket, kepuasan;
    nama         = $("#nama").html();
    pilihanloket = $("input[name='pilihanloket']:checked").val();
    kepuasan     = $("input[name='puas']:checked").val();
    jQuery.ajax({
        url     :   "controller/input.php",
        data    :   {nama:nama, loket:pilihanloket, puas:kepuasan},
        type    :   "POST",
        success :
        function(info){
            if(info == "sukses"){
                $("#loket button").remove();
                formulirsukses();
            }else{
                $("#loket button").remove();
                formulirgagal()
            }
        }
    });
});
/*
=========================================================
| tombol "Selesai" kedua pada kuisioner
=========================================================
| tombol ini muncul jika pengguna merasa tidak puas
| terhadap layanan yang diberikan. Ketika diklik,
| tombol ini mengeksekusi perintah jQuery Ajax untuk
| mengirimkan data kuisioner yaitu berupa nomor loket,
| data kepuasannya, serta alasan.
*/
$("#selesai2").click(function(){
    var nama, pilihanloket, kepuasan, alasan;
    nama         = $("#nama").html();
    pilihanloket = $("input[name='pilihanloket']:checked").val();
    kepuasan     = $("input[name='puas']:checked").val();
    alasan       = $("input[name='tp']:checked").val();
    if(alasan == "lain-lain"){
        alasan = $("textarea").val();
    }
    if(alasan.length > 0){
        jQuery.ajax({
            url     : "controller/input.php",
            data    : {nama:nama, loket:pilihanloket, puas:kepuasan, alasan:alasan},
            type    : "post",
            success : function(info){
                if(info == "sukses"){
                    $("#tidakpuas button").remove();
                    $("#tidakpuas textarea").remove();
                    formulirsukses();
                }else{
                    $("#tidakpuas button").remove();
                    $("#tidakpuas textarea").remove();
                    formulirgagal();
                }
            }
        });
    }else{
        formulirtidaklengkap();
    }
});
var Data_id="";

/*
=========================================================
| tombol untuk menghapus rekam feedback
=========================================================
| tombol ini berguna untuk menghapus satu baris data
| feedback pelayanan BPJS.
*/
$(".TFhapus").click(function(){
    var tgl,loket, kepuasan, alasan,teks;
    
    Data_id     = $(this).parent().parent().children().eq(1).html();
    tgl         = $(this).parent().parent().children().eq(2).html();
    loket       = $(this).parent().parent().children().eq(3).html();
    kepuasan    = $(this).parent().parent().children().eq(4).html();
    alasan      = $(this).parent().parent().children().eq(5).html();
    teks =  "<table class='table'>"+
                "<tr>"+
                    "<td>ID</td><td>:</td><td>"+Data_id+"</td>"+
                "</tr>"+
                "<tr>"+
                    "<td>Tanggal</td><td>:</td><td>"+tgl+"</td>"+
                "</tr>"+
                "<tr>"+
                    "<td>Loket</td><td>:</td><td>"+loket+"</td>"+
                "</tr>"+
                "<tr>"+
                    "<td>Kepuasan</td><td>:</td><td>"+kepuasan+"</td>"+
                "</tr>"+
                "<tr>"+
                    "<td>Alasan</td><td>:</td><td>"+alasan+"</td>"+
                "</tr>"+
            "</table>";

    bootbox.dialog({
        message: "Data yang akan dihapus" + teks,
        title: "Konfirmasi",
        buttons: {
            success: {
                label: "Hapus",
                className: "konfirmasi-hapus btn-default",
                callback: function() {
                    konfirmasihapus()
                }
            },
            main: {
                label: "Batal",
                className: "konfirmasi-batal btn-primary"
            }
        }
    });
});
function konfirmasihapus(){
    jQuery.ajax({
        url     : "controller/index-ex.php",
        data    : {perintah : "hapusfeedback", hapus : Data_id},
        type    : "post",
        success : function(info){
            if(info === "gagal"){
                alert(info);
            }else{
                $(".tabel-feedback").html(info);
                location.reload(true);
            }
        }
    })
}

var oldNama, oldSandi, nama, sandi;
$(".TUganti").click(function(){
    var iHtml = $(".TUganti span").html();
    if(iHtml == "Ganti"){
        oldNama     = $(".TUnama").html();
        oldSandi    = $(".TUsandi").children().val();
        $(".TUnama").html("<input type='text' value='" + oldNama + "' maxlength='20'/>");
        $(".TUsandi").children().attr("disabled",false);
        $(".TUganti span").html("Selesai");
    }else if(iHtml == "Selesai"){
        nama    = $(".TUnama").children().val();
        sandi   = $(".TUsandi").children().val();
        
        var data = [oldNama, oldSandi, nama, sandi];
        jQuery.ajax({
            url     : "controller/index-ex.php",
            data    : {'GantiAdmin':data},
            type    : "post",
            success : function(s){
                if(s == "gagal"){
                    alert(s);
                }else{
                    $(".tabel-user").html(s);
                        location.reload(true);
                }
            }
        });
        $(".TUganti span").html("Ganti");
    }
});

/*
==================================================
| pengaturan paging halaman
==================================================
|
*/
$(".kirim-pengaturan-halaman").click(function(){
    var posisihalaman   = $("input[name='posisihalaman']").val();
    if(posisihalaman.length < 1){
        posisihalaman = "1";
    }
    var jmlbaris        = $("input[name='jumlahbaris']").val();
    if(jmlbaris.length < 1){
        jmlbaris = "1";
    }
    window.location.href = "?feedback&page=" + posisihalaman + "&limit=" + jmlbaris;
});

/*
==================================================
| jQuery numeric input only
==================================================
| fungsi ini digunakan untuk memblokir input
| selain angka/numerik
*/
$(".posisihalaman").keypress(function(e){
    if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
        return false;
});
$(".jumlahbaris").keypress(function(e){
    if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
        return false;
});