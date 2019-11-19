<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>

<?php
$t1 = 0; $t2 = 0; $t3 = 0;
if(!empty($_POST['t2']))
{
  //$t1 = $_POST['t1'];
  $t2 = $_POST['t2'];
}

$bln = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September', 'Oktober','Nopember','Desember');
if($t2%4==0){
  $j = 29;
}else{
  $j = 28;
}
//echo $t1.$t2;
$jh   = array(0,31,$j,31,30,31,30,31,31,30,31,30,31);
?>

<h1 class="h3 mb-2 text-gray-800"><i class="fas fa-chart-bar"></i> Laporan Hasil Pendapatan per Tahun</h1>

<form action="" method="post" enctype="multipart/form-data" style="margin-bottom: 10px;">

  <div class="row">

    <div class="col-2">
      <select class="custom-select form-control selectpicker show-menu-arrow show-tick" data-size="6" data-style="btn-info" data-header="Silahkan pilih tahun" name="t2" onchange="submit()">
        <?php 
          echo"<option value=''>--- SEMUA TAHUN ---</option>";
          $sq = $this->db->query("SELECT tanggal from barang_laku group by year(tanggal)")->result();
          foreach($sq as $sw)
          {
            $data = explode('-', $sw->tanggal);
            $thn = $data[0];
            echo "<option value='$thn'"; if($thn == $t2) echo "selected"; else echo""; echo ">$thn</option>";
          }
        ?>
      </select>
    </div>
    
  </div>

</form>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-success pull-left">Grafik Hasil Pendapatan</h6>
    <h6 class="m-0 text-primary pull-right">
        <?php if(!empty($_POST['t2'])){echo 'Total pendapatan pada tahun: '.$t2;} ?>
        <?php
            function formatAngka($angka)
            {
              $hasil = number_format($angka, 0, '.', '.');
              return $hasil;
            }

            if(!empty($_POST['t2']))
            {
              $qq = $this->db->query("SELECT SUM(laba) as jumlah from barang_laku where year(tanggal) = '$t2'")->result();
              foreach($qq as $qw)
              {
                echo "<b>Rp. ".number_format($qw->jumlah)." ,-</b>";
              }
            }
            else
            {
              echo "";
            }
        ?>
    </h6>
  </div>
  <div class="card-body">
    <?php
      if(empty($_POST['t2']))
      {
        ?>
        <h2 style="text-align: center;">
          Total Pendapatan Anda:
          <?php
            function penyebut($nilai)
            {
              $nilai = abs($nilai);
              $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
              $temp = "";
              if ($nilai < 12) {
                $temp = " ". $huruf[$nilai];
              } else if ($nilai <20) {
                $temp = penyebut($nilai - 10). " belas";
              } else if ($nilai < 100) {
                $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
              } else if ($nilai < 200) {
                $temp = " seratus" . penyebut($nilai - 100);
              } else if ($nilai < 1000) {
                $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
              } else if ($nilai < 2000) {
                $temp = " seribu" . penyebut($nilai - 1000);
              } else if ($nilai < 1000000) {
                $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
              } else if ($nilai < 1000000000) {
                $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
              } else if ($nilai < 1000000000000) {
                $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
              } else if ($nilai < 1000000000000000) {
                $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
              }     
              return $temp;
            }
           
            function terbilang($nilai)
            {
              if($nilai<0) {
                $hasil = "minus ". trim(penyebut($nilai));
              } else {
                $hasil = trim(penyebut($nilai));
              }     		
              return $hasil;
            }
            $qq = $this->db->query("SELECT SUM(laba) as jumlah from barang_laku")->result();
            foreach($qq as $qw)
            {
              echo "<b class='text-primary'>Rp. ".formatAngka($qw->jumlah)." ,-</b>";
              echo "<p style='font-size: 15px; margin-top: 5px;'><i class='text-primary'>".terbilang($qw->jumlah)."</i></p>";
            }
          ?>
        </h2>
        <?php
      }
      else
      {
        ?>
        <div id="chartdiv"></div>
        <?php
      }
    ?>
  </div>
  <?php
    if(empty($_POST['t2']))
    {
      ?>
      <div class="card-footer">
        <small>*Jika Anda ingin melihat laporan sesuai grafik, silahkan pilih tahun terlebih dahulu untuk melihat grafik.</small>
      </div>
      <?php
    }
  ?>
  
