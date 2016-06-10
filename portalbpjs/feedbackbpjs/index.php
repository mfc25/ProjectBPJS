<?php include "controller/index-session.php";?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "template/head.php"?>
        <link href="resources/css/simple-sidebar.css" rel="stylesheet"/>
        <link href="resources/css/index.css" rel="stylesheet"/>
        <?php if($posisi === "user"){ ?>
        <link href="resources/css/index-user.css" rel="stylesheet"/>
        <?php } ?>
        <title>BPJS : Feedback pelayanan</title>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <span class="navbar-brand">
                        <img alt="Brand" src="../resources/public/gambar/logo-bpjs.png"/>
                        Kuisioner BPJS Kesehatan
                    </span>
                    <?php if($posisi === "BpjsAD-sj25-05th16"){ ?>
                    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                    <?php } ?>
                </div>
                <?php if($posisi === "BpjsAD-sj25-05th16"){ ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">
                            <span id="namaAdmin"><?php echo $_SESSION['nama']?></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="keluar.php"><span class="fa fa-sign-out"></span>Keluar</a></li>
                        </ul>
                    </li>
                </ul>
                <?php } ?>
            </div>
        </nav>
        <?php if($posisi === "BpjsAD-sj25-05th16"){ ?>
        <div id="wrapper">
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="<?php if(!isset($_GET['feedback']) && !isset($_GET['user'])){ ?>menu-aktif<?php }?>">
                        <a href="?"><i class="fa fa-tachometer"></i> Dashboard</a>
                    </li>
                    <li class="<?php if(isset($_GET['feedback'])){ ?>menu-aktif<?php }?>">
                        <a href="?feedback"><i class="fa fa-file-text"></i> Feedback</a>
                    </li>
                    <li class="<?php if(isset($_GET['user'])){ ?>menu-aktif<?php }?>">
                        <a href="?user"><i class="fa fa-user"></i> User</a>
                    </li>
                </ul>
                <section id="credit">&copy;dhanyn10</section>
            </div>
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(isset($_GET['user'])){ ?>
                                <table id="tabel-user" class="table table-bordered table-striped tabel-user">  
                                <?php include "template/tayangkan-tabel-user.php"?>
                                </table>
                            <?php }else if(isset($_GET['feedback'])){ ?>
                            <p class="jml-loket">Jumlah Loket
                                <button id="krg-loket" class="kurangloket btn btn-warning btn-sm"><i class="fa fa-minus"></i></button>
                                <input type="text" class="form-control input-sm" value="<?php echo $jmlLoket?>" style="width:30px;display:inline-block" disabled/>
                                <button id="tbh-loket" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></button>
                            </p>
                                <table id="tabel-feedback" class="table table-bordered table-striped tabel-feedback">
                                    <?php include "template/tayangkan-tabel-feedback.php"?>
                                </table>
                                <div style="display:block;"></div>
                                <?php include "controller/pagination.php"?>
                                <div class="pengaturan-halaman">
                                    <span>posisi halaman : <input class="posisihalaman" name="posisihalaman" type="text" value="<?php echo $pagingpost?>"/></span>
                                    <span>jumlah baris : <input class="jumlahbaris" name="jumlahbaris" type="text" value="<?php echo $pagingbts?>"/></span>
                                    <button class="kirim-pengaturan-halaman btn btn-primary btn-sm">GO</button>
                                </div>
                            <?php }else{ include "template/chart-feedback.php";}?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
        <?php } else if($posisi === "user"){ ?>
        <div class="box">
            <div class="pilih" id="pilihanloket">
                <h3>Pilihan loket</h3>
                <div class="container-fluid">
                    <div class="row-fluid">
                    <?php include "template/loket.php"?>
                    </div>
                </div>
                <button class="btn btn-primary btn-lg">Pilih</button>
                <div style="clear:right"></div>
            </div>
            <div class="pilih block" id="loket">
                <h3>Kepuasan Anda pada loket <span id="nomorloket"></span></h3>
                <div class="container-fluid">
                    <div class="col-md-6">
                        <input type="radio" name="puas" id="puas" value="puas" checked/>
                        <label for="puas" class=" fa fa-smile-o" aria-hidden="true"></label>
                    </div>
                    <div class="col-md-6">
                        <input type="radio" name="puas" id="tdkpuas" value="tidak puas"/>
                        <label for="tdkpuas" class=" fa fa-frown-o" aria-hidden="true"></label>
                    </div>
                </div>
                <button id="selesai1" class="btn btn-success btn-lg">Selesai</button>
                <button class="btn btn-primary btn-lg">Pilih</button>
                <div style="clear:right"></div>
            </div>
            <div class="pilih" id="tidakpuas">
                <div class="alert alert-success" role="alert">
                    <span><i class="glyphicon glyphicon-info-sign" aria-hidden="true"></i> Silahkan pilih alasan mengapa Anda tidak puas</span>
                </div>
                <div class="row">
                    <input type="radio" name="tp" id="tp1" value="lama" checked/><label class="col-md-3" for="tp1">Pelayanan lama</label>
                    <input type="radio" name="tp" id="tp2" value="tidak ramah"/><label class="col-md-3" for="tp2">Petugas tidak ramah</label>
                    <input type="radio" name="tp" id="tp3" value="tidak sesuai"/><label class="col-md-3" for="tp3">Informasi kurang jelas</label>
                    <input type="radio" name="tp" id="tp4" value="lain-lain"/><label class="col-md-3" for="tp4">lain-lain</label>
                </div>
                <textarea name="tp" placeholder="jelaskan alasan Anda (maks 250karakter)"></textarea>
                <button id="selesai2" class="btn btn-success btn-lg">Selesai</button>
                <div style="clear:right"></div>
            </div>
        </div>
        <?php } ?>
        <script src="resources/js/jquery.min.js"></script>
        <script src="resources/js/bootstrap.min.js"></script>
        <script src="resources/js/bootbox.min.js"></script>
        <script src="resources/js/index.js"></script>
        <script src="resources/js/index-top.js"></script>
    </body>
</html>