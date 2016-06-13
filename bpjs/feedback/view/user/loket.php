<?php
$dataLoket = mysql_query("SELECT `Jumlah` FROM jmlloket");
$dataJmlLoket = mysql_fetch_assoc($dataLoket);
$jmlLoket       = $dataJmlLoket['Jumlah'];
if($jmlLoket == 4){
?>
<div class="col-xs-6">
    <input type="radio" name="pilihanloket" id="pl1" value="1" checked/><label for="pl1">1</label>
</div>
<div class="col-xs-6">
    <input type="radio" name="pilihanloket" id="pl2" value="2"/><label for="pl2">2</label>
</div>
<div class="col-xs-6">
    <input type="radio" name="pilihanloket" id="pl3" value="3"/><label for="pl3">3</label>
</div>
<div class="col-xs-6">
    <input type="radio" name="pilihanloket" id="pl4" value="4"/><label for="pl4">4</label>
</div>
<?php
}else{
    for($i = 1; $i<= $jmlLoket; $i++){
        if($i == 1){
?>
<div class="col-xs-4">
    <input type="radio" name="pilihanloket" id="pl1" value="1" checked/><label for="pl1">1</label>
</div>
<?php
        }else{
?>
<div class="col-xs-4">
    <input type="radio" name="pilihanloket" id="pl<?php echo $i?>" value="<?php echo $i?>"/><label for="pl<?php echo $i?>"><?php echo $i?></label>
</div>
<?php
        }
    }
}
?>