</div>



<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
  am4core.ready(function() {

  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end

  // Create chart instance
  var chart = am4core.create("chartdiv", am4charts.XYChart);

  <?php
  $bln = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
  $gr = NULL;
  for($i = 0; $i < 12; $i++)
  {
    $qr = $this->db->query("SELECT SUM(laba) as jumlah from barang_laku where month(tanggal) = '".($i+1)."' and year(tanggal) = '$t2'")->result();

    foreach ($qr as $key) {
      $jum = $key->jumlah;
      if($jum == NULL)
      {
          $jum = 0;
      }
    }
    $gr[$i] = '{
    "bulan": "'.$bln[$i].'",
    "pendapatan": '.$jum.'
    }';
  }
  $grafik = implode($gr,",");
  ?>

  // Add data
  chart.data = [
  <?php echo $grafik; ?>
  ];

  prepareParetoData();

  function prepareParetoData()
  {
    var total = 0;

    for(var i = 0; i < chart.data.length; i++)
    {
        var value = chart.data[i].pendapatan;
        total += value;
    }

    var sum = 0;
    for(var i = 0; i < chart.data.length; i++){
        var value = chart.data[i].pendapatan;
        sum += value;   
        chart.data[i].persentase = sum / total * 100;
    }
  }

  // Create axes
  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "bulan";
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.minGridDistance = 60;
  categoryAxis.tooltip.disabled = true;

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.minWidth = 50;
  valueAxis.min = 0;
  valueAxis.cursorTooltipEnabled = false;

  // Create series
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.sequencedInterpolation = true;
  series.dataFields.valueY = "pendapatan";
  series.dataFields.categoryX = "bulan";
  series.tooltipText = "Rp. [{categoryX}: bold]{valueY}[/]";
  series.columns.template.strokeWidth = 0;

  series.tooltip.pointerOrientation = "vertical";

  series.columns.template.column.cornerRadiusTopLeft = 10;
  series.columns.template.column.cornerRadiusTopRight = 10;
  series.columns.template.column.fillOpacity = 0.8;

  // on hover, make corner radiuses bigger
  var hoverState = series.columns.template.column.states.create("hover");
  hoverState.properties.cornerRadiusTopLeft = 0;
  hoverState.properties.cornerRadiusTopRight = 0;
  hoverState.properties.fillOpacity = 1;

  series.columns.template.adapter.add("fill", function(fill, target) {
    return chart.colors.getIndex(target.dataItem.index);
  });

  var paretoValueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  paretoValueAxis.renderer.opposite = true;
  paretoValueAxis.min = 0;
  paretoValueAxis.max = 100;
  paretoValueAxis.strictMinMax = true;
  paretoValueAxis.renderer.grid.template.disabled = true;
  paretoValueAxis.numberFormatter = new am4core.NumberFormatter();
  paretoValueAxis.numberFormatter.numberFormat = "#'%'"
  paretoValueAxis.cursorTooltipEnabled = false;

  // var paretoSeries = chart.series.push(new am4charts.LineSeries())
  // paretoSeries.dataFields.valueY = "persentase";
  // paretoSeries.dataFields.categoryX = "bulan";
  // paretoSeries.yAxis = paretoValueAxis;
  // paretoSeries.tooltipText = "Persentase: {valueY.formatNumber('#.0')}%[/]";
  // paretoSeries.bullets.push(new am4charts.CircleBullet());
  // paretoSeries.strokeWidth = 2;
  // paretoSeries.stroke = new am4core.InterfaceColorSet().getFor("alternativeBackground");
  // paretoSeries.strokeOpacity = 0.5;

  // Cursor
  chart.cursor = new am4charts.XYCursor();
  chart.cursor.behavior = "panX";

  }); // end am4core.ready()
</script>
