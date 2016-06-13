<html>
    <?php
    include "../../../controller/koneksi.php";
    include "../../controller/paging.php";
    ?>
    <head>
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
    <link href="../../resources/css/admin.css" rel="stylesheet"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <span class="navbar-brand">
                        <img alt="Brand" src="../../../resources/public/gambar/logo-bpjs.png"/>
                        Feedback BPJS Kesehatan
                    </span>
                    <button class="btn btn-default navbar-btn" id="menu-toggle">Toggle Menu</button>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">
                            <span id="namaAdmin"><?php echo $_SESSION['bpjs_admin'];?></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="../../controller/keluar.php"><span class="fa fa-sign-out"></span>Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
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
            </div>
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                        <?php if(!isset($_GET['feedback']) && !isset($_GET['user'])){include "chart-feedback.php";}?>
                        <?php if(isset($_GET['feedback'])){?>
                        <p id="jumlahloket">Jumlah loket 
                            <button id="kurang" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button>
                            <input class="form-control input-sm" type="text" name="jmlLoket" value="<?php echo $jml_loket?>" disabled/>
                            <button id="tambah" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></button>
                        </p>
                        <table id="tabel-feedback" class="table table-bordered table-striped tabel-feedback">
                        <?php include "tabel-feedback.php"?>
                        </table>
                        <?php include "pagination.php"?>
                        <div class="pengaturan-paging">
                            <span>jumlah baris : <input class="form-control jumlahbaris" type="text" value="<?php echo $pagingbts?>"/></span>
                            <button id="kirim" class="btn btn-primary btn-sm">GO</button>
                        </div>
                        <?php }else if(isset($_GET['user'])){
                        include "user.php";
                        }?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
        <script src="../../../resources/public/js/jquery.min.js"></script>
        <script src="../../../resources/public/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../../resources/public/js/Chart.bundle.min.js"></script>
        <script src="../../../resources/public/js/bootbox.min.js"></script>
        <script src="../../resources/js/admin.js"></script>
    </body>
</html>