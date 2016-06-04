<?php
include "koneksi.php";
$loket  = $_POST['loket'];
$puas   = $_POST['puas'];
if(isset($_POST['alasan']))
    $alasan = $_POST['alasan'];
else
    $alasan = null;

date_default_timezone_set("Asia/Jakarta");
$tanggal    = date("Y-m-d");
$id         = date("y.m.d.h.i.s");
$kueri = mysql_query("INSERT INTO bpjs_feedback(IDfeedback, loket, kepuasan, alasan, tanggal) VALUES('$id','$loket','$puas', '$alasan','$tanggal')");
if($kueri)
    echo "sukses";
else
    echo "gagal";
?>