<?php
/* penjelasan [1]
======================================================
| mengambil data berdasarkan tanggal saat ini
======================================================
*/
$tanggalSekarang = date("Y-m-d");

$dataChart = mysql_query("SELECT * FROM bpjs_feedback WHERE tanggal='".$tanggalSekarang."'");
$chartArray = array();
while($FetchDataChart = mysql_fetch_assoc($dataChart)){
    $chartArray[] = array(
        "loket" => $FetchDataChart['loket'],
        "kepuasan" => str_replace("tidak puas", "tidak_puas",$FetchDataChart['kepuasan'])
    );
}

/* penjelasan [2]
======================================================
| menentukan jumlah loket
======================================================
*/
$dataLoket = mysql_query("SELECT `Jumlah` FROM jmlloket");
$dataJmlLoket = mysql_fetch_assoc($dataLoket);
$jmlLoket       = $dataJmlLoket['Jumlah'];
/* penjelasan [3]
======================================================
| inisiasi array untuk menampung data jenis loket
| dan jumlah kepuasan dan ketidakpuasannya
| contoh :
------------------------------------------------------
| [a, 4, 2]
| ini berarti loket ke 'a' memiliki data kepuasan : 4
| dan ketidakpuasan : 2
======================================================
*/
$jalur = array();

/* penjelasan [4]
======================================================
| mengisi nilai array yang telah diinisiasi
======================================================
| secara default, nilai dari array adalah sebagai
| berikut:
------------------------------------------------------
| indeks ke 0 akan diisi dengan nomor urut loket
| indeks ke 1 akan diisi dengan nol => nilai awal dari
| kepuasan : "puas"         --> (1)
| indeks ke 2 akan diisi dengan nol => nilai awal dari
| kepuasan : "tidak puas"   --> (2)
*/
for($a = 1; $a <= $jmlLoket; $a++){
    $jalur[$a][0] = $a;   //--> nomor urut loket
    $jalur[$a][1] = 0;    //--> (1)
    $jalur[$a][2] = 0;    //--> (2)
}

/* penjelasan [5]
======================================================
| MENCARI DAN MENGELOMPOKKAN DATA BERDASARKAN LOKET
======================================================
*/
//melakukan perulangan sebanyak jumlah baris
//pada data tabel feedback terpilih
for($a = 0; $a < count($chartArray); $a++){
    
    //mencocokkan nomor loket yang muncul dengan nomor
    //loket di array $jalur penjelasan --> [3]
    for($b = 1; $b <= $jmlLoket; $b++){
        
        //jika nomor loket yang muncul sesuai dengan nomor loket
        //pada data array $jalur
        //*nomor loket ditemukan dengan mengambil nilai dari nama
        //nilai array yaitu "loket"
        if($chartArray[$a]['loket'] === strval($jalur[$b][0])){
            if($chartArray[$a]['kepuasan'] === "puas")
                $jalur[$b][1] += 1;
            else if($chartArray[$a]['kepuasan'] === "tidak_puas")
                $jalur[$b][2] += 1;
        }
    }
}

/* penjelasan [6]
======================================================
| INISIASI ARRAY UNTUK MEMBUAT CETAKAN HTML DARI LOKET
| BESERTA KEPUASANNYA YANG SALING TERPISAH
======================================================
*/
//array untuk menampung loket misalkan [1,2,3,dst...]
$htmlNamaLoket      = array();
//array untuk menampung urutan kepuasan : "puas" berdasarkan urutan loket
// misalkan [a,b,c,dst...] --> loket 1 jumlah kepuasannya yaitu a
$htmlLoketPuas      = array();
//array untuk menampung urutan kepuasan : "tidak puas" berdasarkan urutan loket
// misalkan [a,b,c,dst...] --> loket 1 jumlah kepuasannya yaitu a
$htmlLoketTdkPuas   = array();

for($i = 0; $i < $jmlLoket; $i++){
    $htmlNamaLoket[$i]      = "Loket ".($i+1);
    $htmlLoketPuas[$i]      = $jalur[($i+1)][1];
    $htmlLoketTdkPuas[$i]   = $jalur[($i+1)][2];
}

/*
======================================================
| CHART COLOR TEMPLATING
======================================================
*/
$warnaPuas      = "#0B5FA5";
$warnaTdkPuas   = "#72899A";
?>
<script src="resources/js/Chart.bundle.min.js"></script>
<script src="resources/js/Chart.min.js"></script>
<div id="container" style="width: <?php if($jmlLoket == 4){?>70%<?php } else if($jmlLoket > 4){?>40%<?php } ?>; margin:0 auto;">
    <canvas id="canvas"></canvas>
</div>
<div class="container-fluid">
    <?php for($a = 1; $a <= $jmlLoket; $a++){?>
        <div class="canvas-holder col-md-<?php if($jmlLoket == 4){?>3<?php } else if($jmlLoket > 4){?>4<?php } ?>">
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
            backgroundColor: "<?php echo $warnaPuas?>",
            data: <?php echo json_encode($htmlLoketPuas) ?>
        }, {
            label: 'Tidak Puas',
            backgroundColor: "<?php echo $warnaTdkPuas?>",
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
                    borderWidth: 1,
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
            },
            scales: {
                yAxes:[{
                    ticks:{
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    <?php for($a = 1; $a <= $jmlLoket; $a++){
    //fix problem: division by zero
    $j1 = 0;
    $j2 = 0;
    if(($jalur[$a][1] + $jalur[$a][2]) > 0)
    {
        $j1 = round($jalur[$a][1]/($jalur[$a][1] + $jalur[$a][2]),2) * 100;
        $j2 = round($jalur[$a][2]/($jalur[$a][1] + $jalur[$a][2]),2) * 100;
    }
    ?>
    
    //chart doughnut
        var configPie<?php echo $a?> = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    <?php echo $j1?>,
                    <?php echo $j2?>
                ],
                backgroundColor: [
                    "<?php echo $warnaPuas?>",
                    "<?php echo $warnaTdkPuas?>"
                ],
                label: 'Data 1'
            }],
            labels: [
                "Puas",
                "Tidak Puas"
            ]
        },
        options: {
            tooltips: {
                callbacks : {
                    //mengatur value doughnut dalam persen
                    label : function(tooltipItem,data){
                        nilai = data.datasets[tooltipItem.datasetIndex].data;
                        tooltipdata = nilai[tooltipItem.index];
                        return tooltipdata +"%";
                    }
                }
            },
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