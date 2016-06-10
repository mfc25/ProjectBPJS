<?php
include "koneksi.php";
/*
====================================================
| session untuk halaman index.php
====================================================
| digunakan untuk konfigurasi sesi di php
*/
session_start();
session_name("BpjsAD-sj25");
$nama = $_SESSION['nama'];
$AmbilnamaAdmin = mysql_query("SELECT Nama FROM bpjs_user WHERE Nama='$nama'");

//membuat session posisi, yaitu administrator dan user
$posisi = $_SESSION["posisi"];

//pengkondisian jika tidak terekam posisi
if($posisi === null){
    header("location:masuk.php");
}

$kueriLoket = mysql_query("SELECT Jumlah from `jmlloket`");
$ambilLoket = mysql_fetch_assoc($kueriLoket);
$jmlLoket   = $ambilLoket['Jumlah'];
?>