<?php
include "koneksi.php";
$pagingpost = 0;
$halaman    = 0;
$pagingbts  = 8;
if(isset($_GET['limit'])){
    $_SESSION['bpjs-sj25-paging-limit'] = $pagingbts = $_GET['limit'];
}else if(isset($_SESSION['bpjs-sj25-paging-limit'])){
    $pagingbts = $_SESSION['bpjs-sj25-paging-limit'];
}
$paging     = mysql_query("SELECT * FROM bpjs_feedback");
$jmlbaris   = mysql_num_rows($paging);
$br         = 0;
while($br < $jmlbaris){
    $br += $pagingbts;
    $halaman++;
}
if(isset($_GET['page'])){
    $pagingpost = $_GET['page'];
    $_SESSION['bpjs-sj25-paging-location'] = $_GET['page'];
    $pagingpost --;
    if($pagingpost >= $halaman)
        $pagingpost = $halaman;
}
?>