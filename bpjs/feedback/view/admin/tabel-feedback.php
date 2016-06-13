<?php
if(isset($_SESSION['BPJS_type_sort']) && isset($_SESSION['BPJS_sort_kolom'])){
    $sort_kolom = $_SESSION['BPJS_sort_kolom'];
    if($sort_kolom === "ID")
        $sort_kolom = "IDfeedback";
    $type_sort   = $_SESSION['BPJS_type_sort'];
    $kueriTabelFeedback = mysql_query("SELECT * FROM bpjs_feedback WHERE `loket`<=$jml_loket ORDER BY `".$sort_kolom."` $type_sort LIMIT ".$pagingpost * $pagingbts.", ".$pagingbts);
}else{
    $kueriTabelFeedback = mysql_query("SELECT * FROM bpjs_feedback WHERE `loket`<=$jml_loket LIMIT ".$pagingpost * $pagingbts.", ".$pagingbts);
}
$nomor = 1;
$judul = "<tr>
            <th>Nomor</th>
            <th><span>ID</span><i class='fa fa-sort'></i></th>
            <th><span>Tanggal</span><i class='fa fa-sort'></i></th>
            <th><span>Loket</span><i class='fa fa-sort'></i></th>
            <th><span>Kepuasan</span><i class='fa fa-sort'></i></th>
            <th>Alasan</th>
            <th>Pilihan</th>
        </tr>";
$isi = "";
while($cetak = mysql_fetch_assoc($kueriTabelFeedback)){
    $isi .= "<tr>".
            "<td>".($pagingpost * $pagingbts + $nomor)."</td>".
            "<td>".$cetak["IDfeedback"]."</td>".
            "<td class='tanggal'>".$cetak["tanggal"]."</td>".
            "<td>".$cetak["loket"]."</td>".
            "<td>".$cetak["kepuasan"]."</td>".
            "<td>".$cetak["alasan"]."</td>".
            "<td><button class='btn btn-danger btn-sm hapus-feedback'>Hapus <span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></td>".
        "<tr/>";
    $nomor++;
}
print $judul.$isi;
?>