<?php
$pagingpost = 0;
$halaman    = 0;
$pagingbts  = 8;
if(($_SESSION['bpjs_pengguna']) !== "admin-PortalBpjs")
{
    header("location:../../index.php");
}
if(isset($_GET['limit']))
{
    $_SESSION['paging-limit'] = $pagingbts = $_GET['limit'];
}
else if(isset($_SESSION['paging-limit']))
{
    $pagingbts = $_SESSION['paging-limit'];
}
$limit_loket = mysql_fetch_assoc(mysql_query("SELECT Jumlah FROM jmlloket"));
$jml_loket  = $limit_loket['Jumlah'];
$paging     = mysql_query("SELECT * FROM bpjs_feedback WHERE `loket`<=$jml_loket");
$jmlbaris   = mysql_num_rows($paging);
$br         = 0;
while($br < $jmlbaris){
    $br += $pagingbts;
    $halaman++;
}
if(isset($_GET['page']))
{
    $pagingpost = $_GET['page'];
    $_SESSION['paging-location'] = $_GET['page'];
    $pagingpost --;
    if($pagingpost >= $halaman)
        $pagingpost = $halaman;
}
?>