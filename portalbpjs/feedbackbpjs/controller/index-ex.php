<?php
include "paging-setup.php";
session_start();

//menghapus feedback
if(isset($_POST['perintah'])){
    $perintah = $_POST['perintah'];
    if($perintah === "hapusfeedback"){
        $hapus = $_POST['hapus'];
        $kueri = mysql_query("DELETE FROM bpjs_feedback WHERE IDfeedback = '$hapus'");
        if($kueri){
            echo "sukses";
        }else
            echo "gagal";
    }
//mengganti informasi admin
}else if(isset($_POST['GantiAdmin'])){
    $admin      = $_POST['GantiAdmin'];
    $nama       = $admin[0];
    $pwdbaru    = $admin[1];
    $u_pwdbaru  = $admin[2];
    
    if(
        strlen($nama) >= 8 && strlen($nama) <= 16 &&
        strlen($pwdbaru) >= 8 && strlen($pwdbaru) <= 16 &&
        strlen($u_pwdbaru) >= 8 && strlen($u_pwdbaru) <= 16
      ){
        if($pwdbaru === $u_pwdbaru){
            $enpwd      = md5($pwdbaru);
            $sesinama   = $_SESSION['nama'];
            $Gantiadmin = mysql_query("UPDATE `bpjs_user` SET `Nama`='$nama',`KataSandi`='$enpwd' WHERE `Nama`='$sesinama'");
            $_SESSION['nama'] = $nama;
            echo "sukses";
        }else{
            echo "gagal";
        }
    }else{
        echo "gagal";
    }
//membuat sorting pada tabel feedback
}else if(isset($_POST['sortFeedback'])){
    $typesort   = $_POST['sortFeedback'];
    
    if($typesort !== null)
        $_SESSION['BPJStypesort'] = $typesort;

    $posisi     = $_POST['posisi'];
    
    if($posisi !== null)
        $_SESSION['BPJSposisi'] = $posisi;
    
    //penomoran halaman
    $nomor      = 1;
    //posisi halaman
    $pagingpost = 0;
    
    if($posisi === "ID")
        $posisi = "IDfeedback";
    else
        $posisi = ucwords(strtolower($posisi));
}else if(isset($_POST['JmlLoket'])){
    $perintah = $_POST['JmlLoket'];
    $dataLoket = mysql_query("SELECT `Jumlah` FROM jmlloket");
    $dataJmlLoket = mysql_fetch_assoc($dataLoket);
    $jmlLoket       = $dataJmlLoket['Jumlah'];
    if($perintah === "tbh-loket"){
        if($dataJmlLoket['Jumlah'] < 6){
            $jmlLoket++;
            mysql_query("UPDATE `jmlloket` SET `Jumlah`='$jmlLoket'");
            echo "berhasil";
        }
        else
            echo "gagal";
    }else if($perintah === "krg-loket"){
        if($dataJmlLoket['Jumlah'] > 4){
            $jmlLoket--;
            mysql_query("UPDATE `jmlloket` SET `Jumlah`='$jmlLoket'");
            echo "berhasil";
        }
        else
            echo "gagal";
    }
}
?>