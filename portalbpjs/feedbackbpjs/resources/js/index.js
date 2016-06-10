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
| tooltip untuk tag input pada penggantian data admin
=======================================================
*/
$("[data-toggle='tooltip']").tooltip();

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
| menghapus tombol dan disable pilihan puas/tidak puas
========================================================
| perintah ini dijalankan ketika user telah mengklik
| tombol "Pilih" pada opsi "Tidak Puas".
*/
$("#loket button").eq(1).click(function(){
    $("#loket button").remove();
    $("#loket input[type='radio']").attr("disabled",true);
});
/*
========================================================
| menampilkan popup/modal data berhasil tersimpan
========================================================
| popup ini muncul ketika user telah selesai mengisi
| kuisioner dan menekan tombol sekesai. Berlaku untuk
| tombol "Selesai" bagian pertama dan kedua/terakhir
*/
function formulirsukses(){
    bootbox.dialog({
        message: "Data berhasil disimpan. Terimakasih telah mengisi kuisioner",
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

/*
========================================================
| menampilkan popup/modal data gagal tersimpan
========================================================
| popup ini muncul ketika user selesai mengisi kuisioner
| dan menekan tombol selesai, namun terjadi kesalahan
| ketika query mencoba mengeksekusi perintah memasukkan
| data kedalam database.
*/
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

/*
========================================================
| menampilkan popup/modal data tidak lengkap
========================================================
| popup ini muncul jika user memilih kuisioner kepuasan
| yaitu "tidak puas" dan memilih opsi "lain-lain".
| Pada opsi "lain-lain", user diminta memberikan
| jawaban diluar opsi yang telah diberikan dengan batas
| pengisian hingga 250 karakter
*/
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
    teks =  "<table class='table tabel-konfirmasi-hapus'>"+
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

/*
========================================================
| menampilkan popup/modal konfirmasi penghapusan data
========================================================
| popup/modal ini muncul ketika Administrator menekan
| tombol hapus pada kolom "pilihan" di tabel data
| Feedback, Administrator sistem bisa memilih untuk
| melanjutkan penghapusan data atau membatalkan perintah
| dengan mengakses tombol/petunjuk yang tersedia
*/
function konfirmasihapus(){
    jQuery.ajax({
        url     : "controller/index-ex.php",
        data    : {perintah : "hapusfeedback", hapus : Data_id},
        type    : "post",
        success : function(info){
            if(info == "gagal"){
                alert(info);
            }else if(info == "sukses"){
                location.reload(true);
            }
        }
    })
}

/*
========================================================
| PENGATURAN INFORMASI ADMINISTRATOR
========================================================
*/

$(".TUganti").click(function(){
    dataGanti       = [];
    dataGanti[0]    = $(".form-admin input[name='nama']").eq(0).val();
    dataGanti[1]    = $(".form-admin input[name='pwdbaru']").eq(0).val();
    dataGanti[2]    = $(".form-admin input[name='u_pwdbaru']").eq(0).val();
    jQuery.ajax({
        url     : "controller/index-ex.php",
        data    : {GantiAdmin : dataGanti},
        type    : "post",
        success : function(s){
        if(s == "sukses"){
            berhasilGantiAdmin();
        }else if(s == "gagal"){
            gagalGantiAdmin();
        }
    }
    });
});

function berhasilGantiAdmin(){
    bootbox.dialog({
        message: "Berhasil mengganti data Administrator",
        title: "Informasi",
        buttons: {
            main: {
                label: "OK",
                className: "btn-default",
                callback : function(){
                    location.reload(true);
                }
            }
        }
    });
}
function gagalGantiAdmin(){
    bootbox.dialog({
        message: "Gagal mengganti data Administrator",
        title: "Informasi",
        buttons: {
            main: {
                label: "OK",
                className: "btn-danger"
            }
        }
    });
}

/*
==================================================
| pengaturan paging halaman
==================================================
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
| selain angka/numerik dan tombol hapus(keyboard)
*/
$(".posisihalaman").keypress(function(e){
    if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
        return false;
});
$(".jumlahbaris").keypress(function(e){
    if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
        return false;
});

/*
==================================================
| sorting pada tabel feedback
==================================================
*/
$(".fa-sort").click(function(){
    $(".tabel-feedback tr").eq(0).children().removeClass("posisi-sort");
    $(this).parent().addClass("posisi-sort");
    
    if(localStorage.typesort != "ASC"){
        localStorage.typesort = "ASC";
    }else{
        localStorage.typesort = "DESC";
    }
    posisi = $(".posisi-sort span").html();
    
    jQuery.ajax({
        url     : "controller/index-ex.php",
        type    : "post",
        data    : {sortFeedback : localStorage.typesort, posisi : posisi},
        success : function(s){
            location.reload(true);
        }
    });
});
/*
==================================================
| Menambah jumlah Loket
==================================================
*/
$(".jml-loket button").click(function(){
    nid = $(this).attr("id");
    jQuery.ajax({
        url     : "controller/index-ex.php",
        type    : "post",
        data    : {JmlLoket : nid},
        success : function(s){
                if(s == "berhasil"){
                    location.reload(true);
                }else if(s == "gagal"){
                    alert(s);
                }
        }
    });
});
setInterval(function(){
    location.reload(true);
}300000);