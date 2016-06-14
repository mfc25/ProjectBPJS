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
| mengganti data administrator
=======================================================
*/
$(".ganti-administrator").click(function(){
    nama        = $(".panel-administrator input[name='nama']").val();
    sandi       = $(".panel-administrator input[name='pwdbaru']").val();
    ulang_sandi = $(".panel-administrator input[name='u_pwdbaru']").val();
    
    var data    = [];
    data[0]     = nama;
    data[1]     = sandi;
    data[2]     = ulang_sandi;
    jQuery.ajax({
        url     : "../../controller/admin.php",
        type    : "POST",
        data    : {ganti_admin : data},
        success : function(s){
            if(s == "berhasil")
                sukses_ganti_data_admin();
            else if(s == "data_tidak_tepat")
                data_tidak_tepat();
            else
                kesalahan_sistem();
                
        }
    });
});

//popup jika data administrator sukses diganti
function sukses_ganti_data_admin(){
    bootbox.dialog({
        closeButton : false,
        message     : "Sukses mengganti data Administrator",
        title       : "Informasi",
        buttons: {
            success: {
                label: "Okay",
                className: "btn-default",
                callback: function() {
                    location.reload(true);
                }
            }
        }
    });
}

//popup jika ada kesalahan aturan dalam mengganti data administrator
function data_tidak_tepat(){
    bootbox.dialog({
        closeButton : false,
        message     : "Data yang Anda masukkan tidak benar",
        title       : "Peringatan",
        buttons: {
            success: {
                label: "Okay",
                className: "btn-danger"
            }
        }
    });
}

//popup jika ada kesalahan query(sistem)
function kesalahan_sistem(){
    bootbox.dialog({
        closeButton : false,
        message     : "Gagal melaksanakan perintah(Query-SQL)",
        title       : "Terjadi Kesalahan",
        buttons: {
            success: {
                label: "Okay",
                className: "btn-danger"
            }
        }
    });
}   
$("#jumlahloket button").click(function(){
    nid = $(this).attr("id");
    jQuery.ajax({
        url     : "../../controller/admin.php",
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

var IDFeedback = "";
$(".hapus-feedback").click(function(){
    var tgl,loket, kepuasan, alasan,teks;
    
    IDFeedback  = $(this).parent().parent().children().eq(1).html();
    tgl         = $(this).parent().parent().children().eq(2).html();
    loket       = $(this).parent().parent().children().eq(3).html();
    kepuasan    = $(this).parent().parent().children().eq(4).html();
    alasan      = $(this).parent().parent().children().eq(5).html();
    teks =  "<table class='table tabel-konfirmasi-hapus'>"+
                "<tr>"+
                    "<td>ID</td><td>:</td><td>"+IDFeedback+"</td>"+
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
        closeButton : false,
        message     : "Data yang akan dihapus" + teks,
        title       : "Konfirmasi",
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
        url     : "../../controller/admin.php",
        data    : {HapusFeedback : IDFeedback},
        type    : "post",
        success : function(info){
            if(info == "gagal"){
                alert(info);
            }else if(info == "berhasil"){
                location.reload(true);
            }
        }
    })
}
/*
==================================================
| pengaturan paging halaman
==================================================
*/
$(".pengaturan-paging button").click(function(){
    var jmlbaris        = $(".jumlahbaris").eq(0).val();
    if(jmlbaris.length < 1){
        jmlbaris = "1";
    }
    window.location.href = "?feedback&limit=" + jmlbaris;
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
    
    //posisi menunjukkan kolom mana yang digunakan untuk sorting
    posisi_kolom = $(".posisi-sort span").html();
    
    jQuery.ajax({
        url     : "../../controller/admin.php",
        type    : "post",
        data    : {sortFeedback : localStorage.typesort, posisi_kolom : posisi_kolom},
        success : function(s){
            location.reload(true);
        }
    });
});

/*
==================================================
| jQuery numeric input only
==================================================
| fungsi ini digunakan untuk memblokir input
| selain angka/numerik dan tombol hapus(keyboard)
*/
$(".jumlahbaris").keypress(function(e){
    if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
        return false;
});