<?php
$host = "localhost";
$user = "root";
$pass = "";
session_start();
$konek   = mysql_connect($host,$user, $pass);
$db      = mysql_select_db("db_bpjs_tulungagung",$konek);

date_default_timezone_set("Asia/Jakarta");
if(!($konek)){
    echo "koneksi gagal";
}
if(!($db)){
    echo "database tidak ditemukan";
}
?>