<?php
include "koneksi.php";
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
    $oldNama    = $admin[0];
    $oldSandi   = $admin[1];
    $nama       = $admin[2];
    $sandi      = $admin[3];
    
    $kueriGantiadmin = null;
    
    if($oldNama !== $nama){
        $kueriGantiadmin .=",Nama='".$nama."'";
    }
    if($oldSandi !== $sandi){
        $kueriGantiadmin .= ",KataSandi='".$sandi."'";
    }
    if($kueriGantiadmin !== null){
        $kueriGantiadmin = substr($kueriGantiadmin, 1, strlen($kueriGantiadmin));
        $Gantiadmin = mysql_query("UPDATE `bpjs_user` SET `Nama`='$nama',`KataSandi`='$sandi' WHERE `Nama`='$oldNama'");
        if($Gantiadmin){
            echo include "tayangkan-tabel-user.php";
            $_SESSION['nama'] = $nama;
        }else
            echo "gagal";
    }
}
?>