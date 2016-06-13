<?php
include "../../controller/koneksi.php";

if(isset($_POST['user']))
{
    $type_user = $_POST['user'];
    if($type_user === "user")
    {
        $_SESSION['bpjs_pengguna'] = "user";
        echo "berhasil";
    }
    else if($type_user === "admin")
    {
        $dataAdminBpjs = $_POST['data'];
        $nama   = $dataAdminBpjs[0];
        $sandi  = $dataAdminBpjs[1];
        
        $CekDataAdmin = mysql_query("SELECT * FROM bpjs_user");
        $data = mysql_fetch_assoc($CekDataAdmin);
        if(
            $nama === $data['Nama'] &&
            md5($sandi) === $data['KataSandi']
          )
        {
            $_SESSION['bpjs_pengguna']  = "admin-PortalBpjs";
            $_SESSION['bpjs_admin']     = $nama;
            echo "berhasil";
        }
        else
        {
            echo "data_tidak_benar";
        }
    }
    else
    {
        header("location:../index.php");
    }
}
else
{
    header("location:../index.php");
}
?>