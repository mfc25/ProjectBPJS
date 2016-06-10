<?php
$host = "localhost";
$user = "root";
$pass = "";

$konek   = mysql_connect($host,$user, $pass);
$db      = mysql_select_db("db_bpjs_tulungagung",$konek);
if(!($konek)){
    echo "koneksi gagal";
}
if(!($db)){
    echo "database tidak ditemukan";
}
?>