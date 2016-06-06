<?php
$kueriTabelUser = mysql_query("SELECT Nama, KataSandi FROM bpjs_user");
$dataAdministrator = mysql_fetch_assoc($kueriTabelUser);
?>
<div class="panel-administrator panel panel-default">
    <div class="panel-heading">Administrator
    </div>
    <div class="panel-body">
        <div class="form-admin form-horizontal">
            <div class="form-group">
                <label class="control-label col-sm-2" for="nama">Nama :</label>
                <div class="col-sm-6">
                    <input type="text" name="nama" class="form-control" value="<?php echo $dataAdministrator['Nama']?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="password">password baru :</label>
                <div class="col-sm-6">
                    <input type="password" name="pwdbaru" class="form-control" placeholder="kata sandi baru"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="password">ulangi password :</label>
                <div class="col-sm-6">
                    <input type="password" name="u_pwdbaru" class="form-control" placeholder="ulangi sandi"/>
                </div>
            </div>
        </div>
        <button class="TUganti btn btn-warning navbar-right">Ganti <i class="fa fa-pencil-square-o"></i></button>
    </div>
</div>