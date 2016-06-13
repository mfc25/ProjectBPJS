<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- Bootstrap -->
        <link href="../resources/public/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="../resources/public/fontawesome/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="../resources/public/style.css" rel="stylesheet"/>
        <link rel="icon" href="../resources/public/gambar/logo-bpjs.png"/>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="resources/css/index.css" rel="stylesheet"/>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <span class="navbar-brand">
                        <img alt="Brand" src="../resources/public/gambar/logo-bpjs.png"/>
                        Feedback BPJS Kesehatan
                    </span>
                </div>
            </div>
        </nav>
        <div class="login-page">
            <div class="panel panel-primary">
                <div class="panel-heading"><center>Kuisioner kepuasan pelayanan</center></div>
                <div class="panel-body">
                    <div class="user-form form-group">
                        <input type="hidden" name="pengguna" value="user"/>
                            <button class="btn btn-info btn-block" id='user'>Isi Kuisioner</button>
                        <center>
                            <span class="admin btn-link">masuk sebagai admin</span>
                        </center>
                    </div>
                    <div class="admin-form form">
                        <input type="hidden" name="pengguna" value="admin"/>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input class="form-control" type="text" name="nama" placeholder="username"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                <input class="form-control" type="password" name="sandi" placeholder="password"/>
                            </div>
                        </div>
                        <button class="btn btn-info btn-block" id='admin'>Masuk</button>
                        <center>
                            <span class="user btn-link">masuk sebagai user</span>
                        <center>
                    </div>
                </div>
            </div>
        </div>
        <script src="../resources/public/js/jquery.min.js"></script>
        <script src="../resources/public/js/bootstrap.min.js"></script>
        <script src="../resources/public/js/bootbox.min.js"></script>
        <script src="resources/js/index.js"></script>
    </body>
</html>