<?php
include "koneksi.php";
session_start();
session_name("BpjsAD-sj25");
$typePengguna = $_POST["pengguna"];
if($typePengguna === "user"){
    $_SESSION["posisi"] = "user";
    header("location:../index.php");
}else if($typePengguna === "admin"){
    $nama = $_POST["nama"];
    $sandi = $_POST["sandi"];
    $kueri = mysql_query("SELECT * FROM bpjs_user WHERE Nama = '$nama'");
    $cek = mysql_fetch_assoc($kueri);
    if($cek["KataSandi"] === md5($sandi)){
        $_SESSION["nama"]   = $cek["Nama"];
        $_SESSION["posisi"] = $cek["posisi"];
        header("location:../index.php");
    }else{
        header("location:../masuk.php");
    }
}else{
    header("location:../masuk.php");
}
?>