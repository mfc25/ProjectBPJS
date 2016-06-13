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
                <label class="control-label col-sm-3" for="nama">Nama :</label>
                <div class="col-sm-6">
                    <input type="text" data-toggle="tooltip" data-placement="bottom" title="min 8 maks 16" maxlength="16" name="nama" class="form-control" value="<?php echo $dataAdministrator['Nama']?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="password">password baru :</label>
                <div class="col-sm-6">
                    <input type="password" data-toggle="tooltip" data-placement="bottom" title="min 8 maks 16" maxlength="16" name="pwdbaru" class="form-control" placeholder="masukkan kata sandi baru Anda"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="password">ulangi password :</label>
                <div class="col-sm-6">
                    <input type="password" maxlength="16" name="u_pwdbaru" class="form-control"/>
                </div>
            </div>
        </div>
        <button class="ganti-administrator btn btn-warning navbar-right">Ganti <i class="fa fa-pencil-square-o"></i></button>
    </div>
</div>