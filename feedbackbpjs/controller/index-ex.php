<?php
include "koneksi.php";
session_start();
if(isset($_POST['perintah'])){
    $perintah = $_POST['perintah'];
    if($perintah === "hapusfeedback"){
        $hapus = $_POST['hapus'];
        $kueri = mysql_query("DELETE FROM bpjs_feedback WHERE IDfeedback = '$hapus'");
        if($kueri){
            echo include "tayangkan-tabel-feedback.php";
        }else
            echo "gagal";
    }
}else if(isset($_POST['GantiAdmin'])){
    $admin      = $_POST['GantiAdmin'];
    $nama       = $admin[0];
    $pwdbaru    = $admin[1];
    $u_pwdbaru  = $admin[2];
    
    if($pwdbaru === $u_pwdbaru){
        $enpwd      = md5($pwdbaru);
        $sesinama   = $_SESSION['nama'];
        $Gantiadmin = mysql_query("UPDATE `bpjs_user` SET `Nama`='$nama',`KataSandi`='$enpwd' WHERE `Nama`='$sesinama'");
        $_SESSION['nama'] = $nama;
        echo "sukses";
    }else{
        echo "password tidak sama";
    }
}
?>