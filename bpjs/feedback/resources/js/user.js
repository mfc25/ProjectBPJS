var pilihanloket, kepuasan, alasan;
$("#pilihan-loket button").click(function(){
    
    //sembunyikan form dengan id "pilihan-loket"
    $("#pilihan-loket").css("display","none");
    
    //tampilkan form dengan id "kepuasan-loket"
    $("#kepuasan-loket").css("display","block");
    
    //ambil nomor loket dari form "pilihan-loket" tadi
    pilihanloket = $("input[name='pilihanloket']:checked").val();
    
    //nilai yang masuk ke variabel pilihan loket ditayangkan
    //ke elemen dengan id "nomor-loket"
    $("#nomor-loket").html(pilihanloket);
    
});
$("#btn-kepuasan-loket").click(function(){
    
    //mengambil value kepuasan loket pada input yang terpilih
    //dan menyimpan hasilnya kedalam variabel kepuasan
    kepuasan    = $("input[name='kepuasan']:checked").val();
    
    //inisiasi array "data" untuk menampung data pilihan loket dan kepuasan
    var data    = [];
    data[0]     = pilihanloket;
    data[1]     = kepuasan;
    if(kepuasan == "puas")
    {
        jQuery.ajax({
            url     : "../../controller/user.php",
            type    : "POST",
            data    : {Feedback : data},
            success : function(s){
                if(s == "berhasil")
                {
                    formulirsukses();
                }
                else
                {
                    formulirgagal();
                }
            }
        });
    }
    //jika kepuasan yang dipilih user adalah "tidak_puas"
    else if(kepuasan == "tidak_puas")
    {
        //MENGUNCI PILIHAN USER PADA PILIHAN "tidak_puas"
        //disable pilihan kepuasan yaitu emot puas dan tidak puas
        $("input[name='kepuasan']").attr("disabled",true);
        
        //hapus tombol pilihan kepuasan
        $("#btn-kepuasan-loket").remove();
        
        //menayangkan formulir alasan ketidakpuasan
        $("#tidak-puas").css("display","block");
        
    }
});

//user memilih alasan ketidakpuasannya terhadap pelayanan loket
$("input[name='alasan-tidak-puas']").click(function(){
    
    //menampung value alasan yang diambil dari input type radio
    //dengan name "alasan-tidak-puas"
    alasan = $("input[name='alasan-tidak-puas']:checked").val();
    
    //jika alasan yang dipilih adalah "lain-lain"
    if(alasan == "lain_lain")
    {
        //menayangkan textarea untuk memungkinkan user mengisi jawaban
        //sesuai dengan seleranya sendiri hingga maksimal tulisan 250 karakter
        $("#tidak-puas textarea").css("display","block");
    }
    else
    {
        //menyembunyikan kembali teksarea jika user memilih
        //alasan yang lain selain "lain-lain"
        $("#tidak-puas textarea").css("display","none");
    }
});

$("#btn-alasan-tidak-puas").click(function(){
    
    //menampung value alasan yang diambil dari input type radio
    //dengan name "alasan-tidak-puas"
    alasan = $("input[name='alasan-tidak-puas']:checked").val();
    
    //jika user memilih alasan lain-lain, maka value dari alasan
    //akan diambil dari value teksarea yang ditampilkan
    if(alasan == "lain_lain")
        //mengambil value dari textarea dan menampungnya
        //kedalam variabel alasan
        alasan = $("#tidak-puas textarea[name='alasan-tidak-puas']").val();
    
    //inisiasi array untuk menampung input user
    var data    = [];
    data[0]     = pilihanloket;
    data[1]     = kepuasan;
    data[2]     = alasan;
    jQuery.ajax({
        url     : "../../controller/user.php",
        type    : "POST",
        data    : {Feedback : data},
        success : function(s){
            if(s == "berhasil"){
                formulirsukses();
            }else if(s == "alasan_kosong"){
                formulirtidaklengkap();
            }else
                formulirgagal();
        }
    });
});

/*
========================================================
| menampilkan popup/modal data berhasil tersimpan
========================================================
| popup ini muncul ketika user telah selesai mengisi
| kuisioner dan menekan tombol sekesai.
*/
function formulirsukses(){
    bootbox.dialog({
        closeButton : false,
        message     : "Data berhasil disimpan. Terimakasih telah mengisi kuisioner",
        title       : "Sukses",
        buttons: {
            main: {
                label: "Selesai",
                className: "btn-success",
                callback: function() {
                    window.location.href = "../../index.php";
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
        closeButton : false,
        message     : "Data gagal disimpan, beritahu Administrator",
        title       : "Terjadi Kesalahan",
        buttons: {
            main: {
                label: "Selesai",
                className: "btn-danger",
                callback: function() {
                    window.location.href = "../../index.php";
                }
            }
        }
    });
}
function formulirtidaklengkap(){
    bootbox.dialog({
        closeButton : false,
        message     : "Data belum lengkap, lanjutkan mengisi formulir",
        title       : "Sukses",
        buttons: {
            main: {
                label: "Okay",
                className: "btn-warning"
            }
        }
    });
}