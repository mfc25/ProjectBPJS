<?php
include "../../controller/koneksi.php";

//mengelola data feedback

if(isset($_POST['Feedback']))
{
    $hitungloket = mysql_fetch_assoc(mysql_query("SELECT Jumlah FROM jmlloket"));
    $hitungloket = $hitungloket['Jumlah'];
    $data       = $_POST['Feedback'];
    $loket      = $data[0];
    
    //jika jumlah loket antara 4 sampai dengan 6
    //sesuai dengan jumlah yang telah ditentukan di tabel jumlahloket
    if($loket >= 1 && $loket <= $hitungloket)
    {
        $kepuasan   = $data[1];

        //menggenerasikan value tanggal dan id
        $tanggal    = date("Y-m-d");
        $id         = date("y.m.d.h.i.s");

        //jika user memilih puas atas pelayanan loket
        if($kepuasan === "puas")
        {
            //perintah untuk memasukkan data kepuasan pelanggan
            //data yang dimasukkan yaitu :
            //idfeedback, nomor loket, kepuasan, dan tanggal pengisian feedback
            $kueri = mysql_query(
                "INSERT INTO bpjs_feedback(IDfeedback, loket, kepuasan, alasan, tanggal)
                VALUES('$id','$loket','$kepuasan', '','$tanggal')"
            );
            //jika berhasil melaksanakan sql query input data kepuasan "puas"
            if($kueri)
                echo "berhasil";
            //jika gagal melaksanakan sql query input data kepuasan "puas"
            else
                echo "gagal";
        }
        //jika user memilih tidak_puas atas pelayanan loket
        else if($kepuasan === "tidak_puas")
        {
            //mengambil data alasan
            $alasan     = $data[2];
            
            //mengganti underscore(_) menjadi space( )
            $kepuasan   = str_replace("_", " ", $kepuasan);
            $alasan     = str_replace("_"," ", $alasan);
            //mengambil data alasan dari array data indeks ke 2
            //dan menampung valuenya kedalam $alasan
            if(strlen($alasan) > 0)
            {
                //perintah untuk memasukkan data kepuasan pelanggan
                //data yang dimasukkan yaitu :
                //idfeedback, nomor loket, kepuasan, alasan ketidakpuasan, dan tanggal pengisian feedback
                $kueri = mysql_query(
                    "INSERT INTO bpjs_feedback(IDfeedback, loket, kepuasan, alasan, tanggal)
                    VALUES('$id','$loket','$kepuasan', '$alasan','$tanggal')"
                );
                //jika berhasil melaksanakan sql query input data kepuasan "tidak puas"
                if($kueri)
                {
                    echo "berhasil";
                }
                //jika gagal melaksanakan sql query input data kepuasan "tidak puas"
                else
                {
                    echo "gagal";
                }
            }
            else
            {
                echo "alasan_kosong";
            }
        }
    }
    //jika jumlah loket tidak sesuai dengan batasan yang telah diatur sebelumnya
    //maka gagal memasukkan data kedalam database
    else
    {
        echo "gagal";
    }
}
else
{
    header("location:../index.php");
}
?>