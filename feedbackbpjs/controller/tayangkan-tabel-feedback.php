<?php
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

$kueriTabelFeedback = mysql_query("SELECT * FROM bpjs_feedback LIMIT ".$pagingpost * $pagingbts.", ".$pagingbts);
$nomor = 1;
$judul = "<tr>
            <th>Nomor</th>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Loket</th>
            <th>Kepuasan</th>
            <th>Alasan</th>
            <th>Pilihan</th>
        </tr>";
$isi = "";
while($cetak = mysql_fetch_assoc($kueriTabelFeedback)){
    $isi  .= "<tr>".
                "<td>".($pagingpost * $pagingbts + $nomor)."</td>".
                "<td>".$cetak["IDfeedback"]."</td>".
                "<td class='tanggal'>".$cetak["tanggal"]."</td>".
                "<td>".$cetak["loket"]."</td>".
                "<td>".$cetak["kepuasan"]."</td>".
                "<td>".$cetak["alasan"]."</td>".
                "<td><button class='btn btn-danger btn-sm TFhapus'>Hapus <span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td>".
            "<tr/>";
    $nomor++;
}
print $judul.$isi;
?>