<?php
/*
=====================================================
| mengambil data berdasarkan tanggal saat ini
=====================================================
*/
$tanggalSekarang = date("Y-m-d");
$dataChart = mysql_query("SELECT * FROM bpjs_feedback WHERE `tanggal` = '$tanggalSekarang'");
$chartArray = array();
while($FetchDataChart = mysql_fetch_assoc($dataChart)){
    $chartArray[] = array(
        "loket" => $FetchDataChart['loket'],
        "kepuasan" => str_replace("tidak puas", "tidak_puas",$FetchDataChart['kepuasan'])
    );
}

/*
======================================================
| menentukan jumlah loket
======================================================
*/
$jmlLoket = 0;
for($a = 0; $a < count($chartArray); $a++){
    if($jmlLoket < $chartArray[$a]['loket']){
        $jmlLoket = $chartArray[$a]['loket'];
    }
}

$jalur = array();

// 1, 3, 2

for($a = 1; $a <= $jmlLoket; $a++){
    $jalur[$a][0] = $a;
    $jalur[$a][1] = 0;
    $jalur[$a][2] = 0;
}

for($a = 0; $a < count($chartArray); $a++){
    for($b = 1; $b <= $jmlLoket; $b++){
        if($chartArray[$a]['loket'] === strval($jalur[$b][0])){
            if($chartArray[$a]['kepuasan'] === "puas")
                $jalur[$b][1] += 1;
            else if($chartArray[$a]['kepuasan'] === "tidak_puas")
                $jalur[$b][2] += 1;
        }
    }
}

$htmlNamaLoket = array();
$htmlLoketPuas = array();
$htmlLoketTdkPuas = array();

for($i = 0; $i < $jmlLoket; $i++){
    $htmlNamaLoket[$i]      = "Loket ".($i+1);
    $htmlLoketPuas[$i]      = $jalur[($i+1)][1];
    $htmlLoketTdkPuas[$i]   = $jalur[($i+1)][2];
}

?>
<script src="resources/js/Chart.bundle.min.js"></script>
<script src="resources/js/Chart.min.js"></script>
<div id="container" style="width: 70%; margin:0 auto;">
    <canvas id="canvas"></canvas>
</div>
<div class="container-fluid">
    <?php for($a = 1; $a <= $jmlLoket; $a++){?>
        <div class="canvas-holder col-md-3">
            <canvas id="chart-area<?php echo $a?>" />
        </div>
    <?php }?>
</div>
<script>
window.onload = function() {
    
    //chart batang
    var barChartData = {
        labels: <?php echo json_encode($htmlNamaLoket) ?>,
        datasets: [{
            label: 'Puas',
            backgroundColor: "#949FB1",
            data: <?php echo json_encode($htmlLoketPuas) ?>
        }, {
            label: 'Tidak Puas',
            backgroundColor: "#4D5360",
            data: <?php echo json_encode($htmlLoketTdkPuas) ?>
        }]
    };
    var cbatang = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(cbatang, {
        type: 'bar',
        data: barChartData,
        options: {
            // Elements options apply to all of the options unless overridden in a dataset
            // In this case, we are setting the border of each bar to be 2px wide and green
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: '#F6F6F6',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Grafik kepuasan pelayanan hari ini'
            }
        }
    });
    <?php for($a = 1; $a <= $jmlLoket; $a++){ ?>
    
    //chart doughnut
        var configPie<?php echo $a?> = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    <?php echo $jalur[$a][1]?>,
                    <?php echo $jalur[$a][2]?>
                ],
                backgroundColor: [
                    "#949FB1",
                    "#4D5360"
                ],
                label: 'Data 1'
            }],
            labels: [
                "Puas",
                "Tidak Puas"
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            title: {
                display: true,
                text: 'Loket <?php echo $a?>'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };
    var pie<?php echo $a?> = document.getElementById("chart-area<?php echo $a?>").getContext("2d");
    window.myDoughnut = new Chart(pie<?php echo $a?>, configPie<?php echo $a?>);
        <?php }?>
};
</script>