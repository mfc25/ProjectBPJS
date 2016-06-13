<html>
    <head>
    <?php include "../../../controller/koneksi.php";?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Bootstrap -->
    <link href="../../../resources/public/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../../../resources/public/fontawesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="../../../resources/public/style.css" rel="stylesheet"/>
    <link href="../../../resources/public/css/simple-sidebar.css" rel="stylesheet"/>
    <link href="../../../resources/public/gambar/logo-bpjs.png"  rel="icon"/>
    <link href="../../resources/css/user.css" rel="stylesheet"/>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <span class="navbar-brand">
                        <img alt="Brand" src="../../../resources/public/gambar/logo-bpjs.png"/>
                        Feedback BPJS Kesehatan
                    </span>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">
                            <span>User</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="../../controller/keluar.php"><span class="fa fa-sign-out"></span>Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="box">
            <div class="panel panel-info" id="pilihan-loket">
                <div class="panel-heading"><center>Pilihan Loket</center></div>
                <div class="panel-body">
                    <?php include "loket.php"?>
                </div>
                <button class="btn btn-primary">Pilih</button>
                <div style="clear:right"></div>
            </div>
            <div class="panel panel-info" id="kepuasan-loket">
                <div class="panel-heading">Kepuasan Anda pada loket <span id="nomor-loket"></span></div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <input type="radio" name="kepuasan" id="puas" value="puas" checked/>
                        <label for="puas" class=" fa fa-smile-o" aria-hidden="true"></label>
                    </div>
                    <div class="col-md-6">
                        <input type="radio" name="kepuasan" id="tdkpuas" value="tidak_puas"/>
                        <label for="tdkpuas" class=" fa fa-frown-o" aria-hidden="true"></label>
                    </div>
                </div>
                <button id="btn-kepuasan-loket" class="btn btn-primary">Pilih</button>
                <div style="clear:right"></div>
                <div id="tidak-puas">
                    <div class="alert alert-success" role="alert">
                        <span><i class="glyphicon glyphicon-info-sign" aria-hidden="true"></i> Silahkan pilih alasan mengapa Anda tidak puas</span>
                    </div>
                    <div class="panel-body">
                        <input type="radio" name="alasan-tidak-puas" id="tp1" value="pelayanan_lama" checked/><label class="col-md-3" for="tp1">Pelayanan lama</label>
                        <input type="radio" name="alasan-tidak-puas" id="tp2" value="petugas_tidak_ramah"/><label class="col-md-3" for="tp2">Petugas tidak ramah</label>
                        <input type="radio" name="alasan-tidak-puas" id="tp3" value="informasi_kurang_jelas"/><label class="col-md-3" for="tp3">Informasi kurang jelas</label>
                        <input type="radio" name="alasan-tidak-puas" id="tp4" value="lain_lain"/><label class="col-md-3" for="tp4">lain-lain</label>
                        <textarea class="form-control" name="alasan-tidak-puas" placeholder="jelaskan alasan Anda (maks 250karakter)"></textarea>
                        <button id="btn-alasan-tidak-puas" class="btn btn-primary">Kirim</button>
                        <div style="clear:right"></div>
                    </div>
            </div>

            </div>
        </div>
        <script src="../../../resources/public/js/jquery.min.js"></script>
        <script src="../../../resources/public/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../../resources/public/js/bootbox.min.js"></script>
        <script src="../../resources/js/user.js"></script>
    </body>
</html>