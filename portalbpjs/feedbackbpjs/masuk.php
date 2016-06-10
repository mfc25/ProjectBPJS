<!DOCTYPE html>
<html lang="en">
  <head>
      <?php include "template/head.php"?>
      <link href="resources/css/masuk.css" rel="stylesheet"/>
      <title>BPJS : login ke sistem</title>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <span class="navbar-brand">
                        <img alt="Brand" src="../resources/public/gambar/logo-bpjs.png"/>
                        Kuisioner BPJS Kesehatan
                    </span>
                </div>
            </div>
        </nav>
            <div class="login-page">
                    <h3>Kuisioner kepuasan pelayanan</h3>
                <div class="form">
                    <form class="user-form" method="post" action="controller/proses.php">
                        <input type="hidden" name="pengguna" value="user"/>
                        <button type="submit">Isi Kuisioner</button>
                        <span class="admin btn-link">masuk sebagai admin</span>
                    </form>
                    <form class="admin-form" method="post" action="controller/proses.php">
                        <input type="hidden" name="pengguna" value="admin"/>
                        <input type="text" name="nama" placeholder="username"/>
                        <input type="password" name="sandi" placeholder="password"/>
                        <button type="submit">Masuk</button>
                        <span class="user btn-link">masuk sebagai user</span>
                    </form>
                </div>
            </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="resources/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="resources/js/bootstrap.min.js"></script>
        <script src="resources/js/masuk.js"></script>
    </body>
</html>