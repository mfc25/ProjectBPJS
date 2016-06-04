<?php
include "koneksi.php";
$halaman    = 0;
$pagingpost = 1;
$paging     = mysql_query("SELECT * FROM bpjs_feedback");
$jmlbaris   = mysql_num_rows($paging);

$pagingbts  = 8;
if(isset($_GET['limit'])){
    $_SESSION['bpjs-sj25-paging-limit'] = $pagingbts = $_GET['limit'];
}else if(isset($_SESSION['bpjs-sj25-paging-limit'])){
    $pagingbts = $_SESSION['bpjs-sj25-paging-limit'];
}

$htmlPaging = "<ul class='pagination'>";
$br         = 0;
while($br < $jmlbaris){
    $br += $pagingbts;
    $halaman++;
}
if(isset($_GET['page'])){
    $pagingpost = $_GET['page'];
    if($pagingpost >= $halaman){
        $pagingpost = $halaman;
    }
}else
    $pagingpost = 1;
/*
==============================================================================
| #PAGING HALAMAN#
==============================================================================
| membuat paging untuk tabel dengan syarat jumlah halaman lebih dari 6
N = 20
jika n = 1
print   n, n+1, n+2, dan N
jika n = 2
print  nn,   n, n+1, dan N
jika n = 3
print  nn, n-1,   n,  n+1, dan N
jika n = 18
print  nn, n-1,   n,  n+1, dan N
jika n = 19
print  nn, n-1,   n,     N
jika n = 20
print  nn, n+2, n-1, dan n
*/
$HtmlPaging = "";
if($halaman >= 6){
    for($a = 1; $a <= $halaman; $a++){
        if($a == $pagingpost && $a == 1)
            $HtmlPaging =   "1<li class='active'><a href='?feedback&page=".$a."'>".$a."</a></li>
                            <li><a href='?feedback&page=".($a+1)."'>".($a+1)."</a></li>
                            <li><a href='?feedback&page=".($a+2)."'>".($a+2)."</a></li>
                            <li><a href='?feedback&page=".$halaman."'>&gt;</a></li>";
        if($a == $pagingpost && $a == 2)
            $HtmlPaging =   "2<li><a href='?feedback&page=1'>1</a></li>
                            <li class='active'><a href='?feedback&page=".($a)."'>".($a)."</a></li>
                            <li><a href='?feedback&page=".($a+1)."'>".($a+1)."</a></li>
                            <li><a href='?feedback&page=".$halaman."'>&gt;</a></li>";
        if($a == $pagingpost && $a >= 3)
            $HtmlPaging =   "3<li><a href='?feedback&page=1'>&lt;</a></li>
                            <li><a href='?feedback&page=".($a-1)."'>".($a-1)."</a></li>
                            <li class='active'><a href='?feedback&page=".($a)."'>".($a)."</a></li>
                            <li><a href='?feedback&page=".($a+1)."'>".($a+1)."</a></li>
                            <li><a href='?feedback&page=".$halaman."'>&gt;</a></li>";
        if($a == $pagingpost && $a + 2 == $halaman)
            $HtmlPaging =   "4<li><a href='?feedback&page=1'>&lt;</a></li>
                            <li><a href='?feedback&page=".($a-1)."'>".($a-1)."</a></li>
                            <li class='active'><a href='?feedback&page=".($a)."'>".($a)."</a></li>
                            <li><a href='?feedback&page=".($a+1)."'>".($a+1)."</a></li>
                            <li><a href='?feedback&page=".$halaman."'>&gt;</a></li>";
        if($a == $pagingpost && $a + 1 == $halaman)
            $HtmlPaging =   "5<li><a href='?feedback&page=1'>&lt;</a></li>
                            <li><a href='?feedback&page=".($a-1)."'>".($a-1)."</a></li>
                            <li class='active'><a href='?feedback&page=".($a)."'>".($a)."</a></li>
                            <li><a href='?feedback&page=".$halaman."'>".$halaman."</a></li>";
        if($a == $pagingpost && $a == $halaman)
            $HtmlPaging =   "6<li><a href='?feedback&page=1'>&lt;</a></li>
                            <li><a href='?feedback&page=".($a-2)."'>".($a-2)."</a></li>
                            <li><a href='?feedback&page=".($a-1)."'>".($a-1)."</a></li>
                            <li class='active'><a href='?feedback&page=".$halaman."'>".$halaman."</a></li>";
    }

}else if($halaman < 6){
    for($a = 1; $a <= $halaman; $a++){
        if($a == $pagingpost)
            $HtmlPaging .= "<li class='active'><a href='?feedback&page=".$a."'>".$a."</a></li>";
        else
            $HtmlPaging .= "<li><a href='?feedback&page=".$a."'>".$a."</a></li>";
    }
}
$htmlPaging .= $HtmlPaging . "</ul>";
print $htmlPaging;

///1 3 4 5 60 maks 60, posisi 4
/// if halaman > 5
?>