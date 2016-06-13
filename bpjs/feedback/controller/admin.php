<?php
include "../../controller/koneksi.php";
if(isset($_POST['ganti_admin']))
{
    $data   = $_POST['ganti_admin'];
    $nama   = $data[0];
    $sandi  = $data[1];
    $usandi = $data[2];
    if(
        $sandi === $usandi      &&
        strlen($nama)   >= 8    &&
        strlen($nama)   <= 16   &&
        strlen($sandi)  >= 8    &&
        strlen($sandi)  <= 16
      )
    {
        $sandi      = md5($sandi);
        $oldNama    = $_SESSION['bpjs_admin'];
        $kueri      = mysql_query(
            "UPDATE `bpjs_user` SET `Nama`='$nama', `KataSandi`='$sandi' WHERE `Nama`='$oldNama'"
        );
        if($kueri)
        {
            $_SESSION['bpjs_admin'] = $nama;
            echo "berhasil";
        }else
        {
            echo "kueri_gagal";
        }
    }else
    {
        echo "data_tidak_tepat";
    }
}else if(isset($_POST['JmlLoket']))
{
    $data = $_POST['JmlLoket'];
    
    //mengecek data jumlah loket di tabel "jmlloket"
    $kueri  = mysql_query("SELECT Jumlah FROM jmlloket");
    $loket  = mysql_fetch_assoc($kueri);
    $jumlah = $loket['Jumlah'];
    
    //jika Jumlah loket akan ditambahkan sementara data
    //jumlah loket masih kurang dari 6
    if($data === "tambah" && $jumlah < 6)
    {
        $tambah_loket = $jumlah + 1;
        $kueri = mysql_query("UPDATE jmlloket SET `Jumlah`='$tambah_loket' WHERE `Jumlah`='$jumlah'");
        if($kueri)
            echo "berhasil";
        else
            echo "gagal";
    }
    //jika Jumlah loket akan dikurangi sementara data
    //jumlah loket lebih dari 5
    else if($data === "kurang" && $jumlah > 4)
    {
        $kurang_loket = $jumlah - 1;
        $kueri = mysql_query("UPDATE jmlloket SET `Jumlah`='$kurang_loket' WHERE `Jumlah`='$jumlah'");
        if($kueri)
            echo "berhasil";
        else
            echo "gagal";
    }else
    {
        echo "gagal";
    }
}
//menghapus feedback
if(isset($_POST['HapusFeedback']))
{
    $data = $_POST['HapusFeedback'];
    $kueri = mysql_query("DELETE FROM bpjs_feedback WHERE IDfeedback = '$data'");
    if($kueri)
        echo "berhasil";
    else
        echo "gagal";
}
else if(isset($_POST['sortFeedback']))
{
    $typesort       = $_POST['sortFeedback'];
    
    if($typesort !== null)
        $_SESSION['BPJS_type_sort'] = $typesort;

    $posisi_kolom   = $_POST['posisi_kolom'];
    
    if($posisi_kolom !== null)
        $_SESSION['BPJS_sort_kolom'] = $posisi_kolom;
    
    //penomoran halaman
    $nomor      = 1;
    //posisi halaman
    $pagingpost = 0;
    
    if($posisi === "ID")
        $posisi = "IDfeedback";
    else
        $posisi = ucwords(strtolower($posisi));
}
?>