<?php
$kueriTabelUser = mysql_query("SELECT Nama, KataSandi FROM bpjs_user");
$TabelUserHeader = "<tr>
                        <th>Nama</th>
                        <th>KataSandi</th>
                        <th>Pilihan</th>
                    </tr>";
$TabelUserIsi = "";
    while($cetak = mysql_fetch_assoc($kueriTabelUser)){
        $TabelUserIsi .=    "<tr>" .
                                "<td class='TUnama'>".$cetak["Nama"]."</td>".
                                "<td class='TUsandi'><input type='password' value='".$cetak['KataSandi']."' disabled></td>".
                                "<td>
                                    <button class='TUganti btn btn-warning'><span>Ganti</span> <i class='fa fa-edit'></i></button>
                                </td>".
                            "<tr>";
    }
echo $TabelUserHeader.$TabelUserIsi;
?>
